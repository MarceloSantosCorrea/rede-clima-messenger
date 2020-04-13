<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $model->name ?? null) }}">
        @if ($errors->has('name'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('name') }}</li>
            </ul>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Slogan</label>
        <input type="text" class="form-control" name="slogan" id="slogan" value="{{ old('slogan', $model->slogan ?? null) }}">
        @if ($errors->has('slogan'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('slogan') }}</li>
            </ul>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Apresentador</label>
        <input type="text" class="form-control" name="presenter" id="presenter" value="{{ old('presenter', $model->presenter ?? null) }}">
        @if ($errors->has('presenter'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('presenter') }}</li>
            </ul>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Categoria</label>
        <input type="text" class="form-control" name="category" id="category" value="{{ old('category', $model->category ?? null) }}">
        @if ($errors->has('category'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('category') }}</li>
            </ul>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="name" class="col-form-label">Descrição</label>
        <textarea class="form-control" name="description" id="description">{{ old('description', $model->description ?? null) }}</textarea>
        @if ($errors->has('description'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('description') }}</li>
            </ul>
        @endif
    </div>
</div>

<button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>