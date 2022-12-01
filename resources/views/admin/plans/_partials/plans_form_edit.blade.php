<div class='form-row'>
    <div class='col-md-4'>
        <label>Nome</label>
        <input type='text' name='name' value='{{ old('name') ?? $plan->name }}' class='form-control'>
    </div>
    <div class="col-md-4">
        <label for="">Moeda</label>
        <input type='text' name='coin' value='{{ old('coin') ?? $plan->coin->name  }}' class='form-control' reload>

        {{-- <select id="coin" name="coin" class="form-control">
            <option value="{{ $plan->coin->id }}" selected desable>{{ $plan->coin->name }}</option>
            @foreach ($coins as $coin)
                @if ($coin->id != $plan->coin->id)
                    <option value="{{ $coin->id }}" {{ old('coin') == $coin->id ? 'selected' : '' }}>
                        {{ $coin->name }}
                        - R$
                        {{ $coin->latestCotacao->value }} </option>
                @endif
            @endforeach
        </select> --}}
    </div>
</div>
<br>
<div class='form-row'>

    <div class="col-md-2">
        <label for="">Quantidade</label>
        <input type='number' name='quantity' value='{{ old('quantity') ?? $plan->quantity }}' class='form-control'>
    </div>

    <div class='col-md-3'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ old('value') ?? $plan->value }}' class='form-control'>
    </div>
    <div class='col-md-3'>
        <label>Percentual de Lucro(%)</label>
        <input type='text' name='percentual_rendimento'
            value='{{ old('percentual_rendimento') ?? $plan->percentual_rendimento }}' class='form-control moeda'>
    </div>

</div>
<div class="form-row">
    <div class='col-md-4'>
        <label>Tempo para retorno de Investimento (meses)</label>
        <input class="form-control" type='number' min="0" name="time_pri"
            value="{{ $plan->time_pri ?? old('time_pri') }}">
    </div>
</div>
<div class="form-row mt-3">
    <div class='col-md-8'>
        <label>Descrição</label>
        <textarea class="form-control" name="details" cols="10" rows="3" maxlength="350">{{ old('details') ?? $plan->details }}</textarea>

    </div>
</div>
<div class='form-row mt-3'>
    <div class='col-md-8'>

        <label>Status</label>
        <br>
        <label for="active">
            <input {{ $plan->status == 'active' ? 'checked' : '' }} value="active" id="active" type='radio'
                name='status' class='form-contro'>
            Active
        </label>

        <label for="inactive">
            <input {{ $plan->status == 'inactive' ? 'checked' : '' }} value="inactive" id="inactive" type='radio'
                name='status' class='form-contro'>
            Inactive
        </label>
    </div>
</div>


<div class='form-row'>
    <div class='col-md-2'>
        <label>&nbsp;</label>
        <button type='submit' class='btn btn-primary form-control'>
            Salvar
        </button>
    </div>
</div>
