<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name ?? null) }}">
        @if ($errors->has('name'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('name') }}</li>
            </ul>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="email" class="col-form-label">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email ?? null) }}">
        @if ($errors->has('email'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('email') }}</li>
            </ul>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="password" class="col-form-label">Senha</label>
        <input type="password" class="form-control" name="password" id="password">
        @if ($errors->has('password'))
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $errors->first('password') }}</li>
            </ul>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="active" {{ in_array(old('status', isset($user) && $user->status == 'active' ? 1 : 0), [1, 'on']) ? 'checked': null }} >
        <label class="custom-control-label" name="status" for="active">Ativo</label>
    </div>
</div>

<button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>