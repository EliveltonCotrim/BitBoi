@extends('admin.index_admin')
@section('title', 'Pagamentos do Dia')

@section('actions')
    <a href='{{ url('admin/boletos') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>

            {{-- <div class='row'>
                <div class='col-md-12'>
                    <form action="" method='get'>
                        @csrf
                        <div class='form-row mt-2'>
                            <div class='col-md-3'>
                                <label>Cliente</label>
                                <input type='text' name='name_client' value="{{ $filters['name_client'] ?? '' }}"
                                    class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <input type='submit' value='Pesquisar' class='form-control btn btn-light'>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <hr> --}}
            <form action="{{ route('larcar.rendimentos') }}" method="post">
                <div class='row'>
                    @csrf
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
                            <input type="hidden" name="dt" value="{{ Crypt::encrypt($dt_atual) }}">
                            <input type='submit' value='Lançar' class='form-control btn btn-primary'>
                        @endif
                    </div>

                </div>
            </form>

            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Moeda/Pacote</th>
                        <th>Percentual de Lucro</th>
                        <th>Rendimento</th>
                        <th>Quantidade Moedas</th>
                        <th>Tempo</th>
                        <th>Data de <br> Confirmação da Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($pays_day as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->user->name; ?></td>
                        <td>@money($dado->valor)</td>
                        @if ($dado->purchase->coin_id)
                            <td>{{ $dado->purchase->coin->name }}</td>
                        @else
                            <td>{{ $dado->purchase->plan->name }}</td>
                        @endif
                        @if ($dado->purchase->coin_id)
                            <td>@money2($dado->purchase->coin->profit_percentage) %</td>
                        @else
                            <td>@money2($dado->purchase->plan->coin->profit_percentage) %</td>
                        @endif
                        <td>@money($dado->rendimento_atual)</td>
                        <td><?php echo $dado->purchase->quantity_boi; ?></td>
                        <td>{{ $dado->purchase->time_pri }} {{ $dado->purchase->time_pri = 1 ? 'mês' : 'meses' }}</td>

                        <td><?php echo $dado->dataConfirmacao; ?></td>
                        {{-- <td>
                            <a href='{{ route('lancar.investimento', $dado->id) }}' class='btn btn-light btn-sm'>
                                <span class='bx bx-edit'></span> Lançar
                            </a>
                        </td> --}}
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            {{-- {{ $pays_day->links() }} --}}
        </div>
    </div>

@endsection
