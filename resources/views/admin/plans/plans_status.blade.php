@extends('admin.index_admin')
@section('title', 'Financeiro')

@section('actions')
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='row'>
            <div class='col-md-12'>
                <form action="" method='get'>
                    @csrf
                    <div class='form-row'>
                        <!-- <div class='col-md-3'>
                            <label>Nome</label>
                            <input type='text' name='name' value="{{ $filters['name'] ?? '' }}" class='form-control'>
                        </div> -->


                        <div class='col-md-2'>
                            <label>Status</label>

                            <select name="status" id="" class="form-control">
                                <option value="{{ ($filters['status']) }}">{{ ucfirst($filters['status']) }}</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="todos">Todos</option>
                            </select>

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
        Total: {{ $plans->total() }}
        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>renovation</th>
                    <th>expiration</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($plans as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->client->name; ?></td>
                        <td><?php echo $dado->renovation; ?></td>
                        <td><?php echo $dado->expiration; ?></td>
                        <td>
                            <!-- <a href='<?php echo url('admin/plans/' . $dado->id . '/edit') ?>' class='btn btn-primary btn-sm'>
                                <span class='bx bx-edit'></span>
                            </a> -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $plans->appends($filters)->links() }}
    </div>
</div>

@endsection