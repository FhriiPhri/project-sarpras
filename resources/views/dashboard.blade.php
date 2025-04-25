@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 sm:mb-8">
        Selamat Datang, {{ Auth::user()->name }}! 👋
    </h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-10">
        <a href="{{ url('users') }}">
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md flex items-center space-x-4 hover:shadow-lg transition">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <i class="fas fa-users text-lg sm:text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <h3 class="text-lg sm:text-xl font-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </a>

        <a href="{{ route('kategori.index') }}">
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md flex items-center space-x-4 hover:shadow-lg transition">
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <i class="fas fa-list text-lg sm:text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Kategori</p>
                    <h3 class="text-lg sm:text-xl font-bold">{{ $totalKategori }}</h3>
                </div>
            </div>
        </a>

        <a href="{{ route('barang.index') }}">
            <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md flex items-center space-x-4 hover:shadow-lg transition">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                    <i class="fas fa-box text-lg sm:text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Barang</p>
                    <h3 class="text-lg sm:text-xl font-bold">{{ $totalBarang }}</h3>
                </div>
            </div>
        </a>

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md flex items-center space-x-4">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                <i class="fas fa-warehouse text-lg sm:text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Barang Rusak</p>
                <h3 class="text-lg sm:text-xl font-bold">{{ $totalBarangRusak ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- Detail Admin Login --}}
    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-700 mb-4">Profil <strong>{{ Auth::user()->name }}</strong></h2>
        <ul class="text-sm sm:text-base text-gray-600 space-y-2">
            <li><strong>Nama:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Role:</strong> {{ Auth::user()->role ?? 'admin' }}</li>
            <li><strong>Terdaftar Sejak:</strong> {{ Auth::user()->created_at->format('d F Y') }}</li>
            <li><strong>Pukul:</strong> {{ Auth::user()->created_at->format('H.i') }} WIB</li>
        </ul>
    </div>
</div>
@endsection