@extends('layouts.error')
@section('content')
<div class="flex w-full h-screen bg-40 bg-gray-300 items-center justify-center">
    <div class="max-w-96 bg-white p-8 rounded-md text-gray-600 flex items-center justify-between flex-col">
        <h1 class="text-2xl text-red-500">Ops! erro http 405 <i class="bi-emoji-dizzy"></i> </h1>
        <p>Você tentou acessar uma rota que requer outro tipo de requisição.</p>
        <div class="flex justify-end w-full mt-4">
            <a href="{{ url('/') }}" class="flex items-center justify-center capitalize p-2 h-12 bg-blue-500 text-white rounded-md">Voltar<i class="bi-arrow-right ml-2"></i></a>
        </div>
    </div>
</div>
@endsection
