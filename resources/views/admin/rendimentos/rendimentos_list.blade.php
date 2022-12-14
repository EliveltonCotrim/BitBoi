@extends('admin.index_admin')
@section('title', 'Rendimentos')

{{-- @section('actions')
<a href='<?php echo url('admin/plans/create'); ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection --}}

@section('content')

    <div class='card'>
        <div class='card-body'>

            <div class='row'>
                <div class='col-md-12'>
                    <form action="" method='get'>
                        @csrf
                        <div class='form-row'>
                            <div class='col-md-2'>
                                <label>Cliente</label>
                                <input type='text' name='name' placeholder="Nome" value="{{ $filters['name'] ?? '' }}"
                                    class='form-control'>
                            </div>
                            <div class='col-md-2'>
                                <label>Data Lançamento</label>
                                <input type='date' name='data' value="{{ $filters['data'] ?? '' }}"
                                    class='form-control'>
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
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Data lançamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($rendimentos as $key => $rendimento) {
                ?>
                    <tr>
                        <td>{{ $rendimento->boleto->user->name }}</td>
                        <td>@money($rendimento->valor)</td>
                        <td>{{ date('d-m-Y', strtotime($rendimento->rendimentos->dt_lacamento)) }} </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            {{ $rendimentos->appends($filters)->links() }}
        </div>
    </div>

@endsection
