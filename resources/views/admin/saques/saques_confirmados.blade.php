@extends('admin.saques.saques')
@section('sac_confirmadas', 'active')

@section('content_admin')
    <div class='row mt-2'>
        <div class='col-md-12 p-0'>
            <form action="{{ route('search.saques.confirmados') }}" method='post'>
                @csrf
                <div class='form-row'>
                    <div class='col-md-3'>
                        {{-- <label>Cliente</label> --}}
                        <input type='text' name='name' placeholder="Cliente" value="{{ $filters['name'] ?? '' }}"
                            class='form-control'>
                    </div>
                    <div class='col-md-2'>
                        {{-- <label>&nbsp;</label> --}}
                        <input type='submit' name="search" value='Pesquisar' class='form-control btn btn-primary'>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive mt-3">
            <table class='table table-bordered table-striped table-hover table-sm'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Moeda</th>
                        <th>Data de Pagemento</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach ($saques as $saque)
                    <tr>
                        <td>{{ $saque->id }}</td>
                        <td>{{ $saque->client->name }}</td>
                        <td>@money($saque->valor)</td>
                        <td>{{ $saque->moeda }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($saque->data_pagamento)) }}</td>
                        <td>{{ $saque->status }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $saques->appends($filters)->links() }}

        </div>
    </div>

@endsection
