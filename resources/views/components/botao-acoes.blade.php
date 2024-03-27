<div class="dropdown">
    <button class="btn bg-dark btn-sm text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        {{-- Ações de CRUD --}}

        @if (isset($create))
            <li><a class="dropdown-item" href="{{ $create }}"><i class="fas fa-pen"></i></i> Criar </a></li> {{-- Create --}}
        @endif

        @if (isset($read))
            <li><a class="dropdown-item" href="{{ $read }}"><i class="fas fa-eye"></i> Ver </a></li> {{-- Read --}}
        @endif

        <li><a class="dropdown-item" href="{{ $update }}"><i class="fas fa-pen"></i></i> Editar </a></li> {{-- Update --}}

        @if (isset($delete))
            <li>
                <a onclick="confirmarExclusao(this)" href="javascript:void(0)" data-rota="{{ $delete }}" class="dropdown-item"> {{-- Delete --}}
                    <i class="fas fa-trash"></i>
                    Excluir
                </a>
            </li>
        @endif
    </ul>
</div>
