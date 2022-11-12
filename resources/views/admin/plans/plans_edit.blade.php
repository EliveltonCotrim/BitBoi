@extends('admin.index_admin')
@section('title', 'Planos')

@section('actions')
<a href='<?php echo url('/admin/plans'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>



        <div class='col-md-12'>
            <div class='form-horizontal'>
                @include('commons/alerts')
                <form action="{{ route('plans.update',$plans->id) }}" method='post'>
                    @csrf
                    @method('PUT')

                    @include('admin.plans._partials.plans_form')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection