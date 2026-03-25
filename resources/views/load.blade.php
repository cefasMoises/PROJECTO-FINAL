@extends('layouts.main')
@section('content')
<div class="flex flex-col items-center justify-center bg-slate-200 w-full h-full">
    <div class=" flex text-4xl font-bold text-white">
        <h1 class="p-2  text-slate-700 bg-white rounded-l-md">Gest</h1>
        <h1 class="p-2  text-white bg-blue-500">Plus</h1>
        <h1 class="bg-slate-400 p-2 rounded-r-md">Center</h1>
    </div>
    {{--
    <x-bladewind::spinner /> --}}
    <x-bladewind::progress-bar percentage="60" shade="dark" color="red" striped="true" />

</div>
@endsection
