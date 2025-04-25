<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\Barang;
use App\Models\Kategori;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Cek role setelah berhasil login
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akses web ini hanya diperbolehkan untuk admin.',
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function dashboard()
    {
        $users = User::all();
        $kategoris = Kategori::all(); // Pastikan model Kategori ada
        $barangs = Barang::with('kategori')->get();
        $totalUsers = User::count();
        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalBarangRusak = Barang::where('kondisi', 'rusak')->count(); // pastikan kolom 'kondisi' benar
        return view('dashboard', compact('users', 'kategoris', 'barangs', 'totalUsers', 'totalKategori', 'totalBarang', 'totalBarangRusak'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function deleteProfile($id)
    {
        // Pastikan hanya admin yang bisa menghapus user lain
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // Cegah admin menghapus dirinya sendiri lewat dashboard
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri dari sini.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login', 'loginPost', 'register', 'registerPost']]);
        $this->middleware('guest')->only('login', 'register'); // Mengambil middleware guest
    }
}