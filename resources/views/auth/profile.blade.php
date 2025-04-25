@extends('layouts.app')

@section('title', 'My Profile')
@section('content')

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 p-3 rounded-full inline-flex items-center">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Profil Saya</h1>
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                Edit Profil
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-10">
        <div class="flex items-center gap-5 flex-wrap text-center sm:text-left">
            <div class="w-16 h-16 rounded-full bg-blue-600 text-white flex items-center justify-center text-2xl font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">{{ Auth::user()->username }}</p>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow transition duration-300 ease-in-out hover:shadow-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-5">Informasi Akun</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dibuat Pada</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->created_at->format('j F Y - H.i') }} WIB</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Di Update</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->updated_at->format('j F Y - H.i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection