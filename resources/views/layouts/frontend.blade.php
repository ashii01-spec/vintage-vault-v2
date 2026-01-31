<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vintage Vault</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans text-gray-900 bg-vintage-900 antialiased">
    
    @include('layouts.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>