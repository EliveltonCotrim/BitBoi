@extends('admin.index_admin')
@section('title', 'Moeedas')

@section('actions')
    <a href='{{ route('coins.index') }}' class='btn btn-primary'>
        Voltar
</a>@endsection

@section('content')

    <div class='card'>
        <div class='card-body'>
            <div class='col-md-12'>
                <div class='form-horizontal'>
                    <form action="{{ route('coin.update', $coin->id) }}" method='post'>
                        @csrf
                        @method('PUT')
                        @include('admin.coins.includes.coins_form_edit')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
