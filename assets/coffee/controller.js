// Generated by CoffeeScript 1.6.1
(function() {

  this.Controller = (function() {

    function Controller(elem) {
      this.elem = elem;
      if (this.elem == null) {
        this.elem = $('body');
      }
      this._config_elem();
    }

    Controller.prototype._config_elem = function() {
      var controller, is_event, method, tmp;
      is_event = /^.* [a-z]{4,}$/;
      controller = this;
      for (method in controller) {
        if (is_event.test(method)) {
          tmp = method.split(' ');
          $(tmp[0]).bind(tmp[1], controller[method]);
        }
      }
      return controller;
    };

    return Controller;

  })();

}).call(this);
