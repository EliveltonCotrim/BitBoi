@extends('client.index_client')

@section('title',' Termos de Compra')

@section('content')
<div class="card">
    <div class="card-body">
        <hr>
        {!! $param->termo_compra !!}
    </div>
</div>
@endsection