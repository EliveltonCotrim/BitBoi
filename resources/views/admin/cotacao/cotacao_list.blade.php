@extends('admin.index_admin')
@section('title', 'Cotacao')

@section('actions')
<a href='<?php echo url('admin/cotacao/create') ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='row'>
            <div class='col-md-12'>
                <form action="{{ route('cotacao.search') }}" method='post'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>coin</label>
                            <input type='text' name='coin' value="{{ $filters['coin'] ?? '' }}" class='form-control'>
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
                    <th>Moeda</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cotacao as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->coin; ?></td>
                        <td><?php echo $dado->date->format('d/m/Y'); ?></td>
                        <td>@money($dado->value)</td>
                        <td>

                            <a href='<?php echo url('admin/cotacao/delete/' . $dado->id) ?>' class='btn btn-danger btn-sm'>
                                <span class='bx bx-trash'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $cotacao->links() }}
    </div>
</div>

@endsection