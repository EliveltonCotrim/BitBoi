@extends('client.index_client')
@section('title','Adesão de Plano')

@section('content')

<h2 class="text-center">
    Selecione o Plano
    <hr>
</h2>
<div class='row'>

    @foreach($pacotes as $pacote)
    <div class="col-xl-4 col-lg-12 col-sm-12">
        <div class="card overflow-hidden">
            <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                <h3 class="mt-3 mb-1 text-white">{{ $pacote->nome }}</h3>
                <h3 class="mt-3 mb-1 text-white">@money($pacote->valor)</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Pontos</span>
                    <strong class="text-muted"> {{ $pacote->pontos }} </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0"></span> <strong class="text-muted"> </strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0"></span> <strong class="text-muted"> </strong></li>
            </ul>
            <div class="card-footer border-0 mt-0">
                <a href="{{ url('client/adesao/novo/'.$pacote->id) }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-cart-plus"></i>
                    Selecionar Plano
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection