<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Dia da Semana</label>
        <select class="form-control" name="week_day" id="week_day">
            <option value="">Selecione</option>
            <option value="0" {{ old('start_at', isset($model) ?$model->week_day: null) == '0' ? 'selected' : null }}>Domingo</option>
            <option value="1" {{ old('start_at', isset($model) ?$model->week_day: null) == '1' ? 'selected' : null }}>Segunda-feira</option>
            <option value="2" {{ old('start_at', isset($model) ?$model->week_day: null) == '2' ? 'selected' : null }}>Terça-feira</option>
            <option value="3" {{ old('start_at', isset($model) ?$model->week_day: null) == '3' ? 'selected' : null }}>Quarta-feira</option>
            <option value="4" {{ old('start_at', isset($model) ?$model->week_day: null) == '4' ? 'selected' : null }}>Quinta-feira</option>
            <option value="5" {{ old('start_at', isset($model) ?$model->week_day: null) == '5' ? 'selected' : null }}>Sexta-feira</option>
            <option value="6" {{ old('start_at', isset($model) ?$model->week_day: null) == '6' ? 'selected' : null }}>Sábado</option>
        </select>
        @if ($errors->has('week_day'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('week_day') }}</li>
            </ul>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Horário</label>
        <input type="time" class="form-control" name="start_at" id="start_at" value="{{ old('start_at', isset($model)? $model->start_at->format('H:i') : null) }}">
        @if ($errors->has('start_at'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('start_at') }}</li>
            </ul>
        @endif
    </div>

</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Programa</label>
        <select class="form-control" name="program_id" id="program_id" value="{{ old('program_id', $model->program_id ?? null) }}">
            <option value="">Selecione</option>
            @php $programs = \App\Models\Program::all() @endphp
            @if($programs->count())
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" {{ old('start_at', $model->program_id ?? null) == $program->id ? 'selected' : null }}>{{ $program->name }}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has('program_id'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('program_id') }}</li>
            </ul>
        @endif
    </div>
</div>

<button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>