@extends('client.index_client')
@section('title', 'Selecione a moeda Desejada')

@section('content')
    <div class="row">
        @foreach ($coins as $coin)
            <div class="col-md-3 text-center mb-3">
                <div class="car shadow">
                    <div class="price-header lis-rounded-top py-4 border border-bottom-0">
                        <h5 class="text-uppercase lis-latter-spacing-2">{{ $coin->name }}</h5>
                        <h1 class="display-4 lis-font-weight-500 mt-3" style="font-size: 40px;">
                            <sup>R$ @money2($coin->latestCotacao->value)</sup>
                        </h1>
                    </div>
                    <div class="border border-top-0 bg-light py-5 lis-rounded-bottom">
                        {{-- <ul class="list-unstyled lis-line-height-3">
                            <li></li>
                        </ul> --}}
                        <form action="" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4 text-center">
                                    <input type="number" placeholder="Quantidade" name="qtd">
                                </div>
                            </div>
                            <input type="hidden" name="pacote" value="{{ Crypt::encrypt($coin->id) }}">
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
