@extends('admin.index_admin')
@section('title', 'Client_plan')

@section('actions')
<a href='<?php echo url('admin/client_plan/create') ?>' class='btn btn-primary'>
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
    <hr>

    <table class='table table-bordered table-hover'>
        <thead>
            <tr>
               <th>Client_id</th> <th>Plan_id</th> <th>Renovation</th> <th>Expiration</th> <th>Status</th> <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($client_plan as $key => $dado) {
            ?>
                <tr>
                     <td><?php echo $dado->client_id; ?></td> <td><?php echo $dado->plan_id; ?></td> <td><?php echo $dado->renovation; ?></td> <td><?php echo $dado->expiration; ?></td> <td><?php echo $dado->status; ?></td>
                    <td>
                        <a href='<?php echo url('admin/client_plan/' . $dado->id.'/edit') ?>' class='btn btn-primary btn-xs'>
                            <span class='fa fa-edit'></span>
                        </a>
                        <a href='<?php echo url('admin/client_plan/' . $dado->id) ?>' class='btn btn-danger btn-xs'>
                            <span class='fa fa-trash'></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    {{ $client_plan->appends($filters)->links() }}
</div>
</div>

@endsection