<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD - @yield('title', 'Dashboard')</title>
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow-md px-6 py-4 sticky top-0 z-50">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Aplikasi Manajemen</h1>
                <p class="text-sm text-gray-500">CRUD Departemen & Employee</p>
            </div>
            <div class="flex flex-wrap gap-4 text-sm font-medium">
                <a href="{{ route('departments.index') }}" class="text-gray-600 hover:text-blue-600 transition">
                    Departemen
                </a>
                <a href="{{ route('employees.index') }}" class="text-gray-600 hover:text-blue-600 transition">
                    Employee
                </a>
                <a href="{{ route('attendance.index') }}" class="text-gray-600 hover:text-blue-600 transition">
                    Attendance
                </a>
                <a href="{{ route('attendance.history') }}" class="text-gray-600 hover:text-blue-600 transition">
                    Attendance History
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
        @yield('content')
    </main>
</body>

</html>
