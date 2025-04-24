@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        Selamat Datang, {{ Auth::user()->name }}! 👋👋
    </h1>

    <div class="space-y-3 text-gray-700">
        <p><strong>Nama :</strong> {{ Auth::user()->name }}</p>
        <p><strong>Username :</strong> {{ Auth::user()->username }}</p>
        <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
        <p><strong>Dibuat Pada :</strong> {{ Auth::user()->created_at->format('j F Y - H:i') }} WIB</p>
    </div>

    <div class="mt-8">
        <a href="{{ route('profile') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow transition">
            Lihat Detail Profil
        </a>
    </div>

    <div class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Seluruh User</h2>
    
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">#</th>
                        <th class="px-4 py-2 border-b">Nama</th>
                        <th class="px-4 py-2 border-b">Username</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Bergabung Pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->username }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->created_at->format('j F Y - H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>

@endsection