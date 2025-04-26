<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpras System - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50 w-full left-0 right-0">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600 whitespace-nowrap">
                SarprasTBSystem
            </a>
    
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('users.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Users</a>
                    <a href="{{ route('kategori.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Kategori</a>
                    <a href="{{ route('barang.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Barang</a>
                    <a href="{{ route(name: 'profile') }}" class="ml-8 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded shadow text-sm sm:text-base transition whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>    

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>