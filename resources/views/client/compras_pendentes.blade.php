@extends('client.compras')
@section('comp_pendentes', 'active')

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
                        <a href="{{ route('show.compra', $compra->id) }}" class="btn btn-primary btn-sm"><i
                                class='bx bx-detail'></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
