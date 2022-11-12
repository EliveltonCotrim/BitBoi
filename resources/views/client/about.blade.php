@extends('client.index_client')
@section('title','')

@section('menu_about','active')

@section('content')

<div class="col-xl-12 d-flex flex-column">
    <div class="inner_left">
        <div class="cover_img d-flex align-items-end align-items-md-end" style="background-image: url('assets/images/user/illustration.png');">
            <div class="profile_lg_wrapper d-flex align-items-center align-items-md-end">
                <div class="profile_content d-flex align-items-center justify-content-center">
                    <a href="user-about.html">
                    </a>
                </div>
                <div class="profile_info">
                    <a href="">Sobre Nós</a>
                </div>
            </div>
        </div>
        <div class="profile_info_wrapper">

        </div>
        <div class="tab_wrapper">
            <div class="row tab_btn_row d-flex align-items-center justify-content-between">
                <div class="tab_btn_wrapper col-sm-8 order-last order-sm-first text-center text-sm-start">
                    <button class="btn tab_btn active" data-tab="about">Sobre Nós</button>

                </div>
                <div class="social_wrapper col-sm-4 text-center text-sm-end">
                </div>
            </div>
            <div id="about" class="profile_tab active">
                <h3>Sobre Nós</h3>
                <p class="para">{!! $param->sobre !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection