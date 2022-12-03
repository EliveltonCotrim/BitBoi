@extends('admin.index_admin')
@section('title', 'Saques')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class='table-responsive'>
                <div class="col-md-12 mt-2">
                    <ul class="nav nav-tabs card-header-tabs"  style="border-bottom: 1px solid rgb(255 255 255 / 14%)">
                        <li class="nav-item"> <a class="nav-link @yield('sac_pendentes')"
                                href="{{ route('saques.pendentes') }}">Pendentes</a></li>
                        <li class="nav-item"> <a class="nav-link @yield('sac_confirmadas')"
                                href="{{ route('saques.confirmados') }}">Confirmados</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    @yield('content_admin')
                </div>
            </div>
        </div>
    </div>
@endsection
