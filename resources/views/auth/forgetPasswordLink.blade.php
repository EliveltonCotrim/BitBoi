@extends('site.index_site')

@section('content')
    <div class="row container p-0 no-gutters">
        <div class="col-lg-6">
            <div class="card-body p-md-5">
                <div class="text-center">
                    <img src="{{ asset('assets') }}/img/logo2.png" width="200" alt="">
                    <hr>
                </div>
                {{-- <div class="login-separater text-center">
                    @include('commons.alerts')
                    <hr>
                </div> --}}
                <div class="row text-center">
                    <div class="col-md-12">
                        <p class="form_title text-center mt-2 mb-2" style="color: white; font-size: 15px;">
                            <i class="lni lni-user"></i> Alterar Senha
                        </p>

                    </div>
                    <div class="col-md-12">
                        <span>crie uma nova senha com no mínimo 6 caracteres</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('reset.password.post') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group mt-4">
                        <label for="email">E-mail</label>
                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <label for="password">Nova Senha</label>
                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <label for="password-confirm">Confirma Senha</label>
                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                            required autofocus>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="btn-group mt-3 w-100">
                        <button type="submit" class="btn btn-light btn-block"> Alterar Senha</button>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('assets') }}/img/login.png" class="card-img login-img h-100" alt="...">
        </div>
    </div>
@endsection
