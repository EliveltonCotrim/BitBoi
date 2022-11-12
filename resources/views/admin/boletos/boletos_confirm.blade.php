@extends('admin.index_admin')
@section('title', 'Boletos')

@section('actions')
<a href='<?php echo url('/admin/boletos/pendentes'); ?>' class='btn btn-primary'>
    Voltar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='col-md-12'>
            <div class='form-horizontal'>
                @include('commons/alerts')

                <div class='form-row'>
                    <div class='col-md-4'>
                        <label>Cliente</label>
                        <input type='text' readonly name='client_id' value='{{ $boleto->user->name }}' class='form-control' style="background: black;">
                    </div>
                    <div class='col-md-4'>
                        <label>Valor</label>
                        <input type='text' required name='cliente_plano_id' value='{{ $boleto->valor  }}' class='form-control' style="background: black;">
                    </div>
                </div>
                <br>

                <div class='form-row'>
                    <div class='col-md-4'>
                        <label>Tipo</label>
                        <input type='text' readonly name='client_id' value='{{ $boleto->tipo }}' class='form-control' style="background: black;">
                    </div>
                    <div class='col-md-4'>
                        <label>Status</label>
                        <input type='text' required name='cliente_plano_id' value='{{ $boleto->status  }}' class='form-control' style="background: black;">
                    </div>
                </div>
                <br>


                <div class='form-row'>
                    <div class='col-md-2'>
                        <label>Comprovante</label>
                        <a href="{{ url('admin/boletos/download',$boleto->id) }}" target="_blanck" class='form-control btn btn-primary'>
                            Baixar
                        </a>
                    </div>
                </div>


                <form action="" method='post'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-3'>
                            <label>&nbsp;</label>
                            <button type='submit' class='btn btn-success btn-block'>
                                Confirmar
                            </button>
                        </div>

                        <div class='col-md-3'>
                            <label>&nbsp;</label>
                            <a class='btn btn-danger btn-block'>
                                Rejeitar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection