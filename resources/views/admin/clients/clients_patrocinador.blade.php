@extends('admin.clients.clients_panel')
@section('tab_patrocinador','active')

@section('content_client')

<div class='form'>
    <form action="" method="post">
        @csrf
        <div class="form-row">
            <!-- <div class="col-md-4">
                <label for="">Patrocinador</label>
                <x-select name="indicado" :selected="$client->indicado" :options="$clients" />
            </div> -->
            <div class="col-md-4">
                <label for="">Nome</label>
                <input name="nome" value="{{ $client->name }}" type="text" class="form-control">
            </div>

            <div class="col-md-4">
                <label for="">CPF</label>
                <input name="cpf" value="{{ $client->cpf }}" type="text" class="form-control">
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-md-4">
                <label for="">Usuario</label>
                <input name="user" value="{{ $client->user }}" type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="">E-mail</label>
                <input name="email" value="{{ $client->email }}" type="text" class="form-control">
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-md-4" style="display: none;">
                <label for="">Status</label>
                <x-select name="status" :selected="$client->status" :options="['ativo'=>'ativo','pendente'=>'pendente','cancelado'=>'cancelado']" />
            </div>

            <div class="col-md-4">
                <label for="">Senha</label>
                <input name="senha" value="" type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="">Cod Cliente Asaas</label>
                <input name="codigo_assas" value="{{ $client->codigo_assas }}" type="text" class="form-control">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <label for="">Telefone</label>
                <input name="phone" value="{{ $client->phone }}" type="text" class="form-control">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <input value="Alterar" class="form-control btn btn-primary" type="submit">
            </div>
        </div>

    </form>
</div>


@endsection