@extends('admin.index_admin')
@section('title', 'Client_plan')

@section('actions')
   <a href='<?php echo url('/admin/client_plan'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('client_plan.store') }}' method='post'>
                @csrf
                @include('admin.client_plan._partials.client_plan_form')
            </form>
        </div>
    </div>
</div>
@endsection

