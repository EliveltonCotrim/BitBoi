@extends('admin.index_admin')
@section('title', 'clients')

@section('actions')
<a href='<?php echo url('/admin/clients'); ?>' class='btn btn-primary'>
    Voltar
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="list-inline d-sm-flex mb-0 d-none">
            <a class="list-inline-item d-flex align-items-center"><small class="bx bxs-circle mr-1 chart-online"></small></a>
            <a class="list-inline-item d-flex align-items-center">{{ $client->name }}</a>
            <a class="list-inline-item d-flex align-items-center">|</a>
            <a class="list-inline-item d-flex align-items-center">Nick: {{ $client->user }}</a>
            <a class="list-inline-item d-flex align-items-center">|</a>
            <a class="list-inline-item d-flex align-items-center" style="text-transform: lowercase">{{ mb_strtolower( $client->email) }}</a>
        </div>

    </div>
    <div class="col-md-12">
        <ul class="nav nav-tabs card-header-tabs">
            <!-- <li class="nav-item"> <a class="nav-link @yield('tab_home')" href="{{ url('admin/clients/home', $client->id) }}">Home</a></li> -->
            <li class="nav-item"> <a class="nav-link @yield('tab_financeiro')" href="{{ url('admin/clients/financeiro', $client->id) }}">Financeiro</a></li>
            <!-- <li class="nav-item"> <a class="nav-link @yield('tab_compras')" href="{{ url('admin/clients/pedidos', $client->id) }}">Pedidos</a></li> -->
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ url('admin/clients/extract', $client->id) }}">Extrato</a></li> -->
            <!-- <li class="nav-item"> <a class="nav-link" href="{{ url('admin/clients/addBalance', $client->id) }}">Adicionar Saldo</a></li> -->
            <li class="nav-item"> <a class="nav-link @yield('tab_patrocinador')" href="{{ url('admin/clients/patrocinador', $client->id) }}">
                    Alterer Dados
                </a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        @yield('content_client')
    </div>
</div>

@endsection