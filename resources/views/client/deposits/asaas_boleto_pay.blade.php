@extends('client.index_client')

@section('title','Gerar Boleto')
@section('menu_depositos','active')

@section('actions')
@endsection

@section('content')

<div class="card ">
    <div class="card-body">
        <h2>Gerar Boleto</h2>
        <hr>
        <a href="{{ $boleto_url }}" class="btn btn-primary rounded" target="_blanck">
            Abrir Boleto
        </a>
        <a href="{{ url('client/meu_plano') }}">Voltar</a>
    </div>
</div>

@endsection