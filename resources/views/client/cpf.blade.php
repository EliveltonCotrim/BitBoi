@extends('client.index_client')
@section('title','Informe seu CPF')

@section('actions')
<a href='<?php echo url('client/meus_dados'); ?>' class='btn btn-success'>
    Voltar
</a>
@endsection

@section('content')

<div class="col-12 col-lg-5 border-right">

    <form action="" method="post">
        @csrf
        <div class="form-group">
            <div class='col-md-6'>
                <label>CPF</label>
                <input type="text" name="cpf" value="{{ $client->cpf }}" class="form-control cpf" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <div class='col-md-4'>
                <input type="submit" value="Confirmar" class="form-control btn btn-success col-md-">
            </div>
        </div>
    </form>
</div>
@endsection