@extends('admin.index_admin')
@section('title', 'Notifications')

@section('actions')
   <a href='<?php echo url('/admin/notifications'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>


   
    <div class='col-md-12'>
        <div class='form-horizontal'>
        @include('commons/alerts')
        <form action="{{ route('notifications.update',$notifications->id) }}" method='post'>
            @csrf
            @method('PUT')

            @include('admin.notifications._partials.notifications_form')
        </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection

