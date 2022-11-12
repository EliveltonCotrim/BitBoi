@extends('admin.clients.clients_panel')
@section('tab_financeiro','active')

@section('content_client')

<div class='form'>

    <div class="form-row">
        <div class="col-md-3">
            <label for="">Status Atual</label>
            <input disabled value="{{ $boleto->status }}" type="text" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="">Valor</label>
            <input disabled value="@money($boleto->valor)" type="text" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="">Meio</label>
            <input disabled value="{{ $boleto->meioPagamento }}" type="text" class="form-control">
        </div>


    </div>
</div>
<br>
<form action="" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-4">
            <label for="">Novo Status</label>
            <x-select name="status" selected="" :options="['reembolsado'=>'Reembolsado', 'pendente'=>'Pendente','pago'=>'pago','cancelado'=>'Cancelado','estornado'=>'Estornado']" required='true' />
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