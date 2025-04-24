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

    <div class="mt-20 flex justify-between items-center">
        <button onclick="toggleModal('modalAddUser')" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg shadow">
            + Tambah User
        </button>
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
                        <th class="px-4 py-2 border-b">Aksi</th>
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
                            <td class="px-4 py-2 border-b space-x-2">
                                <button onclick="toggleModal('modalEditUser{{ $user->id }}')" class="text-blue-600 hover:underline">Edit</button>
                                <form action="{{ route('profile.delete', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit User -->
                        <div id="modalEditUser{{ $user->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg">
                                <h2 class="text-xl font-semibold mb-4">Edit User</h2>
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    
                                    <input type="text" name="name" value="{{ $user->name }}" class="w-full mb-3 px-4 py-2 border rounded" required>
                                    <input type="text" name="username" value="{{ $user->username }}" class="w-full mb-3 px-4 py-2 border rounded" required>
                                    <input type="email" name="email" value="{{ $user->email }}" class="w-full mb-3 px-4 py-2 border rounded" required>
                                    <input type="password" name="password" placeholder="Password (opsional)" class="w-full mb-3 px-4 py-2 border rounded">

                                    <div class="flex justify-end mt-4">
                                        <button type="button" onclick="toggleModal('modalEditUser{{ $user->id }}')" class="px-4 py-2 mr-2 text-gray-600 hover:underline">Batal</button>
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div id="modalAddUser" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg relative shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Tambah User</h2>
        <form action="{{ route('user.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-3">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-3">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-3">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md shadow transition">
                Register
            </button>
        </form>
    </div>
</div>

<!-- Script Modal Toggle -->
<script>
    function toggleModal(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    }
</script>

@endsection