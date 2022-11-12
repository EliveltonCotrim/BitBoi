@extends('admin.index_admin')
@section('title', 'Payments')

@section('actions')
<a href='<?php echo url('admin/payments/create') ?>' class='btn btn-primary'>
Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
<div class='card-body'>

<div class='row'><div class='col-md-12'> 
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
               <th>Name</th> <th>Slug</th> <th>Logo</th> <th>Methods</th> <th>Status</th> <th>Token</th> <th>Data</th> <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($payments as $key => $dado) {
            ?>
                <tr>
                     <td><?php echo $dado->name; ?></td> <td><?php echo $dado->slug; ?></td> <td><?php echo $dado->logo; ?></td> <td><?php echo $dado->methods; ?></td> <td><?php echo $dado->status; ?></td> <td><?php echo $dado->token; ?></td> <td><?php echo $dado->data; ?></td>
                    <td>
                        <a href='<?php echo url('admin/payments/' . $dado->id.'/edit') ?>' class='btn btn-primary btn-xs'>
                            <span class='fa fa-edit'></span>
                        </a>
                        <a href='<?php echo url('admin/payments/' . $dado->id) ?>' class='btn btn-danger btn-xs'>
                            <span class='fa fa-trash'></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    {{ $payments->appends($filters)->links() }}
</div>
</div>

@endsection