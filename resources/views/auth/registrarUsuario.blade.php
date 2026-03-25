@extends('layouts.main')

@section('content')

<div class="flex center p-8 w-100 h-screen">

    <form class="panel container-column box-x p-16 r-8 g-16" method="post" action="/logar">

        @csrf

        <div class="container-column center">
            <h1><i class='bi-person-circle  f-5x'></i></h1>
            <p class='f-1x'>registrar usuario</p>
        </div>
        <!-- end -->



        <div class="container-row g-8">

            <div class="container-column grow">

                <label for="nome">Nome usuario</label>
                <input type="text" id='nome' name='nome' autofocus>

            </div>
            {{-- end --}}
            <div class="container-column grow">

                <label for="email">email</label>
                <input type="text" id='email' name='email'>

            </div>
            {{-- end --}}

        </div>
        <!-- end -->

        <div class="container-row g-8">

            <div class="container-column grow ">

                <label for="nome">telefone</label>
                <input type="text" id='nome' name='nome' autofocus>

            </div>
            {{-- end --}}
            <div class="container-column w-100">

                <label for="cargo">cargo</label>

                <div class="x-input-group">
                <select class='center grow'name="cargo" id="cargo">
                    <option value="">secretario</option>
                    <option value="">admin</option>
                </select>
                <label for="cargo" class='p-8 center'>
                    <i class='bi-chevron-down f-small'></i>
                </label>
                </div>


            </div>
            {{-- end --}}

        </div>
        <!-- end -->
        <div class="container-row g-8">

            <div class="container-column grow">

                <label for="senha">senha</label>
                <input type="password" id='senha' name='senha'>

            </div>
            {{-- end --}}
            <div class="container-column grow">

                <label for="senha-2">confirmar senha</label>
                <input type="password" id='senha-2' name='senha-2'>

            </div>
            {{-- end --}}

        </div>
        <!-- end -->

    

        @if(session()->has('error'))

        <div class="container-row panel-error center w-100 g-8 p-8 r-8">

            <p class='text-danger'><i class='bi-x-circle'></i>
                {{session()->get('error')}}
            </p>

        </div>
        <!-- end -->
        @endif

        <div class="container-column">
            
            <button class='primary center g-8 f-1x'>
                entrar
                <i class='bi-arrow-right center f-small'></i>
            </button>
        </div>
        <!-- end -->

    </form>

</div>
@endsection