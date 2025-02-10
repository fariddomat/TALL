<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" livewire:navigate>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">

    <div class="flex h-screen" x-data="{ open: false }">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" x-show="open" @click="open = false"></div>

        <!-- Sidebar -->
        <aside
    class="bg-gray-900 text-white p-5 w-64 md:w-64 md:fixed md:top-0 md:left-0 md:h-screen transition-all duration-300 ease-in-out z-50 overflow-y-auto"
    :class="open ? 'translate-x-0' : '-translate-x-64 md:translate-x-0'">
            <h2 class="text-xl font-bold mb-4">My Dashboard</h2>

            <nav class="mt-5 space-y-3 ">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-home"></i> Home
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('dashboard.users.index') }}" :active="request()->routeIs('dashboard.users.index')">
                    <i class="fas fa-users"></i> Users
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard.blogcategories.index') }}" :active="request()->routeIs('dashboard.users.index')">
                    <i class="fas fa-list-alt"></i> Blog Category
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('dashboard.blogs.index') }}" :active="request()->routeIs('dashboard.users.index')">
                    <i class="fas fa-newspaper"></i> Blogs
                </x-responsive-nav-link>

                <x-responsive-nav-link href="{{ route('profile') }}" :active="request()->routeIs('profile')">
                    <i class="fas fa-user-cog"></i> Profile
                </x-responsive-nav-link>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col -ml-64 md:ml-64">

            <!-- Navbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-gray-700 text-2xl">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- User Actions -->
                <div class="flex space-x-6 items-center text-lg">
                    <span class="cursor-pointer hover:text-gray-500">
                        <i class="fas fa-bell"></i>
                    </span>

                    <span class="cursor-pointer hover:text-gray-500">
                        <i class="fas fa-user"></i> User
                    </span>

                    <!-- Logout Button -->
                    {{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-red-500 hover:text-red-600 transition-all duration-200">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form> --}}
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

    <!-- Include ajaxForm library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" ></script>

    @extends('layouts._noty')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('redirect', (url) => {
                window.location.href = url;
            });
        });
    </script>


</body>

</html>
