@extends('admin.index_admin')
@section('title', 'Planos')

@section('actions')
<a href='<?php echo url('admin/plans/create') ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='row'>
            <div class='col-md-12'>
                <form action="" method='get'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>name</label>
                            <input type='text' name='name' value="{{ $filters['name'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                            <input type='submit' value='Pesquisar' class='form-control btn btn-primary'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Plano</th>
                    <th>Valor</th>
                    <th>Visibilidade Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($plans as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->name; ?></td>
                        <td>@money($dado->value)</td>
                        <td><?php echo $dado->status; ?></td>
                        <td>
                            <a href='<?php echo url('admin/plans/' . $dado->id . '/edit') ?>' class='btn btn-primary btn-sm'>
                                <span class='bx bx-edit'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $plans->appends($filters)->links() }}
    </div>
</div>

@endsection