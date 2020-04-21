<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - Comentário</title>
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
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title" style="line-height:35px;">
                                <span id="comments-counter"></span> comentários
                                <button class="btn btn-primary" id="login-facebook" style="display: none; float: right">
                                    <i class="fe-facebook"></i> Logar com Facebook
                                </button>
                                <button class="btn btn-primary" id="logout-facebook" style="display: none; float: right">
                                    <i class="fe-facebook"></i> Sair do Facebook
                                </button>
                                <div class="clearfix"></div>
                            </h4>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="comment" id="comment">
                                <div class="input-group-append">
                                    <button class="btn btn-success" id="send-comment" type="button">
                                        <i class="fe-send"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div style="max-height: 387px; overflow-y: scroll" id="messages-list">
                        @if($comments)
                            @foreach($comments as $comment)
                                @include('pages.form-comment.comment-item', compact('comment'))
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/rc/facebook.js', true) }}?{{time()}}"></script>
        <script src="{{ asset('assets/js/rc/pusher.js', true) }}?{{time()}}"></script>
        <script src="{{ asset('assets/js/rc/comments.js', true) }}?{{time()}}"></script>
        <script>
          $(document).ready(function () {
            RcComments.init({
              pusherKey: '{{ \Config::get('broadcasting.connections.pusher.key') }}',
              pusherCluster: '{{ \Config::get('broadcasting.connections.pusher.options.cluster') }}',
              pusherForceTLS: {{ \Config::get('broadcasting.connections.pusher.options.useTLS') }},
              pusherSubscribe: '{{\Str::slug(\Config::get('app.url'))}}-redeclima',
            });
          });
        </script>
    </body>
</html>