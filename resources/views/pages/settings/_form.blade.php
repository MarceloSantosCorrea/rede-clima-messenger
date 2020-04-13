<div class="form-row">
    <div class="form-group col-md-3">
        <label for="name" class="col-form-label">Notificar quantos minutos antes de começar o programa?</label>
        <input type="number" min="0" class="form-control" name="setting[notify_time_before]" id="notify_time_before"
               value="{{ $model['notify_time_before'] ?? null  }}">
    </div>
</div>

<button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>