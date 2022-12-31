@extends('client.index_client')
@section('title', 'Home')
@section('menu_home', 'active')

@section('content')
    {{-- <div class="row">
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="card radius-15">
                <div class="card-body">
                    <p class="card-text text-white">Saldo Investimento</p>
                    <h2 class="mb-0 text-white">
                        @money($valorInvestido->courentBalance)
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="card radius-15">
                <div class="card-body">
                    <p class="card-text text-white">Saldo Moedas</p>
                    <h2 class="mb-0 text-white">
                        {{ $saldo_moedas }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="card radius-15">
                <div class="card-body">
                    <p class="card-text text-white">Rendimento previsto</p>
                    <h2 class="mb-0 text-white">
                        @money($lucroPrevisto)
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="card radius-15">
                <div class="card-body">
                    <p class="card-text">Rendimento Atual</p>
                    @if ($rendimentoatual)
                        <h2 class="mb-0 text-white">

                            @money2($rendimentoatual->courentBalance)
                        </h2>
                    @else
                        <h2 class="mb-0 text-white">

                            @money2(0000)
                        </h2>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 col-lg-12 col-xl-6">
            <div class="card-deck flex-column flex-lg-row">
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="widgets-icons mx-auto rounded-circle"><i class='bx bx-money'></i></i>
                        </div>
                        <h4 class="mb-0 font-weight-bold mt-3 text-white">@money($valorInvestido)</h4>
                        <p class="mb-0 text-white">Saldo Investido</p>
                    </div>
                </div>
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="widgets-icons mx-auto rounded-circle"><i class='bx bx-coin'></i></i>
                        </div>
                        <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ $saldo_moedas }}</h4>
                        <p class="mb-0 text-white">Saldo Moedas</p>
                    </div>
                </div>
            </div>
            <div class="card-deck flex-column flex-lg-row">
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="widgets-icons mx-auto rounded-circle"><i class='bx bx-line-chart'></i>
                        </div>
                        <h4 class="mb-0 font-weight-bold mt-3 text-white">@money($lucroPrevisto)</h4>
                        <p class="mb-0 text-white">Rendimento previsto</p>
                    </div>
                </div>
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="widgets-icons mx-auto rounded-circle"><i class='bx bx-line-chart'></i>
                        </div>
                        <h4 class="mb-0 font-weight-bold mt-3 text-white">
                            @if (isset($rpTotal))
                                {{ $rpTotal }}%
                            @else
                                {{ $rpTotal }}%
                            @endif
                        </h4>
                        <p class="mb-0 text-white">Lucratividade</p>
                    </div>
                </div>
                <div class="card radius-15">
                    <div class="card-body text-center">
                        <div class="widgets-icons mx-auto rounded-circle"><i class='bx bx-line-chart'></i>
                        </div>
                        <h4 class="mb-0 font-weight-bold mt-3 text-white">
                            @money($saqueDisponivel)
                        </h4>
                        <p class="mb-0 text-white">Disponivel para Saque</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-6">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4">
                        <div>
                            <h5 class="mb-0">Nossas Redes Sociais</h5>
                        </div>
                        <div class="ml-auto">
                            {{-- <h3 class="mb-0"><span class="font-14">Total Visits:</span> 874</h3> --}}
                        </div>
                    </div>
                    <hr />
                    <div class="dashboard-social-list">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center bg-transparent">
                                <div class="media align-items-center">
                                    <div class="widgets-social rounded-circle text-white"><i class='bx bxl-youtube'></i>
                                    </div>
                                    <div class="media-body ml-2">
                                        <h6 class="mb-0">YouTube</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center bg-transparent">
                                <div class="media align-items-center">
                                    <div class="widgets-social rounded-circle text-white"><i class='bx bxl-instagram'></i>
                                    </div>
                                    <div class="media-body ml-2">
                                        <h6 class="mb-0">Instagram</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center bg-transparent">
                                <div class="media align-items-center">
                                    <div class="widgets-social rounded-circle text-white"><i class='bx bxl-telegram'></i>
                                    </div>
                                    <div class="media-body ml-2">
                                        <h6 class="mb-0">Telegram</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 mx-auto">
            <div class="card radius-15">
                <div class="card-header border-bottom-0">
                    <div class="d-lg-flex align-items-center">
                        <div>
                            <h5 class="mb-lg-0">Cotações</h5>
                        </div>
                        <div class="ml-lg-auto mb-2 mb-lg-0">
                            <div class="form-group">
                                <select name="select_coin" id="select_coin" class="form-control form-control-sm">
                                    @foreach ($coins as $key => $coin)
                                        <option value="{{ $coin->id }}" {{ $key == 0 ? 'selected' : '' }}>
                                            {{ $coin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container1">
                        <canvas id="chart1"></canvas>
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

    <script>
        $(document).ready(function() {
            var select_coin = document.getElementById('select_coin');
            var id_coin_selected = select_coin.value;

            // chart 1
            var ctx = document.getElementById('chart1').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {

                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'top',
                        horizontalAlign: 'left',
                        offsetX: -25,
                        labels: {
                            fontColor: '#fff',
                            boxWidth: 15
                        }
                    },

                    tooltips: {
                        enabled: true
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#fff'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(255, 255, 255, 0.24)"
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(255, 255, 255, 0.64)'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(255, 255, 255, 0.24)"
                            },
                        }]
                    }
                }

            });

            function addData(myChart, label, data) {
                myChart.data.labels.push(label);
                myChart.data.datasets.forEach((dataset) => {
                    dataset.data.push(data);
                });
                myChart.update();
            }

            function removeData(chart) {
                chart.data.labels.pop();
                chart.data.datasets.forEach((dataset) => {
                    dataset.data.pop();
                });
                chart.update();
            }

            $.ajax({
                url: "{{ route('ajax.cotacoes') }}",
                type: "get",
                data: {
                    'id_coin_selected': id_coin_selected,
                },
                dataType: "json",
                success: function(cotacoes) {
                    myChart.config.data.datasets = [];
                    myChart.config.data.labels = [];
                    var moeda = cotacoes.moeda

                    var values = []
                    var datas = cotacoes.datas

                    $.each(cotacoes.valores, function(key, value) {
                        values.push(value)
                    });

                    myChart.config.data.labels = datas;

                    var dataSet = [{
                        label: moeda,
                        data: values,
                        borderColor: "rgba(255, 255, 255, 0.70)",
                        pointRadius: "2",
                        borderWidth: 3,
                        tension: 0.1,
                    }]

                    myChart.config.data.datasets = dataSet;
                    myChart.update();

                }

            })

        })

        $('#select_coin').change(function() {
            var id_coin_selected = ($(this).val());
            var select_coin = document.getElementById('select_coin');
            var id_coin_selected = select_coin.value;

            // chart 1
            var ctx = document.getElementById('chart1').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {

                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'top',
                        horizontalAlign: 'left',
                        offsetX: -25,

                        labels: {
                            fontColor: '#fff',
                            boxWidth: 15
                        }
                    },

                    tooltips: {
                        enabled: true
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#fff'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(255, 255, 255, 0.24)"
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(255, 255, 255, 0.64)'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(255, 255, 255, 0.24)"
                            },
                        }]
                    }
                }

            });


            $.ajax({
                url: "{{ route('ajax.cotacoes') }}",
                type: "get",
                data: {
                    'id_coin_selected': id_coin_selected,
                },
                dataType: "json",
                success: function(cotacoes) {

                    myChart.config.data.datasets = [];
                    myChart.config.data.labels = [];
                    var moeda = cotacoes.moeda

                    var values = []
                    var datas = cotacoes.datas

                    $.each(cotacoes.valores, function(key, value) {
                        values.push(value)
                    });

                    myChart.config.data.labels = datas;

                    var dataSet = [{
                        label: moeda,
                        data: values,
                        borderColor: "rgba(255, 255, 255, 0.70)",
                        pointRadius: "2",
                        borderWidth: 3,
                        tension: 0.1,
                    }]

                    myChart.config.data.datasets = dataSet;
                    myChart.update();

                }

            })

        });
    </script>

@endsection
