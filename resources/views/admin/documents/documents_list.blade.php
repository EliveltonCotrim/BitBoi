@extends('admin.index_admin')
@section('title', 'Avaliação de Documentos')

@section('actions')
<a href='<?php echo url('admin/documents/create') ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>


        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($documents as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->client->name; ?></td>
                        <td>
                            <a href='<?php echo url('admin/documents/avaliation/' . $dado->cliente_id) ?>' class='btn btn-primary btn-xs'>
                                <span class='bx bx-edit'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
</div>

@endsection