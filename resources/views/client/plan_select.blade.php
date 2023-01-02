@extends('client.index_client')
@section('title', 'Selecione o Pacote ou Moeda Desejada')
@section('compras', 'mm-active')

@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection
@section('content')
    <div class="row">
        @foreach ($coins as $key => $coin)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $coin->name }}</h4>
                        <hr />
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Valor</p>
                            <span class="mb-0">R$ @money2($coin->latestCotacao->value)</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">RP</p>
                            <span class="mb-0">{{ $coin->profit_percentage }}%</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Tempo</p>
                            <span class="mb-0">{{ $coin->time_pri }} (mês)</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Quantidade de Animais</p>
                            <span class="mb-0">{{ $coin->qtd_boi }}</span>
                        </div>
                        <hr />
                        <form action="{{ route('coin_select_store') }}" method="post">
                            @csrf
                            <input type="hidden" name="coin" value="{{ Crypt::encrypt($coin->id) }}">
                            <div class="form-row justify-content-center">
                                <livewire:counter />
                            </div>
                            <button class="btn btn-primary rounded btn-md lis-rounded-circle-50 px-4 mt-3" data-abc="true">
                                <i class="fa fa-shopping-cart pl-2"></i>
                                Comprar
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($pacotes as $pacote)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $pacote->name }}</h4>
                        <hr />
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Valor</p>
                            <span class="mb-0">R$ @money2($pacote->value)</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">RP</p>
                            <span class="mb-0">{{ $pacote->coin->profit_percentage }}%</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Tempo</p>
                            <span class="mb-0">{{ $pacote->time_pri }} (mês)</span>
                        </div>
                        <div class="col-12 m-2">
                            <p class="card-title mb-0">Quantidade de Animais</p>
                            <span class="mb-0">{{ $pacote->quantity }}</span>
                        </div>
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
