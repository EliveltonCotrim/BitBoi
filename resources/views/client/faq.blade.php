@extends('client.index_client')
@section('title', 'Perguntas Frequentes')

@section('menu_faq','active')

@section('content')

<div class="row d-flex flex-wrap">
    <div class="col-xl-12 d-flex flex-column">
        <div class="inner_left">
            <div class="rules_cover" style="background-image: url('<?php echo asset("assets") ?>/painel/images/profile/rules_bg.png');">
                <h1 class=" text-center">Perguntas Frequentes</h1>
            </div>
            <div class="rules_tab_wrapper">
                <div class="rules_btn_row text-center">
                </div>
                <div id="fq" class="rul_tab activecr">
                    <section class="faq_section_wrapper" style="padding-bottom: 30px;">
                        <div class="container-fluid">
                            <div class="row faq_row sec_row">
                                <div class="col-lg-2">
                                    <div class="faq_img">
                                        <img src="<?php echo asset("assets") ?>/painel/images/faq/general.png" alt="General Questions">
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="faq">

                                        @foreach($faqs as $faq)

                                        <div class="card">
                                            <div class="card-body">

                                                <h3> {{ $faq->pergunta }} </h3>
                                                <hr>
                                                <p class="para">{{ $faq->resposta }}</p>
                                            </div>
                                        </div>

                                        @endforeach

                                    </div>
                                </div>

                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 d-flex flex-column">

    </div>
</div>







@endsection