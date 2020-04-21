var RcPusher = function () {
  return {
    init: function (config) {

      var pusher = new Pusher(config.pusherKey, {cluster: config.pusherCluster, forceTLS: config.pusherForceTLS});
      var channel = pusher.subscribe(config.pusherSubscribe);

      channel.bind(config.pusherBind, function (response) {
        config.pusherResponseEvent(response);
      });
    }
  }
}();

