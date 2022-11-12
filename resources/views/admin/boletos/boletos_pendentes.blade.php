@extends('admin.index_admin')
@section('title', 'Pagamentos Pendentes')

@section('actions')
<!-- <a href='<?php echo url('admin/boletos/create') ?>' class='btn btn-primary'>
    Cadastrar
</a> -->
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <!-- <div class='row'>
            <div class='col-md-12'>
                <form action="{{ route('boletos.search') }}" method='post'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>client_id</label>
                            <input type='text' name='client_id' value="{{ $filters['client_id'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                            <input type='submit' value='Pesquisar' class='form-control btn btn-primary'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr> -->


        Total: {{ $boletos->count() }}
        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>ID PGTO</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>TX ID</th>
                    <th>Status</th>
                    <th>Data de <br> Criação</th>
                    <th>Meio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($boletos as $key => $dado) {
                ?>

                    <tr>
                        <td><?php echo $dado->id; ?></td>
                        <td>
                            <?php echo $dado->user->id; ?> -
                            <?php echo $dado->user->name; ?>
                        </td>
                        <td>@money($dado->valor)</td>
                        <td><?php echo $dado->transaction_id; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td><?php echo $dado->created_at; ?></td>
                        <td><?php echo $dado->meioPagamento; ?></td>
                        <td>
                            <a href='<?php echo url('admin/boletos/confirm/' . $dado->id) ?>' class='btn btn-light btn-sm'>
                                <span class='bx bx-edit'></span> Editar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

@endsection