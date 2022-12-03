@extends('client.compras')
@section('comp_confirmadas', 'active')

@section('content_client')
    <div class="table-responsive">
        <table class='table table-bordered table-striped table-sm'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Plano</th>
                    <th>Moeda</th>
                    <th>Valor Total</th>
                    <th>Data Compra</th>
                    <th>Ações</th>
                </tr>
            </thead>
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->status }}</td>
                    @if (isset($compra->plan_id))
                        <th>{{ $compra->plan->name }}</th>
                    @else
                        <th></th>
                    @endif
                    @if (isset($compra->coin_id))
                        <th>{{ $compra->coin->name }}</th>
                    @else
                        <th></th>
                    @endif
                    <td>@money($compra->value_total)</td>
                    <th>{{ date('d-m-Y', strtotime($compra->created_at)) }}</th>
                    <td>
                        <a href="{{ route('show.compra', $compra->id) }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="bottom" title="Detalhes"><i
                                class='bx bx-detail'></i></a>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cancelarCompra{{ $compra->id }}" data-toggle="tooltip" data-placement="bottom" title="Cancelar"><i
                                class='bx bx-x-circle'></i></a>

                    </td>
                    @include('client.includes.modal_cancelar_compra')
                </tr>
            @endforeach
        </table>
    </div>
@endsection
