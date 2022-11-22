@extends('client.index_client')
@section('title', 'Minhas Compras')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class='table-responsive'>
                <a href="{{ url('client/plan/select') }}" class="btn btn-primary mb-2">
                    <span class="bx bx-cart"></span>
                    Comprar Pacote
                </a>
                <a href="{{ url('client/coin/select') }}" class="btn btn-primary mb-2">
                    <span class="bx bx-cart"></span>
                    Comprar Moedas
                </a>
                <hr>
                <div class="col-md-12 mt-2">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item"> <a class="nav-link @yield('comp_pendentes')" href="{{ route('compras.pendentes') }}">Pendentes</a></li>
                        <li class="nav-item"> <a class="nav-link @yield('comp_confirmadas')" href="{{ route('compras.confirmadas')  }}">Confirmadas</a></li>
                        <li class="nav-item"> <a class="nav-link @yield('comp_enceradas')" href="{{ route('compras.enceradas')  }}">Encerradas</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    @yield('content_client')
                </div>
            </div>

        </div>
    </div>
@endsection
