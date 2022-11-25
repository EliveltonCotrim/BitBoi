@extends('admin.saques.saques')
@section('sac_pendentes', 'active')

@section('content_admin')
    <div class="table-responsive">
        <table class='table table-bordered table-striped table-hover  table-sm'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor Total</th>
                    <th>Moeda</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            @foreach ($saques as $saque)
                <tr>
                    <td>{{ $saque->id }}</td>
                    <td>@money($saque->valor)</td>
                    <td>{{ $saque->moeda }}</td>
                    <td>{{ $saque->status }}</td>
                    <td>
                        <a href="{{ route('saque.edit', $saque->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
                            data-placement="left" data-title="Confirmar"><i class='bx bx-check-square'></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $saques->links() }}

    </div>
@endsection
