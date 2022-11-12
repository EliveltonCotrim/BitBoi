@extends('client.index_client')
@section('title','Selecione o Plano Desejado')

@section('content')

<div class="row">
    @foreach($pacotes as $pacote)

    <div class="col-md-3 text-center mb-3">
        <div class="car shadow">
            <div class="price-header lis-rounded-top py-4 border border-bottom-0">
                <h5 class="text-uppercase lis-latter-spacing-2">{{ $pacote->name }}</h5>
                <h1 class="display-4 lis-font-weight-500" style="font-size: 40px;">
                    <sup>R$</sup>
                    @money2($pacote->value)
                </h1>
                <h3>{{ $pacote->quantity }} Tokens</h3>
            </div>
            <div class="border border-top-0 bg-light py-5 lis-rounded-bottom">
                <ul class="list-unstyled lis-line-height-3">
                    <li></li>
                </ul>
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="pacote" value="{{ Crypt::encrypt($pacote->id) }}">
                    <button class="btn btn-primary rounded btn-md lis-rounded-circle-50 px-4" data-abc="true">
                        <i class="fa fa-shopping-cart pl-2"></i>
                        Comprar
                    </button>
                </form>
            </div>
        </div>
    </div>

    @endforeach

</div>

@endsection