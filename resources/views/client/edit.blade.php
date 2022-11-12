@extends('client.index_client')
@section('title','Alterar Dados Pessoais')

@section('actions')
<a href='<?php echo url('client/meus_dados'); ?>' class='btn btn-success'>
    Voltar
</a>
@endsection

@section('content')

<div class="row">
    <div class="col-md-4 border-right">

        <form action="{{ url('client/edit/store') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="name" value="{{ $client->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="phone" value="{{ $client->phone }}" class="form-control">
            </div>


            <div class="form-group">
                <input type="submit" value="Alterar" class="form-control btn btn-success col-md-">
            </div>
        </form>
    </div>
    <div class="col-lg-4">

        <div class="form-group">
            <label>Usuário</label>
            <input type="text" disabled value="{{ $client->user }}" class="form-control">
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="text" disabled value="{{ $client->email }}" class="form-control">
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input type="text" value="{{ $client->cpf }}" disabled class="form-control">
        </div>


    </div>
</div>
@endsection