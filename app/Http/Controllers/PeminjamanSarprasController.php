<?php

// app/Http/Controllers/PeminjamanSarprasController.php

namespace App\Http\Controllers;

use App\Models\PeminjamanSarpras;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanSarprasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
            'tujuan' => 'required|string|max:255'
        ]);

        $barang = Barang::find($request->barang_id);
        
        // Cek stok barang
        if ($barang->stok < $request->jumlah) {
            return response()->json([
                'message' => 'Stok tidak mencukupi untuk peminjaman ini'
            ], 400);
        }

        // Cek status barang
        if ($barang->status !== 'tersedia') {
            return response()->json([
                'message' => 'Barang tidak tersedia untuk dipinjam'
            ], 400);
        }

        $peminjaman = PeminjamanSarpras::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'tujuan' => $request->tujuan,
            'status' => 'menunggu'
        ]);

        return response()->json([
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman
        ], 201);
    }

    // Daftar peminjaman user
    public function userPeminjaman()
    {
        $peminjaman = PeminjamanSarpras::with('barang')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $peminjaman
        ]);
    }
    // Halaman daftar peminjaman untuk admin
    public function index()
    {
        $peminjaman = PeminjamanSarpras::with(['user', 'barang', 'approver'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('peminjaman.index', compact('peminjaman'));
    }

    // Approve peminjaman
    public function approve($id)
    {
        $peminjaman = PeminjamanSarpras::findOrFail($id);
        
        // Cek stok tersedia
        if ($peminjaman->barang->stok < $peminjaman->jumlah) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi untuk menyetujui peminjaman ini');
        }

        $peminjaman->status = 'disetujui';
        $peminjaman->approver_id = auth()->id();
        $peminjaman->save();

        return redirect()->route('peminjaman-Sarpras.index')
            ->with('success', 'Peminjaman berhasil disetujui');
    }

    // Tolak peminjaman
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:255'
        ]);

        $peminjaman = PeminjamanSarpras::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->catatan = $request->catatan;
        $peminjaman->approver_id = auth()->id();
        $peminjaman->save();

        return redirect()->route('peminjaman-Sarpras.index')
            ->with('success', 'Peminjaman berhasil ditolak');
    }

    // Konfirmasi peminjaman (setelah disetujui)
    public function confirm($id)
    {
        $peminjaman = PeminjamanSarpras::findOrFail($id);
        
        if ($peminjaman->status !== 'disetujui') {
            return redirect()->back()
                ->with('error', 'Hanya peminjaman yang sudah disetujui yang bisa dikonfirmasi');
        }

        // Kurangi stok
        $barang = $peminjaman->barang;
        $barang->stok -= $peminjaman->jumlah;
        $barang->save();

        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        return redirect()->route('peminjaman-Sarpras.index')
            ->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    // Pengembalian barang
    public function return(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'catatan' => 'nullable|string'
        ]);

        $peminjaman = PeminjamanSarpras::findOrFail($id);
        
        if ($peminjaman->status !== 'dipinjam') {
            return redirect()->back()
                ->with('error', 'Hanya barang yang sedang dipinjam yang bisa dikembalikan');
        }

        // Update status peminjaman
        $peminjaman->status = $request->kondisi === 'baik' ? 'dikembalikan' : $request->kondisi;
        $peminjaman->tanggal_dikembalikan = now();
        $peminjaman->catatan = $request->catatan;
        $peminjaman->save();

        // Update stok atau kondisi barang
        $barang = $peminjaman->barang;
        
        if ($request->kondisi === 'baik') {
            $barang->stok += $peminjaman->jumlah;
        } elseif ($request->kondisi === 'rusak_ringan' || $request->kondisi === 'rusak_berat') {
            $barang->kondisi = $request->kondisi;
        }
        // Jika hilang, tidak perlu update stok karena sudah berkurang saat dipinjam
        
        $barang->save();

        return redirect()->route('peminjaman-Sarpras.index')
            ->with('success', 'Pengembalian berhasil dicatat');
    }

    // Laporan peminjaman
    public function report()
    {
        $peminjaman = PeminjamanSarpras::with(['user', 'barang', 'approver'])
            ->whereIn('status', ['dipinjam', 'dikembalikan', 'rusak_ringan', 'rusak_berat', 'hilang'])
            ->orderBy('tanggal_pinjam', 'desc')
            ->filter(request(['status', 'start_date', 'end_date']))
            ->get();
            
        return view('admin.peminjaman-Sarpras.report', compact('peminjaman'));
    }
}