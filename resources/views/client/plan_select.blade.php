@extends('client.index_client')
@section('title', 'Selecione o Plano Desejado')
@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection
@section('content')

    <div class="row">
        @foreach ($pacotes as $pacote)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{  $pacote->name }}</h4>
                        <p class="mb-0">R$ @money2($pacote->value)</p>
                        <hr />
                        <span class="card-title mb-0">Pecentual Rendimento</span>
                        <p class="mb-0"> {{ $pacote->percentual_rendimento }}%</p>
                        <span class="card-title mb-0">Tempo</span>
                        <p class="mb-0">{{ $pacote->time_pri }} (mês)</p>
                        <hr />
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
