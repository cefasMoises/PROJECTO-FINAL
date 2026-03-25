<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


@php

    use App\Models\Usuario;

    $user = Usuario::find(session()->get('user_id'));
    $notificacoes = $user->notificacoes()->where('estatus', '=', 'ON')->get();

@endphp


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>gestPlusCenter</title>
    {{-- icons link --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel='stylesheet' href='{{ asset('icons/bootstrap-icons.min.css') }}'>
    <link rel="stylesheet" href='{{ asset('css/scroll.css') }}'>
    {{-- bladewind components --}}
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    {{-- my js script --}}
    <script src="{{ asset('js/index.js') }}" defer></script>
    <script src="{{ asset('js/validate.js') }}" defer></script>


    @livewireStyles()
</head>
<script src="//unpkg.com/alpinejs" defer></script>
{{-- end --}}

<body class="relative flex w-full h-screen overflow-hidden  bg-slate-800">
    {{-- first --}}
    <header id="header"
        class="absolute top-0 flex items-center justify-center w-screen h-20 z-40 backdrop-blur shadow-lg bg-slate-800">


        <div class='ml-10 text-slate-300'>
            <button class='flex items-center justify-center size-8 p-2 rounded hover:bg-white/10'
                onclick='asideHide()'><i class='bi bi-list'></i></button>
        </div>
        {{-- end --}}
        <x-logo-mark />
        {{-- end --}}
        <div class="flex  justify-end items-center w-full pr-10 gap-2">
            <x-bladewind::theme-switcher />
            <div class="relative p-2 flex items-center justify-center hover:bg-slate-400/20 rounded">
                <a href="/notifications" class="flex"><i class="bi bi-bell-fill text-2xl text-slate-400"></i></a>
                {{-- end --}}

                @if ($notificacoes->count() > 0)
                    <span
                        class="size-2 bg-red-500 overflow-hidden p-2 text-sm flex justify-center items-center text-white rounded-full absolute top-2 left-5 animate-bounce">{{ $notificacoes->count() }}</span>
                @endif
            </div>
            {{-- end --}}
            <p class='text-slate-400'>|</p>


            <a href='/usuarios/'>
                <div class="relative flex items-center justify-center p-2 rounded-3xl text-slate-500 bg-slate-500/10">

                    {{-- <i class='bi bi-person-fill'></i> --}}
                    <h1 class='overflow-hidden font-bold w-full text-center'>{{ $user->nome }}</h1>
                    <span class='absolute top-0 size-2 bg-red-500 right-0 rounded-full'><span>
                </div>
            </a>


        </div>

        <div id='progress' class="absolute bottom-0 h-1 accent-black w-full bg-blue-500 animate-ping hidden "
            max="100" value="50">


        </div>
    </header>

    <x-asidebar />
    {{-- end --}}
    <main class='relative flex items-center justify-center grow'>
        {{-- first --}}
        <section class=" h-full grow overflow-y-auto">
            <x-bladewind::card>
                <div class="min-h-screen w-full">
                    @yield('content')
                </div>
            </x-bladewind::card>
        </section>
        {{-- end --}}
        <x-bladewind::modal name="sair" show_action_buttons=false>
            <form method="get" action="/sair" class="flex flex-col items-center justify-between w-full h-32 ">
                @csrf
                <i
                    class="bi-box-arrow-left flex justify-center items-center text-red-500 size-8 rounded-full bg-red-500/50 text-lg"></i>
                <h1 class="text-lg text-red-500">quer sair?</h1>
                <div class="flex justify-end gap-2 w-full">
                    <x-bladewind::button type='secondary' onclick="hideModal('sair')">Não</x-bladewind::button>
                    <x-bladewind::button can_submit='true'>sim</x-bladewind::button>
                </div>
            </form>
        </x-bladewind::modal>
        {{-- end modal --}}
        <x-bladewind.notification type='sucess' />
        @if (session()->has('sucess'))
            <script>
                showNotification('sucesso!', "{{ session()->get('sucess') }} ")
            </script>
        @elseif(session()->has('error'))
            <script>
                showNotification('falhou!', "{{ session()->get('error') }}", 'error')
            </script>
        @endif
    </main>
    @livewireScripts()
</body>


</html>
