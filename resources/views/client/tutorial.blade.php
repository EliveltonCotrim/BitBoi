@extends('client.index_client')
@section('title','Tutoriais')

@section('menu_about','active')

@section('content')

<div>
    <div class='row'>
        <div class='col-md-12'>
            <div class="pb-5 pt-2">
                <a href="https://t.me/+DuKQTuAGFxoyMDBh" target="_blanck" class="btn btn-light">
                    <i class="lni lni-telegram"> </i>
                    GRUPO VIP DO TELEGRAM
                </a>

            </div>

            <div class='row'>
                <div class='col-md-12'>
                    <h4 class="text-center">
                        TUTORIAL 1 - Boas-vindas</h4>
                    <div class="d-flex justify-content-center">
                        <iframe class="videos" src="https://www.youtube.com/embed/AUxy_Gglpg4"> </iframe>
                    </div>
                </div>
            </div>

            <div class='row' style="margin-top: 60px;">
                <div class='col-md-12'>
                    <h4 class="text-center">TUTORIAL 2 - SISTEMA HERTAL GAMBLER ROULETTE</h4>
                    <div class="d-flex justify-content-center">
                        <iframe class="videos" src="https://www.youtube.com/embed/-97lwvZPP90"> </iframe>
                    </div>
                </div>
            </div>
            <div class='row' style="margin-top: 60px;">
                <div class='col-md-12'>
                    <h4 class="text-center">TURORIAL 3 - DICAS IMPORTANTES</h4>
                    <div class="d-flex justify-content-center">
                        <iframe class="videos" src="https://www.youtube.com/embed/RChPCxtya4k"> </iframe>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<style>
    @media screen and (max-width: 700px) {
        .videos {
            width: 100%;
            height: 400px;
        }
    }

    @media screen and (min-width: 700px) {
        .videos {
            width: 600px;
            height: 400px;
        }
    }
</style>

@endsection