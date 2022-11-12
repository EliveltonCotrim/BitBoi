@extends('admin.index_admin')
@section('title', 'cotacao')

@section('actions')
<a href='<?php echo url('/admin/cotacao'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>
        <div class='form-row'>
            <div class='col-md-4'>
                <label>Coin</label>
                <input type='text' readonly value='{{ $cotacao->coin }}' class='form-control'>
            </div>
            <div class='col-md-4'>
                <label>Date</label>
                <input type='text' readonly value='{{ $cotacao->date }}' class='form-control'>
            </div>
            <div class='col-md-4'>
                <label>Value</label>
                <input type='text' readonly value='{{ $cotacao->value }}' class='form-control'>
            </div>

        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label>Excluir?</label>
                <a href="{{ url('admin/cotacao/1/del') }}" class='btn btn-primary form-control'>
                    Excluir
                </a>
            </div>
        </div>
    </div>
</div>
@endsection