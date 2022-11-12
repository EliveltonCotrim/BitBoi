@extends('admin.index_admin')
@section('title', 'Users')

@section('actions')
<a href='<?php echo url('/admin/users'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>


        <div class='row'>
            <div class='col-md-12'>
                <div class='form-horizontal'>
                    @include('commons/alerts')
                    <form action='{{ route('users.store') }}' method='post'>
                        @csrf
                        @include('admin.users._partials.users_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection