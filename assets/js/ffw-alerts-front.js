// ffw-alerts-front.js

!(function ($){

    "use strict"; // jsHint

    // window vars
    window.FIFTYFRAMEWORK   = {};
    // set FFW as window obj
    var FFW                  = window.FIFTYFRAMEWORK;


    /* INITIATE FUNCTIONS
    ================================================== */
    FFW.init = function(){
        FFW.setElements();
        FFW.alertBar();
    };

    /* SET ELEMENTS
    ================================================== */
    FFW.setElements = function(){
        // FFWW Universal Elements
        FFW.el = {};

        // Theme specific elements
        FFW.el.alerts                = $('#alerts');
        FFW.el.alert                 = $('#alerts .alert');
        FFW.el.landing_panel         = $('#landing_panel');

    };



    /* ALERT BAR
    /* Example
    /* ----------
    <a 
        id="ffw_alert_<?php the_ID(); ?>" 
        href="#alert" 
        class="btn yellow hide" 
        data-local-storage-id="ffw_alerts_<?php the_ID(); ?>" 
        data-trigger-method="onpageload" 
        data-title="<?php the_title(); ?>" 
        data-content="<?php echo get_the_excerpt(); ?>">
        Test Alert
     </a>
    ================================================== */
    FFW.alertBar = function(duration) {

        // vars
        var alert_btns = $('a[href="#alert"]');

        // duration used throughout various animations, setTimeouts, etc
        duration = 250;

        alert_btns.each(function (i, val) {
            var $this           = $(this)
              , trigger_method = $this.data('trigger-method');

            if ( trigger_method == 'onpageload' ) {
                jQuery(window).load(function(e){
                    $this.click();
                });
            }
        }); 


        alert_btns.click(function (event) {
            event.preventDefault();

            // vars
            var $this             = $(this)
              , alerts            = FFW.el.alerts
              , alerts_container  = alerts.find('#alert_container')
              , alert_close       = alerts.find('#alert_close')
              , content           = $this.data('content')
              , title             = $this.data('title')
              , local_storage_id  = $this.data('local-storage-id')
              , header            = $('header#nav')
              , $page_wrap        = $('#page_wrap');
            
            // if there are not any existing alerts in the alert container, and if local storage key is not false
            if ( $('#alerts .alert').length <= 0  && localStorage['FFWW_' + local_storage_id] != 'false' ) {
                // append & create the alert into the alert 'holding tank' (div#alerts in header)
                alerts_container.append('\
                    <div class="alert" data-ls-id="'+local_storage_id+'"> \
                        <div class="container"> \
                            <h3 class="alert-title">'+title+'</h3> \
                            <div class="alert-content">'+content+'</div> \
                        </div> \
                    </div> \
                ')
                // fade in the close button
                // slidetoggle the alert we just appended
                $('#alerts .alert').slideToggle();
                // move down the header nav using the page_wrap (keep alerts outside it)
                setTimeout(function (e) {

                    var alert_offset = $('#alerts .alert').outerHeight() + 10;

                    alert_close
                        .addClass('show')
                        .animate({ 'top' : '48px' }, 50);
                    $('#page_wrap').animate({ 'top' : ''+alert_offset+'px' });
                }, duration);
            }

        });

        // close button
        $('#alert_close').click(function (event) {

            var alerts      = FFW.el.alerts
              , page_wrap   = FFW.el.page_wrap
              , ls_prefix   = 'FFWW_'
              , ls_key      = $('#alerts .alert').data('ls-id')
              , page_wrap   = $('#page_wrap');

              console.log($('#alerts .alert').data('ls-id'));

            // store a value indicating you've closed the alert in local storage
            localStorage.setItem(ls_prefix + ls_key, false); 

            // hide this button
            $(this)
                .animate({ 'top' : '-35px' }, 150)
                .removeClass('show')
                .animate({ 'top' : '48px' }, 150);
                

            // bring the alert back up
            $('#alerts .alert').slideToggle();

            // bring the page wrap back up
            page_wrap.animate({ 'top' : '0px' });

            // empty the alerts container
            setTimeout(function(){
                $('#alert_container').empty();
            }, 300)
        });
    };




   





    /* ================================================================ */
    /*                                                                  */
    /*                     DOCUMENT / WINDOW CALLS                      */
    /*                                                                  */
    /* ================================================================ */



    /* DOCUMENT READY
    ================================================== */
    $(document).ready(function(){

        FFW.init();
        

    });

    /* WINDOW LOAD
    ================================================== */
    $(window).load(function(){

        
    });

    /* WINDOW SCROLL
    ================================================== */
    $(window).scroll(function(){

        

    });


    /* WINDOW RESIZE
    ================================================== */
    $(window).resize(function(){

        

    }).trigger('resize');



    /* SELF INVOKING ANONYMOUS FUNCTION(s)
    ================================================== */
    (function(){


    })();


})(jQuery);