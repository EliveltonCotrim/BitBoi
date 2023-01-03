@extends('site.index_site')

@section('content')
    <div class="row container p-0 no-gutters">
        <div class="col-lg-6">
            <div class="card-body p-md-5">
                <div class="text-center">
                    <img src="{{ asset('assets') }}/img/logo2.png" width="200" alt="">
                </div>
                <div class="login-separater text-center">
                    @include('commons.alerts')
                    <hr>
                </div>
                <p class="form_title text-center" style="color: white; font-size: 15px; margin-top: 40px;">
                    Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um e-mail
                    com um link de redefinição de senha que permitirá que você escolha uma nova.
                </p>

                <form method="POST" action="{{ route('forget.password.post') }}">
                    @csrf
                    <div class="form-group mt-4">
                        <label>E-mail</label>
                        <input type="email" autofocus name="email" required class="form-control"
                            placeholder="Digite seu e-mail">
                    </div>

                    <div class="btn-group mt-3 w-100">
                        <button type="submit" class="btn btn-light btn-block">Enviar</button>
                        <button type="submit" class="btn btn-light"><i class="lni lni-arrow-right"></i>
                        </button>
                    </div>
                    <div class="btn-group mt-3 w-100">
                        <a href="{{ url('/') }}">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('assets') }}/img/login.png" class="card-img login-img h-100" alt="...">
        </div>
    </div>
@endsection
