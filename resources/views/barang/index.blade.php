@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Barang</h1>
        <a href="{{ route('barang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">No</th>
                    <th class="px-4 py-2 border-b">Gambar</th>
                    <th class="px-4 py-2 border-b">Nama Barang</th>
                    <th class="px-4 py-2 border-b">Kategori</th>
                    <th class="px-4 py-2 border-b">Stok</th>
                    <th class="px-4 py-2 border-b">Kondisi</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $index => $barang)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b text-center">
                        @if($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                                 class="w-16 h-16 object-cover mx-auto">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">{{ $barang->nama_barang }}</td>
                    <td class="px-4 py-2 border-b">{{ $barang->kategori->nama_kategori }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $barang->stok }}</td>
                    <td class="px-4 py-2 border-b text-center">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($barang->kondisi == 'baik') bg-green-100 text-green-800
                            @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b text-center">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($barang->status == 'tersedia') bg-blue-100 text-blue-800
                            @elseif($barang->status == 'dipinjam') bg-purple-100 text-purple-800
                            @else bg-orange-100 text-orange-800 @endif">
                            {{ ucfirst($barang->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('barang.edit', $barang->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection