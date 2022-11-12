@extends('client.index_client')
@section('title','Upgrade')

@section('content')
<div class="row">
    <div class="col-md-12">

        <h3 class="text-center">Selecione o Plano</h3>

        <div class="row">

            <div class="col-xl-4 col-lg-12 col-sm-12">
                <div class="card overflow-hidden">
                    <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                        <div class="profile-photo">
                            <img src="{{ asset('assets') }}/img/logo.png" width="100" class="img-fluid rounded-circle" alt="">
                        </div>
                        <h3 class="mt-3 mb-1 text-white">Plano Start</h3>
                        <p class="text-white mb-0">Senior Manager</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="mb-0">
                                Ganhos de 4.5% das vendas
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">100 pontos</span></li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">&nbsp;</span></li>
                        <li class="list-group-item d-flex justify-content-center text-center">
                            <strong class="text-center">R$ 300,00</strong>
                        </li>
                    </ul>
                    <div class="card-footer border-0 mt-0">
                        <button class="btn btn-primary btn-lg btn-block" disabled>
                            @if($plano['plano_id'] == 1)
                            Plano Atual
                            @else
                            &nbsp;
                            @endif
                        </button>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-12 col-sm-12">
                <div class="card overflow-hidden">
                    <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                        <div class="profile-photo">
                            <img src="{{ asset('assets') }}/img/logo.png" width="100" class="img-fluid rounded-circle" alt="">
                        </div>
                        <h3 class="mt-3 mb-1 text-white">Plano Premium</h3>
                        <p class="text-white mb-0">Senior Manager</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="mb-0">
                                Ganhos de 4.5% das vendas
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">
                                300 pontos
                            </span></li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">&nbsp;</span></li>
                        <li class="list-group-item d-flex justify-content-center text-center">
                            <strong class="text-center">R$ 1.000,00</strong>
                        </li>
                    </ul>
                    <div class="card-footer border-0 mt-0">

                        @if($plano['plano_id'] == 1)
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" value="{{ Crypt::encrypt(2) }}" name="plano">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Fazer Upgrade
                            </button>
                        </form>
                        @elseif($plano['plano_id'] == 2)
                        <button class="btn btn-primary btn-lg btn-block" disabled>
                            Plano Atual
                        </button>
                        @else
                        <button class="btn btn-primary btn-lg btn-block" disabled>
                            &nbsp;
                        </button>
                        @endif


                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-12 col-sm-12">
                <div class="card overflow-hidden">
                    <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                        <div class="profile-photo">
                            <img src="{{ asset('assets') }}/img/logo.png" width="100" class="img-fluid rounded-circle" alt="">
                        </div>
                        <h3 class="mt-3 mb-1 text-white">Plano Prime</h3>
                        <p class="text-white mb-0">Senior Manager</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="mb-0">
                                Ganhos de 4.5% das vendas
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">500 pontos</span></li>
                        <li class="list-group-item d-flex justify-content-between"><span class="mb-0">&nbsp;</span></li>
                        <li class="list-group-item d-flex justify-content-center text-center">
                            <strong class="text-center">R$ 2.000,00</strong>
                        </li>
                    </ul>
                    <div class="card-footer border-0 mt-0">
                        @if($plano['plano_id'] == 1 || $plano['plano_id'] == 2)
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" value="{{ Crypt::encrypt(3) }}" name="plano">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                Fazer Upgrade
                            </button>
                        </form>
                        @elseif($plano['plano_id'] == 3)
                        <button class="btn btn-primary btn-lg btn-block" disabled>
                            Plano Atual
                        </button>
                        @else
                        <button class="btn btn-primary btn-lg btn-block" disabled>
                            &nbsp;
                        </button>
                        @endif
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

@endsection