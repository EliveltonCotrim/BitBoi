@extends('site.index_site')

@section('content')
<section class="form_bg">
    <div class="container">
        <div class="form_container">
            <div class="form_header">
                <a href="" class="registration_logo">
                    @if(env('APP_NAME') == 'green')
                    <img src="{{ asset('assets') }}/img/logo_green.png" alt="Spovest Logo" id="logo" style="width: 300px;">
                    @else
                    <img src="{{ asset('assets') }}/img/logo.png" alt="Spovest Logo" id="logo">
                    @endif
                </a>
            </div>

            <h1 class="form_title text-center" style="color: black; font-size: 30px; margin-top: 40px;">
                Recuperar Senha <br> Enviar Link para Resetar Senha
            </h1>
            <hr>
            @if (Session::has('message'))
            <div class="alert alert-success text-black" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif
            <form action="{{ route('forget.password.post') }}" method="POST" class="mt-50">
                @csrf
                <div class="form-row mb-3">
                    <div class="col-md-8">
                        <label for="email_address" class="">E-Mail</label>
                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="&nbsp;"></label>
                        <button type="submit" class="btn btn-primary form-control text-white" style="margin-top: 8px;">
                            Enviar
                        </button>
                    </div>
                </div>
                <a href="{{ url('/') }}">Voltar</a>
            </form>

        </div>
    </div>
</section>

<style>
    .form_bg {
        background-image: url('{{ asset("assets/img/fundo.png") }}') !important;
    }
</style>


@endsection