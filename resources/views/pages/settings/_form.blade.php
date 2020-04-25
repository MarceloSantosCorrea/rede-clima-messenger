<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Notificar quantos minutos antes de começar o programa?</label>
        <input type="number" min="0" class="form-control" name="setting[notify_time_before]" id="notify_time_before"
               value="{{ $model['notify_time_before'] ?? null }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Endereço do Stream</label>
        <input type="text" class="form-control" name="setting[stream_url]" id="stream_url"
               value="{{ $model['stream_url'] ?? null }}">
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Pusher Key</label>
        <input type="text" class="form-control" name="setting[pusher_key]" id="pusher_key"
               value="{{ $model['pusher_key'] ?? null }}">
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Pusher Cluster</label>
        <input type="text" class="form-control" name="setting[pusher_cluster]" id="pusher_cluster"
               value="{{ $model['pusher_cluster'] ?? null }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Pusher Channel</label>
        <input type="text" class="form-control" name="setting[pusher_channel]" id="pusher_channel"
               value="{{ $model['pusher_channel'] ?? null }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-8">
        <label for="name" class="col-form-label">Pusher Event</label>
        <input type="text" class="form-control" name="setting[pusher_event]" id="pusher_event"
               value="{{ $model['pusher_event'] ?? null }}">
    </div>
</div>

<button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>