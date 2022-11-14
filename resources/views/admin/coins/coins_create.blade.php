@extends('admin.index_admin')
@section('title', 'Moeda')

@section('actions')
    <a href='{{ route('coins.index') }}' class='btn btn-primary'>
        Voltar
</a>@endsection

@section('content')
    <div class='card'>
        <div class='card-body'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='form-horizontal'>
                        <form action='{{ route('coins.store') }}' method='post'>
                            @csrf
                            @include('admin.coins.includes.coins_form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
