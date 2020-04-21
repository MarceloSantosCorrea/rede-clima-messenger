var RcComments = function () {

  var commentsCounterUpdate = function () {
    const commentsCounter = document.getElementById('comments-counter');
    const messagesList = document.getElementById('messages-list');

    commentsCounter.innerText = messagesList.childElementCount || '0';
  }
  var getRandomInt = function (max) {
    return Math.floor(Math.random() * Math.floor(max));
  }
  var sendComment = function (comment) {
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
        config.inputComment.removeAttribute("disabled");
        config.btnSendComment.removeAttribute("disabled");
        config.inputComment.setAttribute("placeholder", "Adicione um comentário...");
      },
      beforeSend: function () {
        config.inputComment.setAttribute("disabled", "disabled");
        config.btnSendComment.setAttribute("disabled", "disabled");
        config.inputComment.setAttribute("placeholder", "Aguarde enviando...");
        config.inputComment.value = '';
      }
    });
  }
  var renderMessage = function (m) {
    const commentItem = document.createElement("div");
    commentItem.id = m.comment.uid;
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

  var formatDate = function (date) {
    var d = new Date(date);
    var day = (d.getDate() < 10 ? '0' : null) + d.getDate();
    var month = ((d.getMonth() + 1) < 10 ? '0' : null) + (d.getMonth() + 1);
    return day + '/' + month + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
  }

  var startBtnSendComment = function () {
    config.btnSendComment.addEventListener('click', () => {
      const comment = config.inputComment.value;
      if (comment.trim() != '') {
        sendComment(comment.trim());
      }
    });

    config.inputComment.setAttribute("disabled", "disabled");
    config.inputComment.addEventListener('keyup', (keyboardEvent) => {
      const comment = config.inputComment.value;
      if (keyboardEvent.keyCode == 13 && comment.trim() != '') {
        sendComment(comment.trim());
      }
    });
  }

  return {
    init: function (con) {
      config = {
        pusherKey: con.pusherKey,
        pusherCluster: con.pusherCluster,
        pusherForceTLS: con.pusherForceTLS,
        pusherSubscribe: con.pusherSubscribe,
        pusherBind: 'comment',
        btnSendComment: document.getElementById('send-comment'),
        inputComment: document.getElementById('comment'),
        pusherResponseEvent: function (response) {
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
        },
      }

      RcFacebook.init(config);
      RcPusher.init(config);

      commentsCounterUpdate();
      startBtnSendComment();
    }
  }
}();