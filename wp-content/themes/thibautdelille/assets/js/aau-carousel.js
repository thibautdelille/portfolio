/*********************
 * aau-carousel.js
 *********************/

!function ($) {

  /* CAROUSEL CLASS */

  var Carousel = function (element, options) {
    this.$element = $(element);
    this.options = options;
    this.uid = ""+Math.random()*1000000000000;
    this.$window = $(window).on('scroll.aau.carousel.data-api.'+this.uid, $.proxy(this.checkPosition, this));

    this.checkPosition();
  };

  Carousel.prototype = {

    checkPosition: function() {
      var offset = this.$element.offset();
      if(!this.$element.is(':hidden')){
        if(offset.top<(this.$window.scrollTop()+browser('height'))){
          this.$window.off('scroll.aau.carousel.data-api.'+this.uid, $.proxy(this.checkPosition, this));
          this.init();
        }
      }
    },

    init: function() {
      var self = this;
      this.$element.on('touchstart', $.proxy(self.touchstart, self));
      this.$element.on('touchend', $.proxy(self.touchend, self));
      this.$element.on('touchmove', $.proxy(self.move, self));

      this.$slides = this.$element.find('.slides');
      this.nbCloneLeft = 0;
      this.nbCloneRight = 0;
      this.nbSlides = 0;
      this.defaultHeight = this.$element.height();

      this.$element.find('.slide').each(function(index, slide){
        $(slide).slide();
        $(slide).attr('id', index);
        $(slide).on('click', $.proxy(self.goTo, self, $(slide)));
        $(slide).on('load', $.proxy(self.slideLoaded, self));

        if ($('html').hasClass('no-csstransitions')) {
          $(slide).css({'opacity':0.2});
          $(slide).find('.info').css({'opacity':0});
        }
        self.nbSlides++;
      });

      // load the first slide
      this.$defaultSlide = this.$element.find('.slide[id="'+this.options.begin+'"]').slide('load').addClass('current');

      // add the arrows
      if(this.options.arrow){
        var arrowContainer = $('<span></span>').addClass('carousel-arrow-container');
        var arrow = $('<span></span>').addClass('carousel-arrow');
        arrowContainer.append(arrow);

        this.$arrowLeft = arrowContainer.clone().addClass('left');
        this.$arrowLeft.find('.carousel-arrow').addClass('icon-arrow-left-large');
        this.$arrowRight = arrowContainer.addClass('right');
        this.$arrowRight.find('.carousel-arrow').addClass('icon-arrow-right-large');

        this.$arrowLeft.on('click', $.proxy(self.prevSlide, self));
        this.$arrowRight.on('click', $.proxy(self.nextSlide, self));

        this.$element.append(this.$arrowLeft);
        this.$element.append(this.$arrowRight);

        this.$arrowLeft.attr('data-loading', true);
        this.$arrowRight.attr('data-loading', true);
      }
      if ($('html').hasClass('csstransitions')) {
        $(window).on('resize', $.proxy(self.resize, self));
        $(window).on('orientationchange', $.proxy(self.resize, self));
      }
    },

    touchstart: function(e) {
      var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
      //CODE GOES HERE
      this.yInit = touch.pageY;
      this.touch = true;
      this.scroll = true;
      this.xInit = touch.pageX;
      this.marginLeft = parseInt(this.$slides.css('marginLeft'), 10);
      this.$slides.css({'transition': "none"});
    },

    touchend: function(e) {
      var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
      this.touch = false;
      var diff = touch.pageX - this.xInit;
      var slide = this.$element.find('.slide.current');
      if(diff<-100){
        //swipe left
        this.goTo(slide.next());
      }else if(diff>100){
        //swipe right
        this.goTo(slide.prev());
      }else{
        this.goTo(slide);
      }
    },

    move: function(e) {
      var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
      if(this.touch&&this.scroll){
        if(Math.abs(touch.pageX - this.xInit)>Math.abs(touch.pageY - this.yInit)){
          this.scroll = false;
        }else{
          this.touch = false;
        }
      }
      if(this.touch){
        e.preventDefault();
        marginleft = this.marginLeft + touch.pageX - this.xInit;
        this.$slides.css({'marginLeft':marginleft});
      }
    },

    resize: function() {
      if(!this.$element.is(':hidden')){
        this.displaySlide();
        this.jumpTo(this.$element.find('.slide.current'));
      }
    },

    slideLoaded: function() {
      this.displaySlide();
      this.goTo(this.$element.find('.slide.current'));
    },

    nextSlide: function() {
      var nextSlide = this.$element.find('.slide.current').next();
      if(nextSlide.data('loaded')){
        this.goTo(nextSlide);
      }
    },

    prevSlide: function() {
      var previousSlide = this.$element.find('.slide.current').prev();
      if(previousSlide.data('loaded')){
        this.goTo(previousSlide);
      }
    },

    displaySlide: function() {
      this.$defaultSlide.css('left', -this.$defaultSlide.width()/2);
      this.$defaultSlide.attr('data-margin-left', 0);
      this.$defaultSlide.data('margin-left', 0);
      this.$defaultSlide.slide("updateWidth");
      //minWidth = this.$defaultSlide.width();
      // place all Slide base of the default slide
      var previousSlide = this.$defaultSlide.prev();
      while(previousSlide.length){
        if(this.$element.hasClass('tab')){
          previousSlide.width(this.$defaultSlide.width());
        }
        if(previousSlide.width() === 0){
          break;
        }
        previousSlide.slide("setPrevious");
        previousSlide = previousSlide.prev();

      }

      var nextSlide = this.$defaultSlide.next();
      while(nextSlide.length){
        if(this.$element.hasClass('tab')){
          nextSlide.width(this.$defaultSlide.width());
        }
        if(nextSlide.width() === 0){
          break;
        }
        nextSlide.slide("setNext");
        nextSlide = nextSlide.next();

      }
    },

    // Go to slide
    goTo: function($slide) {
      if(typeof $slide === 'string'){
        $slide = this.$slides.find('.slide[id="'+$slide+'"]');
      }

      var sameSlide = false;

      this.$element.trigger('goto', $slide.attr('id'));

      if($slide.hasClass('current')){
        sameSlide = true;
      }else{
        this.$element.attr("data-slided", true);
        if ($('html').hasClass('no-csstransitions')) {
          this.$element.find('.title-cta').animate({'opacity':0},500);
        }
      }

      $lastSlide = this.$element.find('.slide.current').removeClass('current');
      $slide.addClass('current');

      if(!$slide.data('loaded')){
        $slide.slide('load');
        this.$element.attr("data-loading", true);

        this.$element.css({
          "height": this.defaultHeight,
          "minHeight": this.defaultHeight,
          "maxHeight": this.defaultHeight
        });
        return false;
      }


      if ($('html').hasClass('csstransitions')&&(!isSafari)) {
        if(this.$element.hasClass('home')){
          this.$slides.css({'transition': "margin .5s, opacity 10s"});
        }else{
          this.$slides.css({'transition': "margin .5s"});
        }
        this.$slides.css({'opacity':'1'});
        this.$slides.css({'marginLeft':$slide.data('margin-left')});
      }else{
        if(!isSafari){
          this.$slides.animate({'marginLeft':$slide.data('margin-left'),'opacity':'1'}, 500);
        }else{
          this.$slides.css({'transition': "margin .5s"});
          this.$slides.css({'opacity':'1'});
          this.$slides.css({'marginLeft':$slide.data('margin-left')});
        }
        if(!sameSlide){
          $slide.css({'opacity':0.2});
          $lastSlide.css({'opacity':1});
          $slide.stop().animate({'opacity':1}, 500);
          $slide.find('.info').animate({'opacity':1});
          $lastSlide.animate({'opacity':0.2}, 500);
          $lastSlide.find('.info').animate({'opacity':0});
        }else{
          $slide.css({'opacity':1});
          $slide.find('.info').css({'opacity':1});
        }
      }

      this.$element.attr("data-ready", true);
      this.$element.attr("data-loading", false);

      var infoHeight = $slide.find('.info').height()+parseInt($slide.find('.info').css('paddingBottom'), 10)+parseInt($slide.find('.info').css('paddingTop'), 10);

      this.$element.css({
        "height": $slide.height()+infoHeight,
        "minHeight": $slide.height()+infoHeight,
        "maxHeight": $slide.height()+infoHeight
      });

      this.fillSpace($slide);

      $(window).trigger('loadimages');
      $(window).trigger('loadvideos');
    },

    // Go to slide
    jumpTo: function($slide) {

      this.$element.find('.slide.current').removeClass('current');
      $slide.addClass('current');


      this.$slides.css({'transition': "none"});
      this.$slides.css({'marginLeft':$slide.data('margin-left')});
      this.$element.attr("data-ready", true);

      var infoHeight = $slide.find('.info').height()+parseInt($slide.find('.info').css('paddingBottom'), 10)+parseInt($slide.find('.info').css('paddingTop'), 10);

      this.$element.css({
        "height": $slide.height()+infoHeight,
        "minHeight": $slide.height()+infoHeight,
        "maxHeight": $slide.height()+infoHeight
      });

      this.fillSpace($slide);
    },

    fillSpace: function($slide) {
      // check if there is space on the left
      var previousSlide = $slide.prev();
      var clone;
      var leftspace =  this.$element.width()/2 - $slide.width()/2 ;
      if($slide.hasClass('current')&&(leftspace<=0)){
        leftspace=1;
      }
      // if there is space for a slide on the left
      while(leftspace>0){
        // if there is a slide in the dom
        if(previousSlide.length){
          // if the slide is not loaded
          // then load it
          if(!previousSlide.data('loaded')){
            previousSlide.slide('load');
            this.$arrowLeft.attr('data-loading', true);
            return false;
          }else{
            // if the slide is loaded
            // remove the width of the slide to the left space
            // and get the previous slide
            leftspace -= previousSlide.width();
            previousSlide = previousSlide.prev();
          }
        }else{
          clone = this.$element.find('.slide:last-child');
          console.log(clone.attr('class'));
          this.$slides.prepend(clone);
          clone.on('click', $.proxy(self.goTo, self, clone));
          clone.on('load', $.proxy(self.slideLoaded, self));
          // if the slide is not loaded
          // then load it
          if(!clone.data('loaded')){
            clone.slide('load');
            this.$arrowLeft.attr('data-loading', true);
            return false;
          }else{
            // if the slide is loaded
            // remove the width of the slide to the left space
            // and get the previous slide
            leftspace -= clone.width();

            clone.slide("setPrevious");

            previousSlide = clone.prev();
          }
        }
      }
      this.$arrowLeft.attr('data-loading', false);

      // check if there is space on the right
      var rightspace =  this.$element.width()/2 - $slide.width()/2 ;
      var nextSlide = $slide.next();

      if($slide.hasClass('current')&&(rightspace<=0)){
        rightspace=1;
      }
      // if there is space for a slide on the right
      while(rightspace>0){
        // if there is a slide in the dom
        if(nextSlide.length){
          // if the slide is not loaded
          // then load it
          if(!nextSlide.data('loaded')){
            nextSlide.slide('load');
            this.$arrowRight.attr('data-loading', true);
            return false;
          }else{
            // if the slide is loaded
            // remove the width of the slide to the left space
            // and get the previous slide
            rightspace -= nextSlide.width();
            nextSlide = nextSlide.next();
          }
        }else{
          clone = this.$element.find('.slide:first-child');
          this.$slides.append(clone);
          clone.on('click', $.proxy(self.to, self, clone));
          clone.on('load', $.proxy(self.slideLoaded, self));
          // if the slide is not loaded
          // then load it
          if(!clone.data('loaded')){
            clone.slide('load');
            this.$arrowRight.attr('data-loading', true);
            return false;
          }else{
            // if the slide is loaded
            // remove the width of the slide to the left space
            // and get the previous slide
            //clone.width(slideToClone.width());

            rightspace -= clone.width();

            clone.slide("setNext");

            nextSlide = clone.next();
          }
        }
      }
      this.$arrowRight.attr('data-loading', false);
    }
  };

  /* CAROUSEL PLUGIN */
  var old = $.fn.carousel;

  $.fn.carousel = function (option) {
    return this.each(function () {
      var $this = $(this),
          data = $this.data('carousel'),
          options = $.extend({}, $.fn.carousel.defaults, typeof option === 'object' && option),
          action = typeof option === 'string' ? option : options.slide;
      if (!data) {
        $this.data('aau.carousel', (data = new Carousel(this, options)));
      }
      if (action) {
        data[action]();
      }
    });
  };

  // No autoplay by default
  $.fn.carousel.defaults = {};

  $.fn.carousel.Constructor = Carousel;

  /* CAROUSEL NO CONFLICT */
  $.fn.carousel.noConflict = function () {
    $.fn.carousel = old;
    return this;
  };

  /* CAROUSEL HTML INIT */
  $(document).on('click.aau.carousel.data-api', '[data-slide], [data-slide-to]', function (e) {
    var $this = $(this);
    var $target = $($this.attr('data-target'));
    var slideIndex = $this.attr('data-slide-to');
    if (slideIndex) {
      $target.data('aau.carousel').goTo(slideIndex);
    }

    e.preventDefault();
  });

  // On load on tag attribute
  $(window).on('load', function () {
    $('[data-aau="carousel"]').each(function () {
      var $carousel = $(this);
      $carousel.carousel($carousel.data());
    });
  });

}(window.jQuery);
