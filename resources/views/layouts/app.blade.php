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
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-5 py-4 flex justify-between items-center">
            <a href="/dashboard" class="text-2xl font-bold text-blue-600">SarprasTBSystem</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('profile') }}" class="duration-300 text-gray-800 hover:text-blue-600 font-medium">
                    {{ Auth::user()->name ?? 'Guest' }}
                </a>
                @auth
                    <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="ml-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-5 py-10">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>