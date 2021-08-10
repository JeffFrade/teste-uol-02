<div class="row">
    @include('util.errors')

    <div class="col-md-8">
        <div class="form-group">
            <label for="nome"><span class="required">*</span> Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{ old('nome', $curso->nome ?? '') }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="date"><span class="required">*</span> Data:</label>
            <input type="text" id="date" name="date" class="form-control datepicker" placeholder="Data" value="{{ old('date', \App\Helpers\StringHelper::explodeBlankSpace($curso->data_inicio ?? '')[0] ?? '') }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="hour"><span class="required">*</span> Hora:</label>
            <input type="time" id="hour" name="hour" class="form-control" placeholder="Hora" value="{{ old('hour', \App\Helpers\StringHelper::explodeBlankSpace($curso->data_inicio ?? '')[1] ?? '') }}">
        </div>
    </div>
</div>
