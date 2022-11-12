@extends('admin.index_admin')
@section('title', 'Payments')

@section('actions')
   <a href='<?php echo url('/admin/payments'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


   
    <div class='col-md-12'>
        <div class='form-horizontal'>
        @include('commons/alerts')
        <form action="{{ route('payments.update',$payments->id) }}" method='post'>
            @csrf
            @method('PUT')

            @include('admin.payments._partials.payments_form')
        </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection

