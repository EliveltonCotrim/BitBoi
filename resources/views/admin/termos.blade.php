@extends('admin.index_admin')
@section('title', 'Termos')

{{-- @section('actions')

@endsection --}}


@section('content')

    {{-- <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-md-12'>
                    <div class='form-horizontal'>
                        @include('commons/alerts')
                        <form action='' method='post'>
                            @csrf
                            <div class='form-row'>
                                <div class='col-md-8'>
                                    <label>Termos</label>
                                    <textarea name='termos' style="height: 200px;" required class='form-control'>{{ $param->termo_compra ?? old('pergunta') }}</textarea>
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
    </div> --}}
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card radius-15">
                <div class="p-5">
                    <form  action="{{ route('termos.store') }}" method="post">
                        @csrf
                        <div class="" style="color: black;">
                            <div class="form-group">
                                <label style="color: white">Termos</label>
                                <textarea name="termos" id="mytextarea" cols="10"  >{{ $param->termo_compra }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary px-5 radius-30">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
