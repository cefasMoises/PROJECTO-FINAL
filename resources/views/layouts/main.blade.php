<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGSC</title>
    {{-- icons link --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel='stylesheet' href='{{ asset("icons/bootstrap-icons.min.css") }}'>
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    {{-- my css link --}}
    {{--
    <link rel='stylesheet' href='css/style.css'> --}}
    {{-- my js script --}}
    <script src="./js/validate.js" defer></script>
    {{-- <script src="./js/components.js" defer></script> --}}
    {{-- <script src="./js/chartJs.js"></script> --}}
    @livewireStyles()
</head>
<script src="//unpkg.com/alpinejs" defer></script>

<body class="flex flex-col w-full max-h-screen overflow-hidden ">
    @yield('header')
    <main class='flex flex-col h-screen'>
        @yield('content')
    </main>
    @yield('footer')
    @livewireScripts()
</body>

</html>
