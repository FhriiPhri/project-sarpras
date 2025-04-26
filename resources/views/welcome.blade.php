<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">SISFO SARPRAS</h2>
        <p class="text-gray-600 mb-6">Website Sarana & Prasana <strong>SMK Taruna Bhakti</strong></p>

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRyLsum2Hjy7bB4mrgMa_gb43Z5tZVo7KnMA&s" alt="Authentication System" class="mx-auto mb-6 rounded-full w-50 h-50 object-cover">


        <div class="flex flex-col space-y-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Login</a>
            <a onclick="alert('Silakan daftar langsung ke ruang Sarana & Prasarana SMK Taruna Bhakti Depok');" class="cursor-pointer border border-blue-600 text-blue-600 py-2 px-4 rounded hover:bg-blue-50">Register</a>
        </div>
    </div>

</body>
</html>