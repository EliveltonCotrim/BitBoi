@extends('client.index_client')
@section('title', 'Alterar Senha')

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
                        <label>Nova Senha</label>
                        <div class="col-md-12  input-group">
                            <input name="new" type="password" required value="" class="form-control">
                            <div class="input-group-append"> <a href="javascript:;"
                                    class="input-group-text border-left-0"><i class='bx bx-hide'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirma Nova Senha</label>
                        <div class="col-md-12 input-group" id="show_hide_password">
                            <input name="again" type="password" required value="" class="form-control">
                            <div class="input-group-append"> <a href="javascript:;"
                                    class="input-group-text border-left-0"><i class='bx bx-hide'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7">
                            <label>&nbsp;</label>
                            <input type="submit" value="Alterar Senha" class="form-control btn btn-success">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Senha*</label>
                        <div class="input-group" id="show_hide_password">
                            <input name="password" value="{{ old('password') }}" required
                                class="form-control border-right-0" type="password" value="12345678">
                            <div class="input-group-append"> <a href="javascript:;"
                                    class="input-group-text border-left-0"><i class='bx bx-hide'></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
