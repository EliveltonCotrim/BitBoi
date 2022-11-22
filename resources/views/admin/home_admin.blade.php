@extends('admin.index_admin')
@section('title', '')

@section('content')
    <div class='row'>
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <div>
                            <p class="mb-0 font-weight-bold text-white">Total de Clientes</p>
                            <h2 class="mb-0 text-white">{{ \App\Models\UsersModel::where('type', 'client')->count() }}</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <div>
                            <p class="mb-0 font-weight-bold text-white">Pagamento do Dia</p>
                            <h2 class="mb-0 text-white">@money($valorTotalPagamentoDia)</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <div>
                            <p class="mb-0 font-weight-bold text-white">Pagamento do M&es</p>
                            <h2 class="mb-0 text-white">{{ \App\Models\UsersModel::where('type', 'client')->count() }}</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6'>
            <div class='card'>
                <div class="card-header">
                    <h4>Últimos Cadastros</h4>
                </div>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <form action="#" method='post'>
                                @csrf
                                <div class='form-row'>
                                    <div class='col-md-4'>
                                        {{-- <label>&nbsp;</label> --}}
                                        <input type='text' name='name' value="{{ $filters['name'] ?? '' }}"
                                            class='form-control' placeholder="Cliente">
                                    </div>
                                    <div class='col-md-3'>
                                        {{-- <label>&nbsp;</label> --}}
                                        <input type='submit' value='Pesquisar' class='form-control btn btn-primary'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <table class='table table-bordered table-striped table-sm'>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='card'>
                <div class="card-header">
                    <h4>Últimos Pagamentos</h4>
                </div>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <form action="{{ route('las.pays.search') }}" method='post'>
                                @csrf
                                <div class='form-row'>
                                    <div class='col-md-4'>
                                        {{-- <label>&nbsp;</label> --}}
                                        <input type='text' name='name' value="{{ $filters['name'] ?? '' }}"
                                            class='form-control' placeholder="Cliente">
                                    </div>
                                    <div class='col-md-3'>
                                        {{-- <label>&nbsp;</label> --}}
                                        <input type='submit' value='Pesquisar' class='form-control btn btn-primary'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <table class='table table-bordered table-striped table-sm'>
                        @foreach ($pays as $pay)
                            <tr>
                                <td>{{ $pay->user->name }}</td>
                                <td>{{ $pay->meioPagamento }}</td>
                                <td>{{ $pay->dataConfirmacao }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
