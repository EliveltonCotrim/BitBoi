@extends('admin.index_admin')
@section('title', 'Files')

@section('actions')
<a href='<?php echo url('/admin/files'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='form-horizontal'>
                    @include('commons/alerts')
                    <form action='{{ route('files.store') }}' method='post' enctype="multipart/form-data">
                        @csrf
                        @include('admin.files._partials.files_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection