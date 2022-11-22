@extends('client.index_client')

@section('title','Saques de Rendimento')
@section('menu_saque','active')

@section('content')

<div class="card">

    <div class="card-body">
        <hr>
        <table class='table table-bordered table-striped table-sm'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    {{-- <th>Moeda</th> --}}
                    <th>Data Lançamento</th>
                </tr>
            </thead>
            @foreach($rendimentos_pagos as $rendimentos)
            <tr>
                <td>{{ $rendimentos->id }}</td>
                <td>@money($rendimentos->valor)</td>
                {{-- <td>{{ $rendimentos->boleto-> }}</td> --}}
                <td>{{ date('d-m-Y', strtotime($rendimentos->created_at )) }}</td>
            </tr>
            @endforeach
        </table>


    </div>
</div>

@endsection
