@extends('client.index_client')
@section('title','Meus Dados')

@section('menu_dados','active')

@section('content')

<div class="user-profile-page">
    <div class="card radius-15">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-7 border-right">
                    <div class="d-md-flex align-items-center">
                        <div class="mb-md-0 mb-3">
                            <img src="{{ asset('assets') }}/img/moeda.png" class=" shadow" width="180" class="" alt="">
                        </div>
                        <div class="ml-md-4 flex-grow-1">
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="mb-0">{{ $client->name }}</h4>
                                <p class="mb-0 ml-auto"></p>
                            </div>
                            <p class="mb-0">{{ $client->user }}</p>
                            <p><i class="bx bx-buildings"></i> {{ $client->email }}</p>
                            <a href="{{ url('client/edit') }}" class="btn btn-light">Editar</a>
                            <a href="{{ url('client/password') }}" class="btn btn-light ml-2">Alterar Senha</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 table-responsive">

                    <div class="mb-3 mb-lg-0">

                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>

@endsection