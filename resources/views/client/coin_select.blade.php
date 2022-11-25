@extends('client.index_client')
@section('title', 'Selecione a moeda Desejada')
@section('actions')
    <a href='{{ url('client/compras') }}' class='btn btn-primary'>
        Voltar
    </a>
@endsection
@section('content')
    <div class="row">
        @foreach ($coins as $coin)
            <div class="col-12 col-lg-3 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-0">{{ $coin->name }}</h4>
                        <p class="mb-0">R$ @money2($coin->latestCotacao->value)</p>
                        <hr />
                        <span class="card-title mb-0">Pecentual Rendimento</span>
                        <p class="mb-0"> {{ $coin->profit_percentage }}%</p>
                        <span class="card-title mb-0">Tempo PRI</span>
                        <p class="mb-0">{{ $coin->time_pri }} (mês)</p>

                        <hr />
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="coin" value="{{ Crypt::encrypt($coin->id) }}">
                            <div class="form-row justify-content-center">
                                <div class="btn-group col-md-9 m-1" role="group" aria-label="Basic example">
                                    {{-- <input class="form-control" type="number" placeholder="Quantidade" name="quantity_coin"
                                        id="num"> --}}
                                        <button type="button" class="btn btn-danger mr-1" onclick="less({{ $coin->id }})">-</button>
                                        <input id="num" class="form-control" id=demoInput type=text min=1 max=50>
                                        <button type="button" class="btn btn-success ml-1" onclick="more({{ $coin->id }})">+</button>
                                </div>
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
    </div>
@endsection
@section('scripts')
    <script>
        numero = 0;

        function less() {
            numero--;
            setValue(numero);
        }

        function more() {
            numero++;
            setValue(numero);
        }

        function setValue(value) {
            document.getElementById('num').value = value;
        }

        setValue(numero);


    </script>
    <script>
        function increment() {
            document.getElementById('demoInput').stepUp();
        }

        function decrement() {
            document.getElementById('demoInput').stepDown();
        }
    </script>




@endsection
