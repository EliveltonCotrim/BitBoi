<?php

namespace App\Src\Transactions;

use App\Models\Number_logsModel;
use App\Models\NumbersModel;
use Illuminate\Support\Facades\Storage;

class Import {

    private $red = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];

    public function start() {
        return;

        NumbersModel::truncate();

        $this->imp3v();
        $this->imp9v('v9.csv', 2);
        $this->imp9v('v9e.csv', 3);
    }

    public function imp9v($file_name, $neighbor_id) {
        $csv = Storage::get($file_name);
        $lines = explode("\n", $csv);

        unset($lines[0]);
        $insert = [];
        foreach ($lines as $line) {
            if ($line == '')
                continue;

            $dados = explode(',', $line);
            $log_name = $dados[0];
            $bet_name = $dados[1];

            $log = Number_logsModel::where('name', strtoupper($log_name))->first();

            unset($dados[0]);
            unset($dados[1]);

            $number = 0;
            foreach ($dados as $dado) {
                $key = "{$log->id}_{$number}";

                if (isset($insert[$key])) {
                    $insert[$key]['bet1'] = $dado;
                } else {
                    $insert[$key] = [
                        'number' => $number,
                        'color' => in_array($number, $this->red) ? 'red' : 'black',
                        'neighbor_id' => $neighbor_id,
                        'log_id' => $log->id,
                        'bet1' => $bet_name == 'bet1' ? $dado : '',
                    ];
                }

                $number++;
            }
        }
        NumbersModel::insert($insert);
    }

    public function imp3v() {
        $csv = Storage::get('v3.csv');
        $lines = explode("\n", $csv);

        unset($lines[0]);

        $insert = [];
        foreach ($lines as $line) {
            if ($line == '')
                continue;

            $dados = explode(',', $line);

            $log_name = $dados[0];
            $bet_name = $dados[1];

            $log = Number_logsModel::where('name', strtoupper($log_name))->first();

            unset($dados[0]);
            unset($dados[1]);

            $number = 0;
            foreach ($dados as $dado) {
                $key = "{$log->id}_{$number}";

                if (isset($insert[$key])) {
                    if ($bet_name == 'bet1') {
                        $insert[$key]['bet1'] = $dado;
                    } elseif ($bet_name == 'bet2') {
                        $insert[$key]['bet2'] = $dado;
                    } elseif ($bet_name == 'bet3') {
                        $insert[$key]['bet3'] = $dado;
                    }
                } else {
                    $insert[$key] = [
                        'number' => $number,
                        'color' => in_array($number, $this->red) ? 'red' : 'black',
                        'neighbor_id' => 1,
                        'log_id' => $log->id,
                        'bet1' => $bet_name == 'bet1' ? $dado : '',
                        'bet2' => $bet_name == 'bet2' ? $dado : '',
                        'bet3' => $bet_name == 'bet3' ? $dado : '',
                    ];
                }

                $number++;
            }
        }
        NumbersModel::insert($insert);
    }
}
