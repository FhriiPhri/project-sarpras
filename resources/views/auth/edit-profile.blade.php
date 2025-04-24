@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Profil</h1>
        <a href="{{ route('profile') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow-sm transition">
            Kembali Ke Profil
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input placeholder="{{auth()->user()->name}}" type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                class="px-5 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input placeholder="{{auth()->user()->email}}" type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                class="px-5 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow transition">
                Perbarui Profil
            </button>
        </div>
    </form>
</div>

@endsection