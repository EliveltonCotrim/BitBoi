@extends('admin.index_admin')
@section('title', 'Boletos')

@section('content')

<div class='card'>
    <div class='card-body'>

        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($boletos as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->clientePlano->cliente->name; ?></td>
                        <td><?php echo $dado->tipo; ?></td>
                        <td><?php echo $dado->valor; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td><?php echo $dado->created_at; ?></td>
                        <td>
                            <a href='<?php echo url('admin/boletos/confirm/' . $dado->id) ?>' class='btn btn-primary btn-rounded btn-xs'>
                                <span class='bx bxs-edit'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

@endsection