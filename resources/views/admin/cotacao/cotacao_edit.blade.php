@extends('admin.index_admin')
@section('title', 'Cotacao')

@section('actions')
<a href='<?php echo url('/admin/cotacao'); ?>' class='btn btn-primary'>
    Voltar
</a>@endsection

@section('content')

<div class='card'>
    <div class='card-body'>

        <div class='col-md-12'>
            <div class='form-horizontal'>
                @include('commons/alerts')
                <form action="{{ route('cotacao.update',$cotacao->id) }}" method='post'>
                    @csrf
                    @method('PUT')

                    @include('admin.cotacao._partials.cotacao_form')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection