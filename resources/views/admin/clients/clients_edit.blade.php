@extends('admin.index_admin')
@section('title', 'Clients')

@section('actions')
   <a href='<?php echo url('/admin/clients'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


   
    <div class='col-md-12'>
        <div class='form-horizontal'>
        @include('commons/alerts')
        <form action="{{ route('clients.update',$clients->id) }}" method='post'>
            @csrf
            @method('PUT')

            @include('admin.clients._partials.clients_form')
        </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection

