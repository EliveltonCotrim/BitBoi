@extends('admin.index_admin')
@section('title', 'Balances')

@section('actions')
   <a href='<?php echo url('/admin/balances'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('balances.store') }}' method='post'>
                @csrf
                @include('admin.balances._partials.balances_form')
            </form>
        </div>
    </div>
</div>
@endsection

