@extends('admin.index_admin')
@section('title', 'Clients')

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
                        <div class='col-md-1'>
                            <label>ID</label>
                            <input type='text' name='id' value="{{ $filters['id'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-4'>
                            <label>Nome</label>
                            <input type='text' name='name' value="{{ $filters['name'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-2'>
                            <label>Nick</label>
                            <input type='text' name='user' value="{{ $filters['user'] ?? '' }}" class='form-control'>
                        </div>
                        <div class='col-md-2'>
                            <label>E-mail</label>
                            <input type='text' name='email' value="{{ $filters['email'] ?? '' }}" class='form-control'>
                        </div>
                    </div>
                    <div class='form-row'>

                        <div class='col-md-3'>
                            <label>CPF</label>
                            <input type='text' name='cpf' value="{{ $filters['cpf'] ?? '' }}" class='form-control cpf'>
                        </div>

                        <div class="col-md-3">
                            <label for="">Status do Plano</label>
                            <select name="status" class="form-control">
                                @if(isset($filters['status']))
                                <option value="{{ $filters['status'] }}">{{ ucfirst($filters['status']) }}</option>
                                @endif
                                <option value="todos">Todos</option>
                                <option value="ativos">Ativos</option>
                                <option value="inativos">Inativos</option>
                                <option value="nao_pagos">Nao_pagos</option>
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
        Total: {{ $clients->total() }}
        <table class='table table-bordered table-hover table-striped table-xs table-condensed'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nick</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clients as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->id; ?></td>
                        <td><?php echo $dado->name; ?></td>
                        <td><?php echo $dado->user; ?></td>
                        <td><?php echo $dado->email; ?></td>
                        <td>
                            <a href='<?php echo url('admin/clients/financeiro/' . $dado->id) ?>' class='btn btn-light btn-sm'>
                                <span class='fa fa-edit bx bx-edit'></span>
                            </a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        {{ $clients->appends($filters)->links() }}
    </div>
</div>

@endsection