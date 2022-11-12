@extends('client.index_client')

@section('title','Depósitar R$')
@section('menu_depositos','active')

@section('actions')
<a href="{{ url('client/depositos') }}" class="btn btn-primary btn-rounded">
    Voltar
</a>
@endsection

@section('content')

<div class="card ">

    <div class="card-body">

        <form action="" method="post">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label>Valor</label>
                    <input name="valor" autofocus type="text" placeholder="0,00" required class="form-control moeda">
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <input type="submit" value="Depositar" class="form-control btn btn-primary">
                </div>
            </div>

        </form>

    </div>
</div>

@endsection