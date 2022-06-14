<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            
            <div style="display:flex" class="">

                <!-- Side Bar -->
                <nav class="bg-gray-700 font-bold h-screen text-blue-400 text-center text-lg w-1/6">
                    <ul class="mt-6 leading-loose">
                        <li class="hover:bg-blue-900 hover:text-white active:bg-blue-900 active:text-white"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="hover:bg-blue-900 hover:text-white active:bg-blue-900 active:text-white"><a href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                </nav>

                <!-- Page Content -->
                <main class="w-5/6 h-screen">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @if(session()->has('success'))
            <p class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                {{ session('success') }}
            </p>

        @endif
    </body>
</html>
