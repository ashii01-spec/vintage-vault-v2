<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vintage Vault</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans text-gray-900 bg-vintage-50 antialiased">
    
    <nav class="bg-vintage-900 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-serif font-bold tracking-wider">
                <a href="/">VINTAGE VAULT</a>
            </div>
            <div class="hidden md:flex space-x-8 font-serif">
                <a href="/" class="hover:text-vintage-100">HOME</a>
                <a href="{{ route('shop') }}" class="hover:text-vintage-100">SHOP</a>
                <a href="#" class="hover:text-vintage-100">GALLERY</a>
                <a href="#" class="hover:text-vintage-100">CONTACT US</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm border border-white px-3 py-1 rounded">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    @include('layouts.footer')

    @livewireScripts
</body>
</html>