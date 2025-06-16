<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>BestelApp - @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <div class="p-6 text-xl font-bold border-b">📦 BestelApp</div>

            <nav class="flex-1 p-4 space-y-3 text-sm">
                @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="block text-blue-600 hover:underline">Admin Dashboard</a>
                @endrole

                @role('technieker')
                    <a href="{{ route('technieker.dashboard') }}" class="block text-blue-600 hover:underline">Technieker Dashboard</a>
                @endrole

                <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:underline">👤 Profiel</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">🚪 Uitloggen</button>
                </form>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <header class="mb-6 border-b pb-2">
                <h1 class="text-2xl font-semibold">@yield('title', 'Dashboard')</h1>
            </header>

            @yield('content')
        </main>
    </div>

</body>
</html>