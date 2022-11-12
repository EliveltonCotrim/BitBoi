@extends('admin.index_admin')
@section('title', 'Parameters')

@section('actions')
@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='row'>
            <div class='col-md-12'>
                <form action="{{ route('parameters.search') }}" method='post'>
                    @csrf
                    <div class='form-row'>
                        <div class='col-md-2'>
                            <label>title</label>
                            <input type='text' name='title' value="{{ $filters['title'] ?? '' }}" class='form-control'>
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
                    <th>Title</th>
                    <th>Logo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($parameters as $key => $dado) {
                ?>
                    <tr>
                        <td><?php echo $dado->title; ?></td>
                        <td><?php echo $dado->logo; ?></td>
                        <td>
                            <a href='<?php echo url('admin/parameters/' . $dado->id . '/edit') ?>' class='btn btn-primary btn-xs'>
                                <span class='fa fa-edit'></span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        {{ $parameters->links() }}
    </div>
</div>
</div>

@endsection