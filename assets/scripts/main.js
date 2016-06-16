/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.

  var getIEVersion = function() {
      var sAgent = window.navigator.userAgent;
      var Idx = sAgent.indexOf("MSIE");

      if (Idx > 0)
      {
          return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));
      } else if (!!navigator.userAgent.match(/Trident\/7\./)) {
          return 11;
      } else{
          return 0;
      }
  };

  var isTouchEnabled = function() {
      return 'ontouchstart' in document.documentElement || navigator.maxTouchPoints;
  };

  var updatePS = function()
  {
      if (getIEVersion() === 0 && !isTouchEnabled())
      {
          Ps.update($('.main')[0]);
          $('.scrollable-container .scrollable-content').each(function(i, el){
              Ps.update(el);
          });
      }
  };

  var accroSplashAnim = function() {
      var duration = 0.4;
      var ease = Quad.easeInOut;
      var timeline = new TimelineMax();
      timeline.from($('.splash-container'), duration, {
          alpha: 0,
          ease: ease
      }, 0.4);
      timeline.fromTo($('.main-description .line-one'), duration, {
          alpha: 0,
          x: '4%'
      },{
          alpha: 1,
          x: '0%'
      }, '+=0.3');
      timeline.fromTo($('.main-description .line-two'), duration, {
          alpha: 0,
          x: '4%'
      },{
          alpha: 1,
          x: '0%'
      }, '-=0.3');
      timeline.staggerFromTo($($('.list-items .list-item').get().reverse()), duration, {
          alpha: 0,
          y: '-10%'
      },{
          alpha: 1,
          y: '0%'
      }, 0.1, '-=0.2');
      timeline.staggerFromTo($($('.list-items .list-item .label').get().reverse()), duration, {
          alpha: 0
      },{
          alpha: 1
      }, 0.1, '-=0.3');
      /*timeline.to($('.splash-container img'), 0.2, {
          scale: 1.01,
          yoyo: true,
          repeat: 1
      }, '-=0.2');
      $('main.main').on('mousemove', function(e){
          var ratioX = e.clientX / window.innerWidth;
          var ratioY = e.clientY / window.innerHeight;
          var percentX = (1-ratioX)*100;
          var percentY = (1-ratioY)*100;
          var titlePercentX = (1-ratioX)*100/3 + 40;
          var titlePercentY = (1-ratioY)*100;

          TweenMax.to($('.main-description .line-one, .main-description .line-two, .splash-container, .list-items'), 2, {
              //perspectiveOrigin: percentX+'% '+percentY+'%'
          });
      });*/
  };

  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        $('.hamburger').click(function(e){
            e.preventDefault();
            $('header.banner').toggleClass('opened');
        });

        $('body .content').removeClass('hidden');

        if (getIEVersion() === 0 && !isTouchEnabled())
        {
            Ps.initialize($('.main')[0]);
            $('.scrollable-container .scrollable-content').each(function(i, el){
                Ps.initialize(el, {
                    suppressScrollX: true
                });
            });
            $(window).on('resize', updatePS);
            //$('.main').css('overflow-x', 'hidden');
            $('.main').css('overflow-y', 'hidden');
        } else {
            $('.scrollable-container .scrollable-content').each(function(i, el){
                $(el).css('overflow-x', 'hidden');
                $(el).css('overflow-y', 'auto');
            });
            //$('.main').css('overflow-x', 'hidden');
            //$('.main').css('overflow-y', 'auto');
        }

        $('a').click(function(e){

            if ($('header.banner').is('.opened'))
            {
                $('header.banner').removeClass('opened');
            }
            var href = $(this).attr('href');

            var getHref = document.createElement('a');
            getHref.href = href;
            var fullHref = getHref.cloneNode(false).href;

            var isLocalLink = this.host === window.location.host;
            var isLightBox = $(this).attr('rel') === 'lightbox';
            var isTargetBlank = $(this).attr('target') === '_blank';
            var isSrollableNavItem = $(this).parent().is('.scrollable-nav-item');

            // hide logo on splash page
            if (!$('body').is('.subtheme-default'))
            {
                if (!$('body').is('.page-template-page-splash') && $(this).is('.brand'))
                {
                    $(this).addClass('hidden');
                }
                else if ($('body').is('.page-template-page-splash') && isLocalLink && !$(this).parent().is('.qtranxs-lang-menu'))
                {
                    $('header.banner .brand').addClass('show');
                }
            }

            // fade out if local link
            if (isLocalLink && !isLightBox && !isTargetBlank && !isSrollableNavItem)
            {
                if (window.location.href !== fullHref)
                {
                    $('body .content').addClass('hidden');
                }

                if (!$(this).parent().is('.qtranxs-lang-menu') && $('.current-menu-item a').attr('href') !== fullHref)
                {
                    $('.current-menu-item').removeClass('current-menu-item');
                }

                $('header.banner li').each(function(i, el){
                    if ($(el).find('a').attr('href') === fullHref)
                    {
                        $(el).addClass('current-menu-item');
                    }
                });

                //fix css3 animation on ios
                e.preventDefault();
                setTimeout(function(){
                    window.location.href = href;
                }, 1);
            }

            // subpage
            if (isSrollableNavItem)
            {
                if ($(this).parent().is('.active'))
                {
                    return;
                }
                var scrollableClassName = $(this).data('scrollable-classname');

                $('.scrollable-nav-item').removeClass('active');
                $('.scrollable-content').removeClass('active');

                $(this).parent().addClass('active');
                $('.'+scrollableClassName).addClass('active');
            }

        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        if ($('body').is('.subtheme-accro'))
        {
            accroSplashAnim();
        }
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    'billeterie': {
      init: function() {

        ticketsData.comboCount = parseInt(ticketsData.comboCount);
        ticketsData.comboPrice = parseFloat(ticketsData.comboPrice);
        ticketsData.price = parseFloat(ticketsData.price);

        var updateTicketName = function($repeatableSet)
        {
            var $title = $repeatableSet.find('.ticket-title');
            var ticketLabelFirst = $title.data('label-first');
            var ticketLabelSecond = $title.data('label-second');
            var index = $repeatableSet.index();
            var firstName = $repeatableSet.find('input[name="firstname_'+index+'"]').val();
            var lastName = $repeatableSet.find('input[name="lastname_'+index+'"]').val();

            var str = ticketLabelFirst + ' ' + (firstName.length || lastName.length ? ticketLabelSecond + ' ' + firstName + ' ' + lastName : '#'+(index+1));
            $title.text(str);
        };

        var updateForm = function($form)
        {
            var $repeatableSets = $form.find('.repeatable-set');
            var quantity = $repeatableSets.length;
            var price = quantity >= ticketsData.comboCount ? ticketsData.comboPrice:ticketsData.price;
            $form.find('input[name="quantity"]').attr('value',quantity);
            var subtotal = 0;
            $repeatableSets.each(function(i, repeatableSet){
                $(repeatableSet).find('input').each(function(ii,input){
                    var name = $(input).attr('name');
                    var nameArray = name.split('_');
                    $(input).attr('name', nameArray[0]+'_'+i);
                });
                updateTicketName($(repeatableSet));
                subtotal += price;
            });
            var tps = subtotal * 0.05;
            var tvq = subtotal * 0.09975;
            var total = Math.round((subtotal + tps + tvq)*100)/100;
            var $invoice = $form.find('.tickets-invoice');
            $invoice.find('.row-subtotal .cell-price').text(subtotal.toFixed(2)+'$');
            $invoice.find('.row-tps .cell-price').text(tps.toFixed(2)+'$');
            $invoice.find('.row-tvq .cell-price').text(tvq.toFixed(2)+'$');
            $invoice.find('.row-total .cell-price').text(total.toFixed(2)+'$');
        };

        var addInputChangeEvents = function(i, input){
            var name = $(input).attr('name');
            var nameArray = name.split('_');
            if (nameArray[0] === 'firstname' || nameArray[0] === 'lastname')
            {
                $(input).on('input', function(e){
                    updateTicketName($(e.currentTarget).parents('.repeatable-set'));
                });
            }
        };

        var onRemoveTicketClick = function(e)
        {
            var repeatableSet = $(e.currentTarget).parent();
            var $container = $(repeatableSet).parent();
            var $form = $container.parent();
            TweenMax.to(repeatableSet, 0.2, {
                opacity: 0
            });
            TweenMax.to(repeatableSet, 0.4, {
                height: 0,
                onUpdate: updatePS,
                onComplete: function(){
                    $(this.target).remove();
                    updateForm($form);
                }
            });
        };

        var onAddTicketClick = function(e)
        {
            var $form = $(e.currentTarget).parents('form');
            var $container = $form.find('.repeatable-sets');
            var repeatableSet = $form.find('.repeatable-set:eq(0)').clone()[0];
            $(repeatableSet).find('.remove-ticket-button').click(onRemoveTicketClick);
            $container.append($(repeatableSet));
            updateForm($form);
            $title = $(repeatableSet).find('.ticket-title');
            $title.text($title.data('label-first')+' #'+($(repeatableSet).index()+1));
            $(repeatableSet).find('input[type="text"]').each(addInputChangeEvents);
            $(repeatableSet).find('input[type!="hidden"]').each(function(i,input){
                $(input).unbind('focus.placeholder').unbind('blur.placeholder').removeData('placeholder-enabled').removeClass('placeholder').val('').placeholder();
            });
            var repeatableSetHeight = repeatableSet.offsetHeight;
            var timeline = new TimelineMax();
            timeline.set(repeatableSet, {
                height: 0,
                opacity: 0
            });
            timeline.to(repeatableSet, 0.4, {
                height: repeatableSetHeight,
                onUpdate: updatePS
            });
            timeline.to(repeatableSet, 0.2, {
                opacity: 1,
                clearProps: 'all'
            });
        };

        var createTicket = function(arr, $form, options)
        {
            var valid = true;
            $form.find('input[type!="hidden"]').each(function(i, el){
                $(el).trigger('submit.placeholder');
                if (!$(el).attr('value').length)
                {
                    valid = false;
                    $(el).parent('span').addClass('error');
                } else {
                    $(el).parent('span').removeClass('error');
                }
            });
            if (!valid){
                console.log('Errors in form.');
                $form.find('.wpcf7-validation-errors').css('visibility', 'visible');
                return false;
            }

            arr.push({
                name: 'nonce',
                value: ticketsData.nonce
            },{
                name: 'action',
                value: 'create_ticket_and_pay'
            });
            $form.find('button, input[type!="hidden"]').attr('disabled', true);
            $form.find('.ajax-loader').css('visibility', 'visible');
            $form.find('.wpcf7-validation-errors').css('visibility', 'hidden');
            console.log('Creating ticket...');
        };

        var onTicketCreated = function(data)
        {
            console.log('Ticket created! To paypal we go...');

            var $paypalForm = $('.paypal-hidden');

            var paypalFields = data.paypal_fields;

            for (var key in paypalFields)
            {
                $paypalForm.append($('<input>', {
                    'name': key,
                    'value': paypalFields[key],
                    'type': 'hidden'
                }));
            }

            $paypalForm.attr('action', data.paypal_url);

            $paypalForm[0].submit();
        };

        $('.add-ticket-button').click(onAddTicketClick);
        $('.remove-ticket-button').click(onRemoveTicketClick);
        updateForm($('.create-event-ticket'));
        $('.create-event-ticket').find('input[type!="hidden"]').placeholder();
        $('.create-event-ticket input[type="text"]').each(addInputChangeEvents);
        $('.create-event-ticket').ajaxForm({
            url: ticketsData.ajaxUrl,
            type: 'post',
            dataType: 'json',
            success: onTicketCreated,
            beforeSubmit : createTicket
        });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
