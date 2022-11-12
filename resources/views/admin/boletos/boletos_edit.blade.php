@extends('admin.index_admin')
@section('title', 'Boletos')

@section('actions')
<a href='<?php echo url('/admin/boletos'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>



        <div class='col-md-12'>
            <div class='form-horizontal'>
                @include('commons/alerts')
                <form action="{{ route('boletos.update',$boletos->id) }}" method='post'>
                    @csrf
                    @method('PUT')

                    @include('admin.boletos._partials.boletos_form')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection