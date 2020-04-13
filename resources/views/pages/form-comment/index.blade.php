<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Comentário</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
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
        <script>

          function commentsCounterUpdate() {
            const commentsCounter = document.getElementById('comments-counter');
            const messagesList = document.getElementById('messages-list');

            commentsCounter.innerText = messagesList.childElementCount || '0';
          }

          commentsCounterUpdate();

          const btnLoginFacebook = document.getElementById('login-facebook');
          const btnLogoutFacebook = document.getElementById('logout-facebook');
          const btnSendComment = document.getElementById('send-comment');
          var userAgent = localStorage.getItem('message_uniq_send');
          btnSendComment.addEventListener('click', () => {
            const comment = inputComment.value;
            if (comment.trim() != '') {
              sendComment(comment.trim());
            }
          });

          const inputComment = document.getElementById('comment');
          inputComment.setAttribute("disabled", "disabled");
          inputComment.addEventListener('keyup', (keyboardEvent) => {

            const comment = inputComment.value;
            if (keyboardEvent.keyCode == 13 && comment.trim() != '') {
              sendComment(comment.trim());
            }
          });

          function getRandomInt(max) {
            return Math.floor(Math.random() * Math.floor(max));
          }

          function sendComment(comment) {
            const dataUser = window.dataUser;
            userAgent = getRandomInt(10000);
            localStorage.setItem('message_uniq_send', userAgent);
            $.ajax({
              type: 'POST',
              dataType: 'json',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: '/form-comments/ajax',
              data: {
                action: "new-comment",
                userAgent: userAgent,
                dataUser: dataUser,
                comment: comment
              },
              error: function (error) {
                console.log(error.responseText);
              },
              success: function (data) {

                console.log(data);

                // renderMessage({
                //   dataUser: dataUser,
                //   comment: comment,
                //   comment_id: data.uid
                // });

                inputComment.removeAttribute("disabled");
                btnSendComment.removeAttribute("disabled");
                inputComment.setAttribute("placeholder", "Adicione um comentário...");
              },
              beforeSend: function () {
                inputComment.setAttribute("disabled", "disabled");
                btnSendComment.setAttribute("disabled", "disabled");
                inputComment.setAttribute("placeholder", "Aguarde enviando...");
                inputComment.value = '';
              }
            });
          }

          const loginFacebook = document.getElementById('login-facebook');
          loginFacebook.addEventListener('click', () => {
            FB.login(function (response) {
              statusChangeCallback(response);
            }, {scope: 'email'});
          });
          const logoutFacebook = document.getElementById('logout-facebook');
          logoutFacebook.addEventListener('click', () => {
            FB.logout(function (response) {
              statusChangeCallback(response);
            });
          });

          window.fbAsyncInit = function () {
            FB.init({
              appId: 181260599618072,
              cookie: true,
              xfbml: true,
              version: 'v5.0'
            });

            FB.getLoginStatus(function (response) {
              statusChangeCallback(response);
            });
          };

          function renderMessage(m) {

            console.log(m);

            const commentItem = document.createElement("div");
            commentItem.id = m.comment.id;
            commentItem.classList.add('media', 'mb-2', 'border-bottom', 'pb-2');

            const commentItemImg = document.createElement("img");
            commentItemImg.src = 'storage/' + m.comment.lead.thumbnail;
            commentItemImg.height = 45;
            commentItemImg.classList.add('d-flex', 'mr-2', 'rounded-circle');

            commentItem.appendChild(commentItemImg);

            const commentItemMediaBody = document.createElement("div");
            commentItemMediaBody.classList.add('media-body');
            commentItemMediaBody.innerHTML = '<p class="mt-0 mb-0"><strong>' + m.comment.lead.name + '</strong> <span style="font-size: 10px">' + formatDate(m.comment.created_at.date) + '</span> </p>' + m.comment.comment;

            commentItem.appendChild(commentItemMediaBody);

            const messagesList = document.getElementById('messages-list');
            messagesList.prepend(commentItem);

            commentsCounterUpdate();
          }

          function formatDate(date) {
            var d = new Date(date);

            var day = (d.getDate() < 10 ? '0' : null) + d.getDate();
            var month = ((d.getMonth() + 1) < 10 ? '0' : null) + (d.getMonth() + 1);
            return day + '/' + month + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
          }

          function statusChangeCallback(response) {
            if (response.status === 'connected') {

              btnLoginFacebook.style.display = 'none';
              btnLogoutFacebook.style.display = 'inline-block';
              inputComment.setAttribute("placeholder", "Adicione um comentário...");
              inputComment.removeAttribute("disabled");
              FB.api('/me', {fields: "picture,email,name"}, function (response) {
                window.dataUser = response;
              });
            } else {
              btnLogoutFacebook.style.display = 'none';
              btnLoginFacebook.style.display = 'inline-block';
              inputComment.setAttribute("placeholder", "Logue no Facebook para comentar.");
              inputComment.setAttribute("disabled", "disabled");
            }
          }

          (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
              return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));

          var pusher = new Pusher('{{ \Config::get('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ \Config::get('broadcasting.connections.pusher.options.cluster') }}',
            forceTLS: {{ \Config::get('broadcasting.connections.pusher.options.useTLS') }}
          });

          var channel = pusher.subscribe('{{\Str::slug(\Config::get('app.url'))}}-redeclima');
          channel.bind('comment', function (response) {

            if (response.data.action == 'new-comment') {
              const dataUser = window.comment.lead;
              if (!dataUser || (dataUser.id != response.data.dataUser.id) || response.data.userAgent != userAgent) {
                renderMessage(response.data);
              }
            }

            if (response.data.action == 'remove-comment') {
              const elementDiv = document.getElementById(response.data.comment_id);
              elementDiv.remove();
            }
          });
        </script>
    </body>
</html>