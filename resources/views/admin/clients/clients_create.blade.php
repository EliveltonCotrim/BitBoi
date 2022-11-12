@extends('admin.index_admin')
@section('title', 'Clients')

@section('actions')
   <a href='<?php echo url('/admin/clients'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('clients.store') }}' method='post'>
                @csrf
                @include('admin.clients._partials.clients_form')
            </form>
        </div>
    </div>
</div>
@endsection

