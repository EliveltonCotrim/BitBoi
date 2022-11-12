<?php

namespace App\Src\Transactions;

class ColsDozens {

    //!==================================== Cols =========================================
    //     COLUNAS (RUAS) LOG 1                     // COLUNAS (RUAS) LOG 2
    // 1,4,7,10,13,16,19,22,25,28,31,34 –           // 1,4,7,10,13,16,19,22,25,28,31,34 –
    // JOGAR NA 1 E 2 COLUNAS (RUAS)                // JOGAR NA 2 e 3 COLUNAS (RUAS)
    // -------------------------------------        // -------------------------------------
    // 2,5,8,11,14,17,20,23,26,29,32,35 –           // 2,5,8,11,14,17,20,23,26,29,32,35 –
    // JOGAR NA 2 E 3 COLUNAS (RUAS)                // JOGAR NA 1 e 2 COLUNAS (RUAS)
    // -------------------------------------        // -------------------------------------
    // 3,6,9,12,15,18,21,24,27,30,33,36 -           // 3,6,9,12,15,18,21,24,27,30,33,36 -
    // JOGAR NA 2 E 3 COLUNAS (RUAS)                // JOGAR NA 1 e 2 COLUNAS (RUAS)

    private $group_cols_1 = [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34];
    private $group_cols_2 = [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35];
    private $group_cols_3 = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36];

    public function cols_result($number) {
        if (in_array($number, $this->group_cols_1)) {
            return '1C';
        } elseif (in_array($number, $this->group_cols_2)) {
            return '2C';
        } elseif (in_array($number, $this->group_cols_3)) {
            return '3C';
        }
    }

    public function cols_log1($number) {
        if ($number == 0) {
            return ["X", "X"];
        } elseif (in_array($number, $this->group_cols_1)) {
            return ["1C", "2C"];
        } elseif (in_array($number, $this->group_cols_2)) {
            return ["2C", "3C"];
        } elseif (in_array($number, $this->group_cols_3)) {
            return ["2C", "3C"];
        } else {
            return false;
        }
    }

    public function cols_log2($number) {
        if ($number == 0) {
            return ["X", "X"];
        } elseif (in_array($number, $this->group_cols_1)) {
            return ["2C", "3C"];
        } elseif (in_array($number, $this->group_cols_2)) {
            return ["1C", "2C"];
        } elseif (in_array($number, $this->group_cols_3)) {
            return ["1C", "2C"];
        } else {
            return false;
        }
    }

    //!==================================== Dozens =========================================
    // DEZENAS LOG1                                 // DEZENAS LOG2
    // 1,2,3,4,5,6,7,8,9,10,11,12 – JOGAR NA        // 1,2,3,4,5,6,7,8,9,10,11,12 – JOGAR NA 
    // 1 E 2 DEZENAS                                // 2 E 3 DEZENAS
    // -------------------------------------        // -------------------------------------
    // 13,14,15,16,17,18,19,20,21,22,23,24          // 13,14,15,16,17,18,19,20,21,22,23,24 
    // – JOGAR NA 2 E 3 DEZENAS                     // – JOGAR NA 1 E 3 DEZENAS
    // -------------------------------------        // -------------------------------------
    // 24,25,26,27,28,29,30,31,32,33,34,35,         // 24,25,26,27,28,29,30,31,32,33,34,35,
    // 36 – JOGAR NA 1 E 3 DEZENAS                  // 36 – JOGAR NA 1 E 2 DEZENAS

    private $group_dozens_1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    private $group_dozens_2 = [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    private $group_dozens_3 = [24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36];

    public function dozens_result($number) {
        if (in_array($number, $this->group_dozens_1)) {
            return '1D';
        } elseif (in_array($number, $this->group_dozens_2)) {
            return '2D';
        } elseif (in_array($number, $this->group_dozens_3)) {
            return '3D';
        }
    }

    public function dozens_log1($number) {
        if ($number == 0) {
            return ["X", "X"];
        } elseif (in_array($number, $this->group_dozens_1)) {
            return ["1D", "2D"];
        } elseif (in_array($number, $this->group_dozens_2)) {
            return ["2D", "3D"];
        } elseif (in_array($number, $this->group_dozens_3)) {
            return ["1D", "3D"];
        } else {
            return false;
        }
    }

    public function dozens_log2($number) {
        if ($number == 0) {
            return ["X", "X"];
        } elseif (in_array($number, $this->group_dozens_1)) {
            return ["2D", "3D"];
        } elseif (in_array($number, $this->group_dozens_2)) {
            return ["1D", "3D"];
        } elseif (in_array($number, $this->group_dozens_3)) {
            return ["1D", "2D"];
        } else {
            return false;
        }
    }
}
