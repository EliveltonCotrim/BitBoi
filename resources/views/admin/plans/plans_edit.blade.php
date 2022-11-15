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
                <form action="{{ route('plans.update', $plan->id) }}" method='post'>
                    @csrf
                    @method('PUT')

                    @include('admin.plans._partials.plans_form_edit')
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
