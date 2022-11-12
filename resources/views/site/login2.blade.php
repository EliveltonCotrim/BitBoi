@extends('site.index_site')
@section('title','Login')

@section('content')

<div class="row no-gutters">
    <div class="col-lg-6">
        <div class="card-body p-md-5">
            <div class="text-center">
                <img src="{{ asset('assets') }}/img/logo2.png" width="200" alt="">
            </div>
            <div class="login-separater text-center">
                @include('commons.alerts')
                <hr>
            </div>

            <form method="POST" action="">
                @csrf
                <div class="form-group mt-4">
                    <label>E-mail</label>
                    <input type="text" autofocus name="email" required class="form-control" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" required class="form-control" placeholder="Digite sua senha">
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <div class="custom-control custom-switch">
                        </div>
                    </div>

                    <div class="form-group col text-right">
                        <!-- <a href="{{ url('forget-password') }}">
                            <i class="bx bxs-key mr-2"></i>Esqueceu a Senha?
                        </a> -->
                    </div>
                </div>

                <div class="btn-group mt-3 w-100">
                    <button type="submit" class="btn btn-light btn-block">Login</button>
                    <button type="submit" class="btn btn-light"><i class="lni lni-arrow-right"></i>
                    </button>
                </div>
                <hr>
                <div class="form-group col text-right">
                    <a href="{{ url('cadastro') }}">
                        Cadastrar
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <img src="{{ asset('assets') }}/img/capa.png" class="card-img login-img h-100" alt="...">
    </div>
</div>

@endsection