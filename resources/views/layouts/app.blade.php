<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD - @yield('title', 'Dashboard')</title>
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow px-6 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Manajemen Departemen</h1>
            <a href="{{ route('departments.index') }}" class="text-blue-600 hover:underline">Home</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
        @yield('content')
    </main>
</body>

</html>
