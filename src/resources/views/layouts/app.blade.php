<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
            <div class="flex items-center justify-between p-6 border-b">
                <h2 class="text-xl font-bold text-gray-700">Culture Monitor</h2>
                <button class="md:hidden text-gray-700 focus:outline-none" onclick="toggleSidebar()">✖</button>
            </div>
            @if(auth()->user()->isAdminHC())
                @include('admin_hc.sidebar')
            @elseif(auth()->user()->isDivisionHead())
                @include('division_head.sidebar')
            @elseif(auth()->user()->isCultureAgent())
                @include('culture_agent.sidebar')
            @endif
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 p-6 transition-all duration-300" id="main-content">
            <header class="w-full bg-white shadow-md p-4 flex justify-between items-center md:hidden">
                <button class="text-gray-700 focus:outline-none" onclick="toggleSidebar()">📂 Menu</button>
            </header>
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>