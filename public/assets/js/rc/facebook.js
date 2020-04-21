var RcFacebook = function () {

  const loginFacebook = document.getElementById('login-facebook');
  const logoutFacebook = document.getElementById('logout-facebook');

  var startEventsFacebook = function () {

    loginFacebook.addEventListener('click', () => {
      FB.login(function (response) {
        statusChangeCallback(response);
      }, {scope: 'email'});
    });

    logoutFacebook.addEventListener('click', () => {
      FB.logout(function (response) {
        statusChangeCallback(response);
      });
    });
  }

  var statusChangeCallback = function (response) {
    if (response.status === 'connected') {

      loginFacebook.style.display = 'none';
      logoutFacebook.style.display = 'inline-block';
      config.inputComment.setAttribute("placeholder", "Adicione um comentário...");
      config.inputComment.removeAttribute("disabled");
      FB.api('/me', {fields: "picture,email,name"}, function (response) {
        window.dataUser = response;
      });
    } else {
      logoutFacebook.style.display = 'none';
      loginFacebook.style.display = 'inline-block';
      inputComment.setAttribute("placeholder", "Logue no Facebook para comentar.");
      inputComment.setAttribute("disabled", "disabled");
    }
  }

  return {
    init: function () {

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

      startEventsFacebook();
    }
  }
}();

