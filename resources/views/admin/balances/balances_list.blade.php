@extends('admin.index_admin')
@section('title', 'Balances')

@section('actions')
<a href='<?php echo url('admin/balances/create') ?>' class='btn btn-primary'>
Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
<div class='card-body'>

<div class='row'><div class='col-md-12'> 
            <form action="{{ route('balances.search') }}" method='post'>
                @csrf
                <div class='form-row'>
                    <div class='col-md-2'>
                        <label>cliente_id</label>
                        <input type='text' name='cliente_id' value="{{ $filters['cliente_id'] ?? '' }}" class='form-control'>
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
               <th>Cliente_id</th> <th>Reference</th> <th>Type</th> <th>Operation</th> <th>Moeda</th> <th>Rede</th> <th>Value</th> <th>CourentBalance</th> <th>PreviousBalance</th> <th>Observation</th> <th>Stats</th> <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($balances as $key => $dado) {
            ?>
                <tr>
                     <td><?php echo $dado->cliente_id; ?></td> <td><?php echo $dado->reference; ?></td> <td><?php echo $dado->type; ?></td> <td><?php echo $dado->operation; ?></td> <td><?php echo $dado->moeda; ?></td> <td><?php echo $dado->rede; ?></td> <td><?php echo $dado->value; ?></td> <td><?php echo $dado->courentBalance; ?></td> <td><?php echo $dado->previousBalance; ?></td> <td><?php echo $dado->observation; ?></td> <td><?php echo $dado->stats; ?></td>
                    <td>
                        <a href='<?php echo url('admin/balances/' . $dado->id.'/edit') ?>' class='btn btn-primary btn-xs'>
                            <span class='fa fa-edit'></span>
                        </a>
                        <a href='<?php echo url('admin/balances/' . $dado->id) ?>' class='btn btn-danger btn-xs'>
                            <span class='fa fa-trash'></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    {{ $balances->links() }}
</div>
</div>
</div>

@endsection