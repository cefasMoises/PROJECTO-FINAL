<aside id="asidebar"
    class="transition-all duration-300 ease-in-out max-w-56 w-56 h-full flex flex-col bg-gray-900 text-gray-300 overflow-y-auto p-6">


    <nav class="mt-20 flex flex-col space-y-8 flex-grow">

        @php
            use App\rules\UserAccess;


            function navLink($href, $label, $icon)
            {
                $isActive = request()->is(ltrim($href, '/') . '*');

                $baseClasses =
                    'flex items-center gap-3 px-4 py-3 rounded-md transition-colors duration-200 cursor-pointer whitespace-nowrap';
                $activeClasses = 'bg-blue-600 text-white';
                $inactiveClasses = 'hover:bg-blue-700 hover:text-white text-gray-400';

                return '
                                                                    <a href="' .
                    $href .
                    '" class="' .
                    $baseClasses .
                    ' ' .
                    ($isActive ? $activeClasses : $inactiveClasses) .
                    ' nav-link">
                                                                                                <i class="bi ' .
                    $icon .
                    ' text-xl ' .
                    ($isActive ? 'text-white' : 'text-gray-400') .
                    ' flex-shrink-0"></i>
                                                                                                <span class="aside-text">' .
                    $label .
                    '</span>
                                                                                            </a>
                                                                                        ';
            }
        @endphp

        <ul class="flex flex-col gap-2">
            {!! navLink('/panel', 'painel', 'bi-house-fill') !!}
        </ul>

        <hr class="border-gray-700" />


        @if(session()->get("acesso") == UserAccess::getFNC() || session()->get("acesso") == UserAccess::getAdm())
            <ul class="flex flex-col gap-2">

                {!! navLink('/estagiarios', 'estagiarios', 'bi-people-fill') !!}

                {!! navLink('/pagamentos', 'pagamentos', 'bi-credit-card') !!}
                {!! navLink('/turmas/', 'turmas', 'bi-person-add') !!}
            </ul>
        @endif

        <hr class="border-gray-700" />

        @if (session()->get("acesso") == UserAccess::getPDG() || session()->get('acesso') == UserAccess::getAdm())

            <ul class="flex flex-col gap-2">
                {!! navLink('/instrutores', 'instrutores', 'bi-person-lines-fill') !!}
                {!! navLink('/desempenho', 'desempenho', 'bi-graph-up-arrow') !!}
                {!! navLink('/certificados', 'certificados', 'bi-card-text') !!}
            </ul>

        @endif


        @if (session()->get('acesso') == UserAccess::getAdm())

            <hr class="border-gray-700" />

            <ul class="flex flex-col gap-2">
                {!! navLink('/usuarios', 'usuarios', 'bi-people') !!}
                {!! navLink('/turmas', 'turmas', 'bi-door-open') !!}
                {!! navLink('/cursos', 'cursos', 'bi-collection') !!}
                {!! navLink('/institutos', 'institutos', 'bi-building') !!}
                {!! navLink('/planos', 'estágios', 'bi-journal-text') !!}
            </ul>

            <hr class="border-gray-700" />
        @endif

        <ul class="flex flex-col gap-2 mt-auto">
            <li>
                <button onclick="showModal('sair')"
                    class="w-full text-left text-red-500 hover:text-red-600 flex items-center gap-2 px-4 py-3 rounded-md transition-colors duration-200">
                    <i class="bi bi-box-arrow-left text-xl"></i>
                    <span class="aside-text">terminar sessão</span>
                </button>
            </li>
        </ul>

    </nav>
</aside>