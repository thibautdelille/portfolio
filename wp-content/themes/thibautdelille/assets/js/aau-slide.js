/*********************
 * aau-slide.js
 *********************/
!function ($) {

	/* SLIDE CLASS */
  var Slide = function (element, options) {
    this.$element = $(element);
    this.options = options;
    this.$element.data('data-loaded', false);
  };

  Slide.prototype = {

    // Load the Slide
    load: function() {
      var self = this;
      this.$img = $('<img/>').attr('src', this.options.src+'?'+Math.random()*1000000000);
      this.$img.load(function() {
        if(!self.$element.data('loaded')){
          self.$element.attr('data-loaded', true);
          self.$element.prepend(self.$img);
          self.$element.trigger('load', {id:self.$element.attr('id')});
          self.$element.find('.info').css('display','block');
        }
      });
    },

    updateWidth: function() {
      if(isSafari){
        var self = this;
        self.$img = self.$element.find('img:first-child');
        var naturalWidth = self.$img.prop('naturalWidth');
        var naturalHeight = self.$img.prop('naturalHeight');

        var imgWidth = self.$img.width();
        var imgHeight = self.$img.height();

        if(imgWidth/imgHeight!==naturalWidth/naturalHeight){
          imgWidth = naturalWidth*imgHeight/naturalHeight;
          self.$img.css('width', imgWidth);
        }
      }
    },

    setPrevious: function() {
      var marginLeft,left;

      this.updateWidth();

      marginLeft = -(parseInt(this.$element.next().css('left'), 10)-this.$element.width()/2);
      left = parseInt(this.$element.next().css('left'), 10)-this.$element.width();


      this.$element.css('left', left);
      this.$element.attr('data-margin-left', marginLeft);
      this.$element.data('margin-left', marginLeft);
    },

    setNext: function() {
      var marginLeft,left;

      this.updateWidth();

      marginLeft = -(parseInt(this.$element.prev().css('left'), 10)+this.$element.prev().width()+this.$element.width()/2);
      left = parseInt(this.$element.prev().css('left'), 10)+this.$element.prev().width();

      this.$element.css('left', left);
      this.$element.attr('data-margin-left', marginLeft);
      this.$element.data('margin-left', marginLeft);
    },

    // Is Loaded function
    isLoaded: function() {
      return this.isLoaded;
    }
  };

  /* SLIDE PLUGIN */
  var old = $.fn.slide;

  $.fn.slide = function (option) {
    return this.each(function () {
      var $this = $(this),
          data = $this.data('slide'),
          options = $.extend({}, $.fn.slide.defaults, typeof option === 'object' && option, $this.data()),
          action = typeof option === 'string' ? option : options.slide;
      if (!data) {
        $this.data('aau.slide', (data = new Slide(this, options)));
      }
      if (action) {
        data[action]();
      }
    });
  };
  // No autoplay by default
  $.fn.slide.defaults = {};
  $.fn.slide.Constructor = Slide;

  /* SLIDE NO CONFLICT */
  $.fn.slide.noConflict = function () {
    $.fn.slide = old;
    return this;
  };

}(window.jQuery);