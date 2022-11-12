@extends('site.index_site')
@section('title','Recuperar Senha')

@section('content')
<div class="card col-span-1 row-span-3 shadow-lg xl:col-span-2 bg-base-100">
    <div class="card-body">
        <h2 class="my-4 text-4xl font-bold card-title">Top 10 UI Components</h2>
        <div class="mb-4 space-x-2 card-actions">
            <div class="badge badge-ghost">Colors</div>
            <div class="badge badge-ghost">UI Design</div>
            <div class="badge badge-ghost">Creativity</div>
        </div>
        <p>Rerum reiciendis beatae tenetur excepturi aut pariatur est eos. Sit sit necessitatibus veritatis sed molestiae voluptates incidunt iure sapiente.</p>
        <div class="justify-end space-x-2 card-actions"><button class="btn btn-primary">Login</button> <button class="btn">Register</button></div>
    </div>
</div>







<section class="form_bg">
    <div class="container">
        <div class="form_container">
            <div class="form_header">
                <a href="" class="registration_logo">
                    <img src="{{ asset('assets') }}/img/logo.png" alt="Spovest Logo">
                </a>
            </div>
            <form method="POST" action="" class="mt-60">
                @csrf
                <h1 class="form_title">Login</h1>

                @include('commons.alerts')

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" autofocus name="email" placeholder="Enter Your Email" class="form-control para" id="email" required="required">
                </div>
                <div class="mb-3">
                    <label for="password-field" class="form-label">Senha</label>
                    <div class="show_password">
                        <input type="password" name="password" placeholder="Enter Your Password" class="form-control para" id="password-field" required="required">
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <a href="{{ url('forget-password') }}" class="para" id="forgot">Esqueceu a Senha?</a>
                </div>
                <button type="submit" class="btn btn-primary">Entrar!</button>
                <div class="form_footer">
                    <span>OU</span>
                    <p class="para">Não tenho uma conta? <a href="{{ url('cadastro') }}"> Cadastre-se</a></p>
                </div>
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