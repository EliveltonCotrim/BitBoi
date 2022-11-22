@extends('admin.index_admin')
@section('title', 'Lançar Investimentos')

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
            <hr>

            <div class='row'>
                <div class='col-md-3'>
                    <div class="card p-2">
                        Valor Total:
                        @money($valor_total)
                    </div>
                </div>


                <div class='col-md-3'>
                    <div class="card p-2">
                        Quantidade:
                        {{ $qtd_coin }}
                    </div>
                </div>
            </div>

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
                        <th></th>
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
                        <td><?php echo $dado->purchese->time_pri; ?></td>
                        <td><?php echo $dado->dataConfirmacao; ?></td>
                        <td>
                            <a href='{{ route('lancar.investimento', $dado->id) }}' class='btn btn-light btn-sm'>
                                <span class='bx bx-edit'></span> Lançar
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            {{-- {{ $boletos->appends($filters)->links() }} --}}
        </div>
    </div>

@endsection
