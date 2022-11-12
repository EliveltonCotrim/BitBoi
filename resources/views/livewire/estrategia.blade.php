<div style="background: #eee;">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <div class="container">
        <div class='row' style="margin-right: 1px;">
            <div class='col-6'>
                <div class="card">
                    <div class='row'>
                        <div class='col-12'>
                            <table class=''>
                                <tr>
                                    <td rowspan="3">
                                        <a wire:click="add(0)" class="bt-0 btn btn-success text-white content_center" style="font-weight: bold; height: 85px;">
                                            0
                                        </a>
                                    </td>
                                    <td>
                                        <div class=''>
                                            <a wire:click="add(3)" class="btn bt-numbers text-white" style="background: {{ $numbers[3] ?? '' }}; font-weight: bold;">
                                                03
                                            </a>
                                            <a wire:click="add(6)" class="btn bt-numbers text-white" style="background: {{ $numbers[6] ?? '' }}; font-weight: bold;">
                                                06
                                            </a>
                                            <a wire:click="add(9)" class="btn bt-numbers text-white" style="background: {{ $numbers[9] ?? '' }}; font-weight: bold;">
                                                09
                                            </a>
                                            <a wire:click="add(12)" class="btn bt-numbers text-white" style="background: {{ $numbers[12] ?? '' }}; font-weight: bold;">
                                                12
                                            </a>
                                            <a wire:click="add(15)" class="btn bt-numbers text-white" style="background: {{ $numbers[15] ?? '' }}; font-weight: bold;">
                                                15
                                            </a>
                                            <a wire:click="add(18)" class="btn bt-numbers text-white" style="background: {{ $numbers[18] ?? '' }}; font-weight: bold;">
                                                18
                                            </a>
                                            <a wire:click="add(21)" class="btn bt-numbers text-white" style="background: {{ $numbers[21] ?? '' }}; font-weight: bold;">
                                                21
                                            </a>
                                            <a wire:click="add(24)" class="btn bt-numbers text-white" style="background: {{ $numbers[24] ?? '' }}; font-weight: bold;">
                                                24
                                            </a>
                                            <a wire:click="add(27)" class="btn bt-numbers text-white" style="background: {{ $numbers[27] ?? '' }};">
                                                27
                                            </a>
                                            <a wire:click="add(30)" class="btn bt-numbers text-white" style="background: {{ $numbers[30] ?? '' }};">
                                                30
                                            </a>
                                            <a wire:click="add(33)" class="btn bt-numbers text-white" style="background: {{ $numbers[33] ?? '' }};">
                                                33
                                            </a>
                                            <a wire:click="add(36)" class="btn bt-numbers text-white" style="background: {{ $numbers[36] ?? '' }};">
                                                36
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=''>
                                            <a wire:click="add(2)" class="btn bt-numbers text-white" style="background: {{ $numbers[2] ?? '' }};">
                                                02
                                            </a>
                                            <a wire:click="add(5)" class="btn bt-numbers text-white" style="background: {{ $numbers[5] ?? '' }};">
                                                05
                                            </a>
                                            <a wire:click="add(8)" class="btn bt-numbers text-white" style="background: {{ $numbers[8] ?? '' }};">
                                                08
                                            </a>
                                            <a wire:click="add(11)" class="btn bt-numbers text-white" style="background: {{ $numbers[11] ?? '' }};">
                                                11
                                            </a>
                                            <a wire:click="add(14)" class="btn bt-numbers text-white" style="background: {{ $numbers[14] ?? '' }};">
                                                14
                                            </a>
                                            <a wire:click="add(17)" class="btn bt-numbers text-white" style="background: {{ $numbers[17] ?? '' }}; font-weight: bold;">
                                                17
                                            </a>
                                            <a wire:click="add(20)" class="btn bt-numbers text-white" style="background: {{ $numbers[20] ?? '' }};">
                                                20
                                            </a>
                                            <a wire:click="add(23)" class="btn bt-numbers text-white" style="background: {{ $numbers[23] ?? '' }};">
                                                23
                                            </a>
                                            <a wire:click="add(26)" class="btn bt-numbers text-white" style="background: {{ $numbers[26] ?? '' }};">
                                                26
                                            </a>
                                            <a wire:click="add(29)" class="btn bt-numbers text-white" style="background: {{ $numbers[29] ?? '' }};">
                                                29
                                            </a>
                                            <a wire:click="add(32)" class="btn bt-numbers text-white" style="background: {{ $numbers[32] ?? '' }};">
                                                32
                                            </a>
                                            <a wire:click="add(35)" class="btn bt-numbers text-white" style="background: {{ $numbers[35] ?? '' }};">
                                                35
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=''>
                                            <a wire:click="add(1)" class="btn bt-numbers text-white" style="background: {{ $numbers[1] ?? '' }};">
                                                01
                                            </a>
                                            <a wire:click="add(4)" class="btn bt-numbers text-white" style="background: {{ $numbers[4] ?? '' }};">
                                                04
                                            </a>
                                            <a wire:click="add(7)" class="btn bt-numbers text-white" style="background: {{ $numbers[7] ?? '' }};">
                                                07
                                            </a>
                                            <a wire:click="add(10)" class="btn bt-numbers text-white" style="background: {{ $numbers[10] ?? '' }};">
                                                10
                                            </a>
                                            <a wire:click="add(13)" class="btn bt-numbers text-white" style="background: {{ $numbers[13] ?? '' }};">
                                                13
                                            </a>
                                            <a wire:click="add(16)" class="btn bt-numbers text-white" style="background: {{ $numbers[16] ?? '' }};">
                                                16
                                            </a>
                                            <a wire:click="add(19)" class="btn bt-numbers text-white" style="background: {{ $numbers[19] ?? '' }};">
                                                19
                                            </a>
                                            <a wire:click="add(22)" class="btn bt-numbers text-white" style="background: {{ $numbers[22] ?? '' }};">
                                                22
                                            </a>
                                            <a wire:click="add(25)" class="btn bt-numbers text-white" style="background: {{ $numbers[25] ?? '' }};">
                                                25
                                            </a>
                                            <a wire:click="add(28)" class="btn bt-numbers text-white" style="background: {{ $numbers[28] ?? '' }};">
                                                28
                                            </a>
                                            <a wire:click="add(31)" class="btn bt-numbers text-white" style="background: {{ $numbers[31] ?? '' }};">
                                                31
                                            </a>
                                            <a wire:click="add(34)" class="btn bt-numbers text-white" style="background: {{ $numbers[34] ?? '' }};">
                                                34
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-6'>
                <div class="card h100">
                    <div class='table-responsiv'>
                        <table id="table" cellspacing="0" class='table2 no-spacing table-borde table-stripe table-s text-center'>
                            <tr>
                                <td class="blackt cornertl"></td>
                                <td class="redt">
                                    <span class="circ <?php echo in_array(5, $numbers_play) ? 'circule' : '' ?>">
                                        5
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="{{ in_array(24,$numbers_play) ? 'circule' :''  }}">
                                        24
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(16, $numbers_play) ? 'circule' : '' ?>">
                                        16
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(33, $numbers_play) ? 'circule' : '' ?>">
                                        33
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(1, $numbers_play) ? 'circule' : '' ?>">
                                        1
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(20, $numbers_play) ? 'circule' : '' ?>">
                                        20
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(14, $numbers_play) ? 'circule' : '' ?>">
                                        14
                                    </span>
                                </td>
                                <td class="blackt cornerb">
                                    <span class="<?php echo in_array(31, $numbers_play) ? 'circule' : '' ?>">
                                        31
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(9, $numbers_play) ? 'circule' : '' ?>">
                                        9
                                    </span>
                                </td>
                                <td class="blackt"> <span class="<?php echo in_array(22, $numbers_play) ? 'circule' : '' ?>">
                                        22
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(18, $numbers_play) ? 'circule' : '' ?>">
                                        18
                                    </span>
                                </td>
                                <td class="blackt cornert">
                                    <span class="<?php echo in_array(29, $numbers_play) ? 'circule' : '' ?>">
                                        29
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(7, $numbers_play) ? 'circule' : '' ?>">
                                        7
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(28, $numbers_play) ? 'circule' : '' ?>">
                                        28
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(12, $numbers_play) ? 'circule' : '' ?>">
                                        12
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(35, $numbers_play) ? 'circule' : '' ?>">
                                        35
                                    </span>
                                </td>
                                <td class="blackt cornertr"></td>
                            </tr>
                            <tr>
                                <td class="blackt">
                                    <span class="<?php echo in_array(10, $numbers_play) ? 'circule' : '' ?>">
                                        10
                                    </span>
                                </td>
                                <td colspan="16" rowspan="3"></td>
                                <td class="redt">
                                    <span class="<?php echo in_array(3, $numbers_play) ? 'circule' : '' ?>">
                                        3
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="redt">
                                    <span class="{{ in_array(23,$numbers_play) ? 'circule' :''  }}">
                                        23
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(26, $numbers_play) ? 'circule' : '' ?>">
                                        26
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="blackt">
                                    <span class="<?php echo in_array(8, $numbers_play) ? 'circule' : '' ?>">
                                        8
                                    </span>
                                </td>
                                <td class="green ">
                                    <span class="<?php echo in_array(0, $numbers_play) ? 'circule' : '' ?>">
                                        0
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="blackt cornerbl"></td>
                                <td class="redt">
                                    <span class="<?php echo in_array(30, $numbers_play) ? 'circule' : '' ?>">
                                        30
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(11, $numbers_play) ? 'circule' : '' ?>">
                                        11
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(36, $numbers_play) ? 'circule' : '' ?>">
                                        36
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(13, $numbers_play) ? 'circule' : '' ?>">
                                        13
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(27, $numbers_play) ? 'circule' : '' ?>">
                                        27
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(6, $numbers_play) ? 'circule' : '' ?>">
                                        6
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(34, $numbers_play) ? 'circule' : '' ?>">
                                        34
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(17, $numbers_play) ? 'circule' : '' ?>">
                                        17
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(25, $numbers_play) ? 'circule' : '' ?>">
                                        25
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(2, $numbers_play) ? 'circule' : '' ?>">
                                        2
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(21, $numbers_play) ? 'circule' : '' ?>">
                                        21
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(4, $numbers_play) ? 'circule' : '' ?>">
                                        4
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(19, $numbers_play) ? 'circule' : '' ?>">
                                        19
                                    </span>
                                </td>
                                <td class="blackt">
                                    <span class="<?php echo in_array(15, $numbers_play) ? 'circule' : '' ?>">
                                        15
                                    </span>
                                </td>
                                <td class="redt">
                                    <span class="<?php echo in_array(32, $numbers_play) ? 'circule' : '' ?>">
                                        32
                                    </span>
                                </td>
                                <td class="blackt"></td>
                                <td class="blackt cornerbr"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class='row' style="margin-right: 1px;">
            <div class='col-6'>
                <div class="card">
                    <div class='table-responsiv'>
                        <table class='tabl table-bordered table-stripe table-s rounded' style="font-size: 15px; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="gblue" style="width: 5px;"></th>
                                    <th class="gblue px-2" style="width: 0px; padding: 0px; margin: 0px; text-align: center;">Nº</th>
                                    <th class="gblue px-2" style="width: 0px; padding: 0px; margin: 0px; text-align: center;">BET</th>
                                    <th class="gblue px-2" style="width: 0px; padding: 0px; margin: 0px; text-align: center;">BET</th>
                                    <th class="gblue px-2" style="width: 0px; padding: 0px; margin: 0px; text-align: center;">BET</th>
                                    <th class="gblue px-2" style="width: 0px; padding: 0px; margin: 0px; text-align: center;">RES.</th>
                                </tr>
                            </thead>
                            @php($i = 0)
                            @foreach($lines as $key=> $result)
                            <?php
                            $i++;

                            $res = '';
                            $previues_key = $key - 1;
                            if ($result['res'] == 'bg-black') {
                                $res = $result['res'];
                            } elseif (isset($lines[$previues_key])) {
                                if ($lines[$previues_key]['b1'] == 'X') {
                                    $res = 'bg-black';
                                } else {
                                    $res = $result['res'];
                                }
                            } else {
                                $res = $result['res'];
                            }
                            ?>
                            <tr class="text-center" style=" width: 5%; padding: 0px; margin: 0px; font-size: 12px;">
                                <td class="">{{ $i }}</td>
                                <td class=" gblue" style=" padding: 0px; margin: 0px; font-weight: bold;">
                                    {{ $result['num'] ?? '' }}
                                </td>
                                <td style=" padding: 0px; font-weight: bold; margin: 0px; color: {{ $numbers[$result['b1']] ?? '' }}">
                                    {{ $result['b1'] ?? '' }}
                                </td>
                                <td style="padding: 0px; font-weight: bold; font-weight: bold; margin: 0px; color: {{ $numbers[$result['b2']] ?? '' }}">
                                    {{ $result['b2'] ?? '' }}
                                </td>
                                <td style=" padding: 0px; font-weight: bold; margin: 0px; color: {{ $numbers[$result['b3']] ?? '' }}">
                                    {{ $result['b3'] ?? '' }}
                                </td>
                                <td style="padding: 0px; margin: 0px;" class="{{ $res }}">
                                </td>
                            </tr>
                            @endforeach

                            @if(count($lines) < 20) @for($l=count($lines); $l < 20; $l++) <tr>
                                <td style="padding: 8px;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                @endfor @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class='col-6'>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class='row'>
                                <div class='col-12 '>
                                    <a wire:click="resetar()" class="btn btn-danger btn-xs btn-sm btn-bloc text-white rounded">
                                        Zerar
                                    </a>
                                    <a wire:click="back()" class="btn btn-in btn-bloc btn-xs btn-sm text-white rounded" style="background: black;">
                                        <i class="lni lni-backward"></i>
                                    </a>
                                    <a wire:click="set_max_lines(10)" class="btn btn-success btn-xs btn-sm btn-bloc text-white rounded">
                                        Últimos 10
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 ml- mt-1">
                        <div class="card ">

                            <div class='table-responsiv'>


                                <div class='row'>
                                    <div class='col-12'>
                                        <table class='text-center tabl table-bordered table-stripe table-sm table-condensed' style="font-size: 10px; width: 100%; ">
                                            <tr>
                                                <th class="p-0 gblue">LOG</th>
                                                <th class="p-0 gblue">3V</th>
                                                <th class="p-0 gblue">9V</th>
                                                <th class="p-0 gblue">E9V</th>
                                            </tr>
                                            @for($i = 1; $i < 8; $i++) <tr class="p-0">

                                                <td class="p-0 m-0 gblue"><b>{{ $i }}</b></td>
                                                @for($j = 1; $j <= 3; $j++) <td class="p-1 r2" style="@if($log_id == $i && $neighbor == $j) background:black; color:white; @endif ">
                                                    <a wire:click="change_log({{ $i }}, {{ $j }})" class="bt {{ $results['wins'][$i]['neighbors'][$j]['color'] ?? '' }} p-0 btn-outline-black px-2 py-0 rounded">
                                                        @if($log_id == $i && $neighbor == $j)
                                                        {{ $results['wins'][$i]['neighbors'][$j]['wins'] ?? '' }}
                                                        @else
                                                        <span>
                                                            {{ $results['wins'][$i]['neighbors'][$j]['wins'] ?? '' }}
                                                        </span>
                                                        @endif
                                                    </a>
                                                    </td>
                                                    @endfor
                                                    </tr>
                                                    @endfor

                                                    <tr>
                                                        <td style="height: 16px; background: white; border-left: white 1px solid; border-right: white 1px solid;" colspan="4"></td>
                                                    </tr>

                                                    <tr>
                                                        <th class="gblue">LOG</th>
                                                        <th class="gblue">Dezenas</th>
                                                        <th class="gblue">Colunas</th>
                                                        <th class=""></th>
                                                    </tr>


                                                    <tr>
                                                        <td class="gblue">1</td>
                                                        <td style="@if($log_id == 1 && $dozen_id == 1) border: 2px solid #17a2b8; @endif @if($log_id == 1 && $dozen_id == 1) background:black; color:white; @endif">
                                                            <a wire:click="change_dozen(1,1)" class="bt r2 {{ $results['wins']['groups']['dozens'][1]['color'] ?? '' }} p-0 btn-outline-black px-2 py-0 rounded" style="padding: 0px; margin: 0px;">
                                                                <span>
                                                                    {{ $results['wins']['groups']['dozens'][1]['wins'] ?? '' }}
                                                                </span>
                                                            </a>
                                                        </td>

                                                        <td style="@if($log_id == 1 && $col_id == 1) border: 2px solid #17a2b8; @endif @if($log_id == 1 && $col_id == 1) background:black; color:white; @endif">
                                                            <a wire:click=" change_col(1,1)" class="bt r2 {{ $results['wins']['groups']['cols'][1]['color'] ?? '' }} p-0 btn-outline-black px-2 py-0 rounded">
                                                                <span>
                                                                    {{ $results['wins']['groups']['cols'][1]['wins'] ?? '' }}
                                                                </span>
                                                            </a>
                                                        </td>
                                                        <td style="background: white;"></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="gblue">2</td>
                                                        <td style="@if($log_id == 2 && $dozen_id == 2) border: 2px solid #17a2b8; @endif @if($log_id == 2 && $dozen_id == 2) background:black; color:white; @endif">
                                                            <a wire:click="change_dozen(2,2)" class="bt r2 {{ $results['wins']['groups']['dozens'][2]['color'] ?? '' }} p-0 btn-outline-black px-2 py-0 rounded">
                                                                <span>
                                                                    {{ $results['wins']['groups']['dozens'][2]['wins'] ?? '' }}
                                                                </span>
                                                            </a>
                                                        </td>

                                                        <td style="@if($log_id == 2 && $col_id == 2) border: 2px solid #17a2b8; @endif @if($log_id == 2 && $col_id == 2) background:black; color:white; @endif">
                                                            <a wire:click=" change_col(2,2)" class="bt r2 {{ $results['wins']['groups']['cols'][2]['color'] ?? '' }} p-0 btn-outline-black px-2 py-0 rounded">
                                                                <span>
                                                                    {{ $results['wins']['groups']['cols'][2]['wins'] ?? '' }}
                                                                </span>
                                                            </a>
                                                        </td>
                                                        <td style="background: white;"></td>
                                                    </tr>

                                                    <!-- <tr style=" font-size: 10px;" class="text-left">
                                                        <td colspan="4">
                                                            <span style="background: blue;">&nbsp;&nbsp;&nbsp;</span>
                                                            Melhor Jogada
                                                            &nbsp;
                                                            &nbsp;
                                                            <span style="background: green;">&nbsp;&nbsp;&nbsp;</span>
                                                            Melhor Log
                                                            &nbsp;
                                                            &nbsp;
                                                            <span style="background: #f697ad;">&nbsp;&nbsp;&nbsp;</span>
                                                            Melhor Log do Vizinho 
                                                        </td>
                                                    </tr> -->
                                        </table>

                                        <br>
                                        <br>
                                        <pre>{{-- print_r($numbers_play2) --}}</pre>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            // Set initial zoom level
            var zoom_level = 100;

            // Click events
            $('#zoom_in').click(function() {
                zoom_page(5, $(this))
            });
            $('#zoom_out').click(function() {
                zoom_page(-5, $(this))
            });
            $('#zoom_reset').click(function() {
                zoom_page(0, $(this))
            });

            // Zoom function
            function zoom_page(step, trigger) {
                // Zoom just to steps in or out
                if (zoom_level >= 120 && step > 0 || zoom_level <= 80 && step < 0) return;

                // Set / reset zoom
                if (step == 0) zoom_level = 100;
                else zoom_level = zoom_level + step;

                // Set page zoom via CSS
                $('body').css({
                    transform: 'scale(' + (zoom_level / 100) + ')', // set zoom
                    transformOrigin: '50% 0' // set transform scale base
                });

                // Adjust page to zoom width
                if (zoom_level > 100) $('body').css({
                    width: (zoom_level * 1.2) + '%'
                });
                else $('body').css({
                    width: '100%'
                });

                // Activate / deaktivate trigger (use CSS to make them look different)
                // if (zoom_level >= 120 || zoom_level <= 80) trigger.addClass('disabled');
                // else trigger.parents('ul').find('.disabled').removeClass('disabled');
                // if (zoom_level != 100) $('#zoom_reset').removeClass('disabled');
                // else $('#zoom_reset').addClass('disabled');
            }
        });
    </script>



    <style>
        .container {
            background: #eee;
            height: 100vh;
            width: 100%;
            max-width: 100%;
        }

        .card {
            padding: 5px;
            border-radius: 10px;
        }

        .h100 {
            height: 100%;
        }

        .col-6 {
            padding: 2px;
            margin: 0px;
        }

        .black {
            background: black;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .bg-black {
            background: black;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .bg-red {
            background: red;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .red {
            background: red;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .green {
            background: green;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        .black:hover {
            color: white;
        }

        .red:hover {
            color: white;
        }

        .green:hover {
            color: white;
        }

        .bt-0 {
            cursor: pointer;
            height: 100%;
        }

        .bt {
            cursor: pointer;
        }

        .bt-numbers {
            padding: 2px 2px;
            margin-bottom: 1px;
            font-weight: bold;
            font-size: 13px;
        }

        .table2 {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            font-size: 12px;
        }

        .cornertl {
            border-collapse: separate;
            border-top-left-radius: 36px;
        }

        .cornerbl {
            border-collapse: separate;
            border-bottom-left-radius: 36px;
        }

        .cornertr {
            border-collapse: separate;
            border-top-right-radius: 36px;
        }

        .cornerbr {
            border-collapse: separate;
            border-bottom-right-radius: 36px;
        }

        .blackt {
            background: black;
            color: white;
            font-weight: bold;
        }

        .redt {
            background: red;
            color: white;
            font-weight: bold;
        }

        .bt-red {
            background: red;
            color: white !important;
        }

        .bt-green {
            background: green;
            color: white !important;
        }

        .bt-pink {
            background: #f697ad;
            color: white !important;
        }

        .content_center {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 35px;
        }

        .circule {
            /* padding: 2px 4px; */
            color: yellow;
            background: green;
            border-radius: 20px;
            font-size: 15px;
        }

        .gblue {
            background: #191970;
            color: white;
            font-size: 12px;
        }

        .btn-outline-black {
            border: 1px black solid;
        }

        .bt-blue {
            background: blue;
            color: white !important;
        }

        .r2 {
            border-radius: 5px;
            -moz-border-radius: 5px;
            padding: 5px;
            font-size: 13px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid white;
        }

        tbody tr:nth-child(odd) {
            background-color: #ccc;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

</div>