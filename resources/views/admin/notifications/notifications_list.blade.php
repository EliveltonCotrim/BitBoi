@extends('admin.index_admin')
@section('title', 'Notificações Para Os Clientes')

@section('actions')
<a href='<?php echo url('admin/notifications/create') ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($notifications as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->title; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td>
                            <a href='<?php echo url('admin/notifications/' . $dado->id . '/edit') ?>' class='btn btn-primary btn-sm'>
                                <span class='bx bx-edit'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $notifications->links() }}
    </div>
</div>
</div>

@endsection