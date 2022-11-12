@extends('admin.index_admin')
@section('title', 'Documents')

@section('actions')
   <a href='<?php echo url('/admin/documents'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('documents.store') }}' method='post'>
                @csrf
                @include('admin.documents._partials.documents_form')
            </form>
        </div>
    </div>
</div>
@endsection

