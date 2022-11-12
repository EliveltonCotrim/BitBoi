@extends('admin.index_admin')
@section('title', 'Payments')

@section('actions')
   <a href='<?php echo url('/admin/payments'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


<div class='row'>
    <div class='col-md-12'>
        <div class='form-horizontal'>
            @include('commons/alerts')
            <form action='{{ route('payments.store') }}' method='post'>
                @csrf
                @include('admin.payments._partials.payments_form')
            </form>
        </div>
    </div>
</div>
@endsection

