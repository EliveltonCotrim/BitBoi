<?php

namespace App\Src\Transactions;

use App\Models\RaceModel;

class TrackRace {

    public function neighbors($number, $quantity) {
        if (!is_numeric($number)) {
            return [];
        }

        if ($number == '')
            return [];

        $number = intval($number);

        if ($number < 0)
            return [];

        $race = collect(RaceModel::select('number', 'color', 'order')
            ->orderBy('order')
            ->get()
            ->toArray());

        $first_key = $race->keys()->first();
        $last_key = $race->keys()->last();

        $get = $race->where('number', $number);
        $number_key =  $race->search(function ($item, $key) use ($number) {
            return $item['number'] == $number;
        });

        $result = [];
        $result['number'] = $get[$number_key]['number'];
        $result['color'] = $get[$number_key]['color'];

        $result['numbers'][] = $get[$number_key]['number'];

        $key_index = $number_key;
        for ($i = 0; $i < $quantity; $i++) {
            $key_index++;

            if ($key_index > $last_key) {
                $key_index = 0;
            }

            $number_temp = $race[$key_index]['number'];
            $result['numbers'][] = $number_temp;
            $result['colors'][$number_temp] = $race[$key_index]['color'];

            $result['right'][] = $race[$key_index]['number'];
        }

        $key_index = $number_key;
        for ($i = 0; $i < $quantity; $i++) {
            $key_index--;

            if ($key_index < $first_key) {
                $key_index = $last_key;
            }

            $number_temp = $race[$key_index]['number'];
            $result['colors'][$number_temp] = $race[$key_index]['color'];
            $result['numbers'][] = $number_temp;

            $result['left'][] = $race[$key_index]['number'];
        }

        return $result;
    }
}
