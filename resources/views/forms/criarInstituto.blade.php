@extends('layouts.App')

@section('content')
    @php
        $class_input =
            'apaerence-none bg-transparent w-full border-none outline outline-1 outline-slate-300 focus:outline-blue-500 text-slate-500 placeholder-slate-400/50';
    @endphp
    <div class="mt-20 space-y-10">
        <div class="mt-20 space-y-10">

            {{-- first --}}
            <x-bladewind::card>
                <div class="flex justify-between items-center">
                    <h1 class="uppercase text-gray-500"><i class="bi-collection-fill"></i> Institutos > registrar </h1>
                    <x-bladewind::button type='secondary' tag='a' href='/institutos'>voltar</x-bladewind::button>
                </div>
            </x-bladewind::card>
            {{-- end title section --}}

            <x-bladewind::card>
                <form action="/institutos/criar" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf


                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-600 mb-1">Nome</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-person-fill text-slate-400 p-2"></i>
                            <input type="text" id="any-text" name="nome" maxlength="50" required
                                pattern="^[A-Za-zÀ-ÿ\s]{3,50}$" class="{{ $class_input }}"
                                placeholder="MM INDUSTEC..(no máximo 50 caracteres)">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-envelope-fill text-slate-400 p-2"></i>
                            <input type="email" id="any-email" name="email" class="{{ $class_input }}"
                                placeholder="example@email.com">
                        </div>
                    </div>

                    <!-- nif -->
                    <div>
                        <label for="nif" class="block text-sm font-medium text-slate-600 mb-1">Nif</label>
                        <div class="flex items-center border border-slate-300 rounded">
                            <i class="bi-file-post-fill text-slate-400 p-2"></i>
                            <input type="text" maxlength="10" name="nif" pattern="^\d{10}$" required
                                class="{{ $class_input }}" placeholder="4367820363..(apenas 10 caracteres)">
                        </div>
                    </div>


                    <!-- Ações -->
                    <div class="flex justify-end gap-4 mt-4">

                        <x-bladewind::button can_submit='true'>confirmar</x-bladewind::button>
                    </div>
                </form>

            </x-bladewind::card>
        </div>
    @endsection
