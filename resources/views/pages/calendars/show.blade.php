<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Programação</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <link href="{{ asset('assets/css/bootstrap.min.css', true) }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/icons.min.css', true) }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/app.min.css', true) }}" rel="stylesheet" type="text/css"/>
        <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
        <style>
            .card-box {
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#sunday" data-toggle="tab" aria-expanded="false" class="nav-link">Domingo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#monday" data-toggle="tab" aria-expanded="true" class="nav-link active">Segunda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tuesday" data-toggle="tab" aria-expanded="false" class="nav-link">Terça</a>
                        </li>
                        <li class="nav-item">
                            <a href="#wednesday" data-toggle="tab" aria-expanded="false" class="nav-link">Quarta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#thursday" data-toggle="tab" aria-expanded="false" class="nav-link">Quinta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#friday" data-toggle="tab" aria-expanded="false" class="nav-link">Sexta</a>
                        </li>
                        <li class="nav-item">
                            <a href="#saturday" data-toggle="tab" aria-expanded="false" class="nav-link">Sábado</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="sunday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Dom'] ?? []])
                        </div>
                        <div class="tab-pane active" id="monday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Seg'] ?? []])
                        </div>
                        <div class="tab-pane" id="tuesday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Ter'] ?? []])
                        </div>
                        <div class="tab-pane" id="wednesday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Qua'] ?? []])
                        </div>
                        <div class="tab-pane" id="thursday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Qui'] ?? []])
                        </div>
                        <div class="tab-pane" id="friday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Sex'] ?? []])
                        </div>
                        <div class="tab-pane" id="saturday">
                            @include('pages.calendars.table-calendars-site', ['data' => $data['Sáb'] ?? []])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/vendor.min.js', true) }}"></script>
        <script src="{{ asset('assets/js/app.min.js', true) }}"></script>
        <script>
            var pusher = new Pusher('{{ \Config::get('broadcasting.connections.pusher.key') }}', {
                cluster: '{{ \Config::get('broadcasting.connections.pusher.options.cluster') }}',
                forceTLS: {{ \Config::get('broadcasting.connections.pusher.options.useTLS') }}
            });

            var channel = pusher.subscribe('{{\Str::slug(\Config::get('app.url'))}}-redeclima');
            channel.bind('comment', function (response) {

                if (response.data.action == 'change-programation') {
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/calendars/json',
                        data: {
                            action: "new-comment",
                        },
                        error: function (error) {
                            console.log(error.responseText);
                        },
                        success: function (data) {
                            render(document.getElementById('sunday'), data['Dom'])
                            render(document.getElementById('monday'), data['Seg'])
                            render(document.getElementById('tuesday'), data['Ter'])
                            render(document.getElementById('wednesday'), data['Qua'])
                            render(document.getElementById('thursday'), data['Qui'])
                            render(document.getElementById('friday'), data['Sex'])
                            render(document.getElementById('saturday'), data['Sáb'])
                        },
                        beforeSend: function () {

                        }
                    });
                }
            });

            function render(target, data) {

                var html = '<table class="table table-striped table-hover"><thead><tr><th>Horário</th><th>Programa</th><th>Apresentador</th><th>Categoria</th></tr></thead><tbody>';

                data.forEach((key) => {
                    html += '<tr>';
                    html += '   <td>' + key['start_time'] + '</td>';
                    html += '   <td>' + key['name'] + '</td>';
                    html += '   <td>' + key['presenter'] + '</td>';
                    html += '   <td>' + key['category'] + '</td>';
                    html += '</tr>';
                });

                html += '</tbody></table>';

                target.innerHTML = html;
            }
        </script>
    </body>
</html>