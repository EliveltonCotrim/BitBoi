@extends('client.index_client')
@section('title', 'Compra')
@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-success rounded'>
        Voltar
    </a>
@endsection
@section('content')

    <div class="card radius-15">
        <div class="card-body">
            {{-- <div class="card-title">
                <h4 class="mb-0">Bootstrap Collapse</h4>
            </div>
            <hr /> --}}
            <p> <a class="btn btn-primary" data-toggle="collapse" href="#compra" role="button" aria-expanded="false"
                    aria-controls="compra">
                    Compra
                </a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#rendimentos"
                    aria-expanded="false" aria-controls="rendimentos">Rendimentos</button>
            </p>
            <div class="collapse show" id="compra">
                <div class="card card-body">
                    <div class="card-title">
                        <h5 class="mb-0">Compra</h5>
                    </div>
                    <hr />
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label>ID</label>
                            <input type="text" name="id" value="{{ $purchases->id }}" class="form-control" readonly>
                        </div>
                        @isset($purchases->plan_id)
                        <div class="form-group col-md-2">
                            <label>Plano</label>
                            <input type="text" name="phone" value="{{ $purchases->plan->name }}" class="form-control" readonly>
                        </div>
                        @endisset
                        @isset($purchases->coin_id)
                        <div class="form-group col-md-2">
                            <label>Moeda</label>
                            <input type="text" name="coin" value="{{ $purchases->coin->name }}" class="form-control" readonly>
                        </div>
                        @endisset
                        <div class="form-group col-md-2">
                            <label>Valor Total</label>
                            <input type="text" name="value" value="@money($purchases->value_total)" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Percentual de Rendimento</label>
                            <input type="text" name="p_rendimento" value="@money2($purchases->percentual_rendimento )%" class="form-control" readonly>
                        </div>

                    </div>
                    <hr>
                </div>
            </div>
            <div class="collapse" id="rendimentos">
                <div class="card card-body">
                    <div class="card-title">
                        <h5 class="mb-0">Rendimentos</h5>
                    </div>
                    <hr />

                    <table class='table table-bordered table-striped '>
                        <thead>
                            <tr>
                                <th>Valor</th>
                                <th>Data Lançamento</th>
                            </tr>
                        </thead>
                        @foreach ($boleto->rendimentosPagos as $rendimento)
                            <tr>
                                <td>@money($rendimento->valor)</td>
                                <td>{{ date('d-m-Y', strtotime($rendimento->rendimentos->dt_lacamento)) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
