@extends('admin.index_admin')
@section('title', 'Faqs')

@section('actions')
<a href='<?php echo url('admin/faqs/create') ?>' class='btn btn-primary'>
    Cadastrar
</a>
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='row'>
            <div class='col-md-12'>
                <form action="{{ route('faqs.search') }}" method='post'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>pergunta</label>
                            <input type='text' name='pergunta' value="{{ $filters['pergunta'] ?? '' }}" class='form-control'>
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
                    <th>Pergunta</th>
                    <th>Resposta</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($faqs as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->pergunta; ?></td>
                        <td><?php echo $dado->resposta; ?></td>
                        <td><?php echo $dado->status; ?></td>
                        <td>
                            <a href='<?php echo url('admin/faqs/' . $dado->id . '/edit') ?>' class='btn btn-primary btn-xs'>
                                <span class='fa fa-edit'></span>
                            </a>
                            <a href='<?php echo url('admin/faqs/' . $dado->id) ?>' class='btn btn-danger btn-xs'>
                                <span class='fa fa-trash'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $faqs->links() }}
    </div>
</div>
</div>

@endsection