@extends('client.index_client')
@section('title','Alterar Senha')

@section('actions')
<a href='<?php echo url('client/meus_dados'); ?>' class='btn btn-primary'>
    Voltar
</a>
@endsection


@section('content')


<div class="form-body">
    <div class="row">
        <div class="col-md-4 border-right">
            <form action="{{ url('client/password/store') }}" method="post">
                @csrf

                <div class="form-group">
                    <div class="col-md-12">
                        <label>Senha Atual</label>
                        <input name="now" autofocus type="password" required value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Nova Senha</label>
                        <input name="new" type="password" required value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Confirma Nova Senha</label>
                        <input name="again" type="password" required value="" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-4">
                        <label>&nbsp;</label>
                        <input type="submit" value="Alterar Senha" class="form-control btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection