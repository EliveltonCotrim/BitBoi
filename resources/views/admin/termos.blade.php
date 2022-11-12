@extends('admin.index_admin')
@section('title','Termos')

@section('actions')

@endsection


@section('content')

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <h3>Termos</h3>


        <div class='row'>
            <div class='col-md-12'>
                <div class='form-horizontal'>
                    @include('commons/alerts')
                    <form action='' method='post'>
                        @csrf


                        <div class='form-row'>
                            <div class='col-md-8'>
                                <label>Termos</label>
                                <textarea name='termos' style="height: 200px;" required class='form-control'>{{ $param->termo_compra ?? old("pergunta")  }}</textarea>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='col-md-2'>
                                <label>&nbsp;</label>
                                <button type='submit' class='btn btn-primary form-control'>
                                    Salvar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection