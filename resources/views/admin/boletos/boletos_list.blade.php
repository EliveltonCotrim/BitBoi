@extends('admin.index_admin')
@section('title', 'Pagamento')

@section('actions')
<!-- <a href='<?php echo url('admin/boletos/create') ?>' class='btn btn-primary'>
    Cadastrar
</a> -->
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
                            <label>Data Inicial</label>
                            <input type='date' name='start' value="{{ $filters['start'] ?? '' }}" class='form-control'>
                        </div>

                        <div class='col-md-3'>
                            <label>Data Final</label>
                            <input type='date' name='end' value="{{ $filters['end'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                            <input type='submit' value='Pesquisar' class='form-control btn btn-light'>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                            <a href="{{ url('admin/boletos/pdf?' .http_build_query($filters)) }}" class='form-control btn btn-light' target="_blanck">
                                <span class="bx bxs-file-pdf"></span>
                                PDF
                            </a>
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
                    {{ $boletos->total() }}
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
                    <th>Data de <br> Confirmação</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($boletos as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->user->name; ?></td>
                        <td>@money($dado->valor)</td>
                        <td><?php echo $dado->transaction_id; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td><?php echo $dado->meioPagamento; ?></td>
                        <td><?php echo $dado->dataConfirmacao; ?></td>
                        <td>
                            <a href='<?php echo url('admin/boletos/confirm/' . $dado->id) ?>' class='btn btn-light btn-sm'>
                                <span class='bx bx-edit'></span> Editar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $boletos->appends($filters)->links() }}
    </div>
</div>

@endsection