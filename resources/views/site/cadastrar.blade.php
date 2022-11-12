@extends('site.index_site')
@section('title','cadastrar')

@section('content')

<div class="row no-gutters">
    <div class="col-lg-6">
        <div class="card-body p-md-5">
            <div class="text-center">
                <img src="{{ asset('assets') }}/img/logo2.png" width="200" alt="">
                <h3 class="mt-4 font-weight-bold">
                    Criar Minha Conta
                </h3>
            </div>
            <div class="login-separater">
                @include('commons.alerts')
                <hr>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome*</label>
                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>CPF*</label>
                        <input name="cpf" value="{{ old('cpf') }}" required type="text" class="form-control cpf" placeholder="" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>E-mail*</label>
                        <input name="email" value="{{ old('email') }}" required type="text" class="form-control" />
                    </div>

                    <div class="form-group col-md-6">
                        <label>Telefone Celular*</label>
                        <input name="phone" value="{{ old('phone') }}" type="text" class="form-control fone" placeholder="" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Usuário*</label>
                        <input name="user" value="{{ old('user') }}" required type="text" class="form-control" placeholder="" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Senha*</label>
                        <div class="input-group" id="show_hide_password">
                            <input name="password" value="{{ old('password') }}" required class="form-control border-right-0" type="password" value="12345678">
                            <div class="input-group-append"> <a href="javascript:;" class="input-group-text border-left-0"><i class='bx bx-hide'></i></a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="btn-group mt-3 w-100">
                    <button type="submit" class="btn btn-light btn-block">Cadastrar</button>
                    <button type="submit" class="btn btn-light"><i class="lni lni-arrow-right"></i>
                    </button>
                </div>
                <hr />
                <div class="text-center mt-4">
                    <p class="mb-0">Já tem um conta? <a href="{{ url('/') }}">Login</a>

                    </p>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <img src="{{ asset('assets') }}/img/login.png" class="card-img login-img h-100" alt="...">
    </div>
</div>

@endsection