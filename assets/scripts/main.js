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
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        $('.hamburger').click(function(e){
            e.preventDefault();
            $('.banner').toggleClass('opened');
        });

        $('body .content').removeClass('hidden');

        $('a').click(function(e){
            if ($('.banner').is('.opened'))
            {
                $('.banner').removeClass('opened');
            }
            var target = e.currentTarget;
            var $target = $(target);
            var isLocalLink = target.host === window.location.host;
            var isLightBox = $target.attr('rel') === 'lightbox';
            var isTargetBlank = $target.attr('target') === '_blank';
            var isSrollableNavItem = $target.parent().is('.scrollable-nav-item');

            if (isLocalLink && !isLightBox && !isTargetBlank && !isSrollableNavItem)
            {
                $('body .content').addClass('hidden');
                $('.current-menu-item').removeClass('current-menu-item');
                $(e.currentTarget).parent().addClass('current-menu-item');
            }

            if (isSrollableNavItem)
            {
                if ($target.parent().is('.active'))
                {
                    return;
                }
                var scrollableClassName = $target.data('scrollable-classname');

                $('.scrollable-nav-item').removeClass('active');
                $('.scrollable-content').removeClass('active');

                $target.parent().addClass('active');
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
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    'billeterie': {
      init: function() {
        console.log(ajaxData);
        $('.add-ticket-button').click(function(e){
            console.log('ADD TICKET');
        });

        $('.remove-ticket-button').click(function(e){
            console.log('REMOVE TICKET');
        });

        $('.create-event-ticket').ajaxForm({
            url: ajaxData.ajaxUrl,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                console.log('success', data);

                var $paypalForm = $('<form>', {
                    'action': data.paypal_url,
                    'target': '_top'
                });

                for (var key in data.fields)
                {
                    $paypalForm.append($('<input>', {
                        'name': key,
                        'value': data.fields[key],
                        'type': 'hidden'
                    }));
                }

                $paypalForm.submit();
            },
            beforeSubmit : function(arr, $form, options){
                arr.push({
                    name: 'nonce',
                    value: ajaxData.nonce
                },{
                    name: 'action',
                    value: 'create_ticket_and_pay'
                });
            }
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
