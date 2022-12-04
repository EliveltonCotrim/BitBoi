<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $qtdCount = 1;

    public function incrementQtd()
    {
        $this->qtdCount++;
    }

    public function decrementQtd()
    {
        if ($this->qtdCount == 1) {
            $this->qtdCount;
        } else {
            $this->qtdCount--;
        }
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
