@extends('admin.index_admin')
@section('title', 'Parameters')

@section('actions')
<a href='<?php echo url('/admin/parameters'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>


        <div class='row'>
            <div class='col-md-12'>
                <div class='form-horizontal'>
                    @include('commons/alerts')
                    <form action='{{ route('parameters.store') }}' method='post'>
                        @csrf
                        @include('admin.parameters._partials.parameters_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection