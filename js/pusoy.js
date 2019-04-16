(function() {
  var pusoy = (function() {
    var pusoy = function(selector) {
      // Allows calling of pusoy without the 'new' keyword
      if (this instanceof pusoy) {
        if(typeof selector == 'object') {
          // Constructor was passed a HTML Node,
          // Manually assign this.el as an array containing the single Node,
          // so as to emulate the results of document.querySelectorAll()
          this.el = [selector];
          return this;
        } else {
          this.el = document.querySelectorAll(selector);
        }
      } else {
        return new pusoy(selector);
      }
    };

    pusoy.prototype.css = function(styles) {
      for(var i=0;i<this.el.length;i++) {
        for (var property in styles) {
          this.el[i].style[property] = styles[property];
        }
      }
    };

    pusoy.prototype.setClass = function(cl) {
      for(var i=0;i<this.el.length;i++) {
        this.el[i].className = cl;
      }
    };

    pusoy.prototype.appendClass = function(cl) {
      for(var i=0;i<this.el.length;i++) {
        this.el[i].className += ' ' + cl;
      }
    };

    pusoy.prototype.hasClass = function(cl) {
      for(var i=0;i<this.el.length;i++) {
        if (this.el[i].className.indexOf(cl) == -1) {
          return false; // Immediately return, no class found in the set of matched objects.
        }
      }
      return true; // Made it through the loop above without returning, all objects have said class
    };

    pusoy.prototype.classNames = function() {
      classes = [];
      for(var i=0;i<this.el.length;i++) {
        classes.push(this.el[i].className);
      }
      return classes;
    };

    pusoy.prototype.removeClass = function(cl) {
      for (var i = 0; i < this.el.length; i++) {
        var classes = this.el[i].className.split(' ');
        if (classes.indexOf(cl) != -1) {
          classes.splice(classes.indexOf(cl), 1);
          this.el[i].className = classes.join(' ');
        }
      }
    };

    pusoy.prototype.on = function(event, callback) {
      for(var i=0;i<this.el.length;i++) {
        this.el[i].addEventListener(event, callback);
      }
    };

    pusoy.prototype.attr = function(attributes) {
      // Getter
      if (typeof attributes == 'string') {
        for(var i=0;i<this.el.length;i++) {
          return this.el[i][attributes];
        }
      }
      // Setter
      for (var attribute in attributes) {
        for(var i=0;i<this.el.length;i++) {
          this.el[i][attribute] = attributes[attribute];
        }
      }
    };

    pusoy.prototype.text = function(text) {
      var currentText = [];
      for(var i=0;i<this.el.length;i++) {
        // if text is undefined then we are calling as a 'getter' so
        // lets store an array of all of the elements text and return it to
        // the user
        if (typeof text == 'undefined') {
          currentText.push(this.el[i].innerHTML);
        } else {
          this.el[i].innerHTML = text;
        }
      }

      // Return just the first result if there is only one
      if (currentText.length == 1) {
        return currentText[0];
      } else if (currentText.length > 1) {
        return currentText;
      }
    };

    pusoy.prototype.each = function(callback) {
      for (var i = 0; i < this.el.length; i++) {
        // How to return instance of pusoy element???
        callback(i, new pusoy(this.el[i]));
      }
    };

    pusoy.ajax = function(options) {
      return new Promise(function(resolve, reject) {
        var http = new XMLHttpRequest();

        http.open(options.method.toUpperCase(), options.url, true);

        http.onreadystatechange = function() {
          if (http.readyState == XMLHttpRequest.DONE) {
            if (http.status == 200) {
              resolve(JSON.parse(http.responseText));
            } else {
              reject(Error('Server responded with a status of: ' + http.status));
            }
          }
        };

        // So we're not sending an undefined dataset to the server
        options.data = options.data || '';

        // If the request type is post
        // set header to default data type of json
        if (options.method.toUpperCase() == 'POST') {
          http.setRequestHeader('Content-type', 'application/json');
          options.data = JSON.stringify(options.data);
        }

        // Set all headers
        if (options.headers) {
          pusoy.each(options.headers, function(key, value) {
            http.setRequestHeader(key, value);
          });
        }

        http.send(options.data);
      });
    };

    pusoy.get = function(url) {
      return pusoy.ajax({
        method: 'GET',
        url: url
      });
    };

    pusoy.post = function(url, data, headers) {
      return pusoy.ajax({
        method: 'POST',
        url: url,
        data: data,
        headers: headers
      });
    };

    pusoy.each = function(collection, callback) {
      if (typeof collection == 'array') {
        for (var i = 0; i < collection.length; i++) {
          callback(i, collection[i]);
        }
      }

      if (typeof collection == 'object') {
        for (var key in collection) {
          callback(key, collection[key]);
        }
      }
    };

    pusoy.on = function( elem, types, selector, data, fn, one ) {
      var origFn, type;

      // Types can be a map of types/handlers
      if ( typeof types === "object" ) {

        // ( types-Object, selector, data )
        if ( typeof selector !== "string" ) {

          // ( types-Object, data )
          data = data || selector;
          selector = undefined;
        }
        for ( type in types ) {
          on( elem, type, selector, data, types[ type ], one );
        }
        return elem;
      }

      if ( data == null && fn == null ) {

        // ( types, fn )
        fn = selector;
        data = selector = undefined;
      } else if ( fn == null ) {
        if ( typeof selector === "string" ) {

          // ( types, selector, fn )
          fn = data;
          data = undefined;
        } else {

          // ( types, data, fn )
          fn = data;
          data = selector;
          selector = undefined;
        }
      }
      if ( fn === false ) {
        fn = returnFalse;
      } else if ( !fn ) {
        return elem;
      } 
};




    pusoy.getClass = function(elem) {
      return elem.getAttribute && elem.getAttribute( "class" ) || "";
    }; 
    pusoy.classesToArray = function(value) {
      if ( Array.isArray( value ) ) {
        return value;
      }
      if ( typeof value === "string" ) {
        return value.match( rnothtmlwhite ) || [];
      }
      return [];
    };  

    return pusoy;
  })();

  if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = pusoy;
  } else {
    window.pusoy = pusoy;
  }
})();
