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
                    <form action="{{ route('lancar.investimentos.search') }}" method='post'>
                        @csrf
                        <div class='form-row mt-2'>
                            <div class='col-md-3'>
                                <label>Data de lançamento</label>
                                <input type='date' name='dt_lancamento' value="{{ $filters['dt_lancamento'] ?? $dt_atual }}"
                                    class='form-control'>
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
                            @money($valor_total)
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
                        @endif

                        @if (isset($filters['dt_lancamento']))
                            <input type="hidden" name="dt" value="{{ Crypt::encrypt($filters['dt_lancamento']) }}">
                        @else
                            <input type="hidden" name="dt" value="{{ Crypt::encrypt($dt_atual) }}">
                        @endif
                    </div>

                </div>
            </form>

            <table class='table table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>TX ID</th>
                        <th>Status</th>
                        <th>Meio</th>
                        <th>Tempo PRI</th>
                        <th>Data de <br> Confirmação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($pays_day as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->user->name; ?></td>
                        <td>@money($dado->valor)</td>
                        <td><?php echo $dado->transaction_id; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td><?php echo $dado->meioPagamento; ?></td>
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
