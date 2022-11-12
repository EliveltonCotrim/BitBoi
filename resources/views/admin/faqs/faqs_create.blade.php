@extends('admin.index_admin')
@section('title', 'Faqs')

@section('actions')
   <a href='<?php echo url('/admin/faqs'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('faqs.store') }}' method='post'>
                @csrf
                @include('admin.faqs._partials.faqs_form')
            </form>
        </div>
    </div>
</div>
@endsection

