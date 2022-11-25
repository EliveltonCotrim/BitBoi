@extends('client.index_client')

@section('title', ' Termos de Compra')

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- <hr>
        {!! $param->termo_compra !!} --}}
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card radius-15">
                        <div class="card-body p-5">
                            <form action="{{ route('store.termo.user') }}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <h3>Termos</h3>
                                        {{-- <textarea name="termos" id="editor" cols="10" readonly>{{}}</textarea> --}}
                                        <p> {!! $param->termo_compra !!}</p>
                                    </div>
                                    <div class="row justify-content-center">
                                        @if ($user->status_termo == null)
                                            <button type="submit" class="btn btn-primary px-5 radius-30">Aceitar</button>
                                        @else
                                            <p><strong> Termos aceito -
                                                    {{ date('d-m-Y', strtotime($user->dt_termo)) }}</strong></p>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
