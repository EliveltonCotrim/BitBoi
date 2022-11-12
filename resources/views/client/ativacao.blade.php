@extends('client.index_client')
@section('title','')
@section('ativacao','open')


@section('content')


<div class='row'>
    <div class='col-md-12'>
        <a href="{{ url('client/plan/select') }}" class="btn btn-light btn-lg">
            Clique aqui para renovar
        </a>
    </div>
</div>


@endsection