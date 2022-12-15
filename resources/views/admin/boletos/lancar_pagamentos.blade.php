@extends('admin.index_admin')
@section('title', 'Lançar Pagamentos')

@section('actions')
    <a href='{{ url('admin/boletos') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>

            <div class='row'>
                <div class='col-md-12'>
                    <form action="{{ route('search.rendimentos') }}" method='post'>
                        @csrf
                        <div class='form-row mt-2'>
                            <div class='col-md-3'>
                                <label>Data de lançamento</label>
                                <input type='date' name='dt_lancamento' max="9999-01-01"
                                    value="{{ $filters['dt_lancamento'] ?? '' }}" class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <input type='submit' name="pesquisar" value='pesquisar' class='form-control btn btn-light'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <form action="{{ route('larcar.rendimentos') }}" method="post">
                @csrf
                <div class='row'>
                    <div class='col-md-3'>
                        <div class="card p-2">
                            Valor Total:
                            @money($rendimentoTotal)
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class="card p-2">
                            Quantidade de Moedas:
                            {{ $qtd_coin }}
                        </div>
                    </div>
                    <div class='col-md-2'>
                        @if (!empty($pays_day))
                            <input type='submit' value='Lançar' class='form-control btn btn-primary'>
                            <input type="hidden" name="dt" value="{{ Crypt::encrypt($filters['dt_lancamento']) }}">
                        @endif
                    </div>
                </div>
            </form>

            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor Investido</th>
                        <th>Percentual de rendimento</th>
                        <th>Rendimento</th>
                        <th>Data da Compra</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pays_day as $key => $dado)
                        <tr>
                            <td><?php echo $dado->user->name; ?></td>
                            <td>@money($dado->valor)</td>
                            @if ($dado->purchase->coin_id)
                                <td>@money2($dado->purchase->coin->profit_percentage) %</td>
                            @else
                                <td>@money2($dado->purchase->plan->coin->profit_percentage) %</td>
                            @endif
                            <td>@money($dado->rendimento_atual)</td>
                            <td>{{ date('d-m-Y', strtotime($dado->dataConfirmacao)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $pays_day->links() }} --}}
        </div>
    </div>

@endsection
