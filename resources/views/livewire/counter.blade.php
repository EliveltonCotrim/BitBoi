
<div class="btn-group col-md-7 m-1" role="group" aria-label="Basic example">
    <a class="btn btn-danger mr-1 " wire:click="decrementQtd">-</a>
    <input type="text" class="form-control" name="quantity_coin"  wire:model="qtdCount" value="{{ $qtdCount }}" min=1
        max=100 style="text-align:center" readonly>
    <a class="btn btn-success ml-1" wire:click="incrementQtd">+</a>
</div>
