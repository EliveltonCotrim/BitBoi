@extends('client.index_client')
@section('title', 'Home')
@section('menu_home', 'active')

@section('content')

    <div class="container-fluid">
        <div class='row'>
            <div class="col-12 col-md-4">
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card radius-15">
                            <div class="card-body" style="position: relative;">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Saldo Moedas</p>
                                        <h2 class="mb-0 text-white">
                                            {{ $saldo_moedas }}
                                        </h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart1" style="min-height: 80px;">
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 363px; height: 188px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card radius-15">
                            <div class="card-body" style="position: relative;">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Saldo Investimento</p>
                                        <h2 class="mb-0 text-white">
                                            {{-- @money2($valorInvestido->courentBalance) --}}
                                        </h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart1" style="min-height: 80px;">
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 363px; height: 188px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card radius-15">
                            <div class="card-body" style="position: relative;">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Rendimento Atual</p>
                                        <h2 class="mb-0 text-white">
                                            @if ($rendimentoatual)
                                                @money2($rendimentoatual->courentBalance)
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart1" style="min-height: 80px;">
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 363px; height: 188px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="card radius-15">
                            <div class="card-body" style="position: relative;">
                                <div class="d-flex mb-2">
                                    <div>
                                        <p class="mb-0 font-weight-bold text-white">Lucro previsto</p>
                                        <h2 class="mb-0 text-white">
                                            @money($lucroPrevisto)
                                        </h2>
                                    </div>
                                    <div class="ml-auto align-self-end">
                                    </div>
                                </div>
                                <div id="chart2" style="min-height: 80px;">
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 363px; height: 188px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="d-lg-flex align-items-center mb-4">
                            <div>
                                <h5 class="mb-0">Nossas Redes Sociais</h5>
                            </div>
                            <div class="ml-auto">
                            </div>
                        </div>
                        <hr>
                        <div class="dashboard-social-list ps ps--active-y">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center bg-transparent">
                                    <a href="" target="_blank">

                                        <div class="media align-items-center">
                                            <div class="widgets-social rounded-circle text-white"><i
                                                    class="bx bxl-youtube"></i>
                                            </div>
                                            <div class="media-body ml-2">
                                                <h6 class="mb-0">YouTube</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item d-flex align-items-center bg-transparent">
                                    <a href="" target="_blank">
                                        <div class="media align-items-center">
                                            <div class="widgets-social rounded-circle text-white"><i
                                                    class="bx bxl-telegram"></i>
                                            </div>
                                            <div class="media-body ml-2">
                                                <h6 class="mb-0">Telegram</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item d-flex align-items-center bg-transparent">
                                    <a href="" target="_blank">

                                        <div class="media align-items-center">
                                            <div class="widgets-social rounded-circle text-white">
                                                <i class="bx bxl-instagram"></i>
                                            </div>
                                            <div class="media-body ml-2">
                                                <h6 class="mb-0">Instagram</h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 230px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 135px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 mx-auto">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="mb-0">Cotações</h4>
                        </div>
                        <hr />
                        <div class="chart-container1">
                            <canvas id="chartCoins"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copy() {
            var range = document.createRange();
            range.selectNode(document.getElementById("ref"));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges(); // to deselect
        }
    </script>

@endsection
