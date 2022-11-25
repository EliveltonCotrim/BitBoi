@extends('client.index_client')
@section('title', 'Alterar Dados Pessoais')

@section('actions')
    <a href='<?php echo url('client/meus_dados'); ?>' class='btn btn-success'>
        Voltar
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 border-right">
            <form action="{{ url('client/edit/store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <label>Nome Completo</label>
                        <input type="text" name="name" value="{{ $client->name ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>RG</label>
                        <input type="text" name="rg" value="{{ $client->client->rg ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Telefone</label>
                        <input type="text" name="phone" value="{{ $client->client->phone ?? '' }}"
                            class="form-control fone">
                    </div>
                </div>
                <hr>
                <div class="form-group text-center">
                    <p class="mb-0">Endereço</p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Estado</label>
                        <input type="text" name="uf" value="{{ $client->client->uf ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Cidade</label>
                        <input type="text" name="city" value="{{ $client->client->city ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Logradouro</label>
                        <input type="text" name="logradouro" value="{{ $client->client->logradouro ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Número</label>
                        <input type="text" name="number" value="{{ $client->client->number ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bairro</label>
                        <input type="text" name="bairro" value="{{ $client->client->bairro ?? '' }}"
                            class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>CEP</label>
                        <input type="text" name="cep" value="{{ $client->client->cep ?? '' }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="Alterar" class="form-control btn btn-success col-md-">
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Usuário</label>
                    <input type="text" disabled value="{{ $client->user ?? '' }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>E-mail</label>
                    <input type="text" disabled value="{{ $client->email ?? '' }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>CPF</label>
                    <input type="text" value="{{ $client->cpf ?? '' }}" disabled class="form-control">
                </div>
            </div>
        </div>
    </div>
    <hr>


@endsection
