@extends('client.index_client')

@section('title','Meio de Pagamento')
@section('menu_depositos','active')

@section('actions')
<!-- <a href="{{ url('client/depositos') }}" class="btn btn-primary btn-rounded">
    Voltar
</a> -->
@endsection

@section('content')
<div class="card ">
    <div class="card-body">
        <h2 class="text-center">
            Selecione o <br> Meio de Pagamento
        </h2>
        <hr>
        <div class="row text-center">
            @foreach($meios as $meio)
            <div class="col-md-3">
                <div class="card">
                    <form action="" method="post" id="{{ $meio->name }}">
                        @csrf
                        <input type="hidden" name="meio" value="{{ Crypt::encrypt($meio->id) }}">
                        <button type="submit" class="btn btn-light btn-lg btn-block rounded shadow btg">
                            @if($meio->slug == 'cartao')
                            <span class="bx bx-credit-card" style="font-size: 50px; "></span>
                            @else
                            <img src="{{ asset('assets') }}/img/pix.png" alt="" style="width: 70px;">
                            @endif
                            <br>
                            {{ $meio->name }}
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>


        <div class='row'>
            <div class='col-md-12'>
                <a href="{{ url('client/meu_plano') }}" class="btn btn-light btn-lg">
                    Voltar
                </a>
            </div>
        </div>

    </div>
</div>

<style>
    .btg {
        height: 140px;
        margin-bottom: 20px;
    }
</style>

@endsection