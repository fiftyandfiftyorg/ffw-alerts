!(function ($){

    // "use strict"; // jsHint

    window.FFA_ALERTS   = {};
    var FFA                  = window.FFA_ALERTS;

    // global vars (experimental alt object method)
    window.GLOBAL_VARS = {
        mobile  : ((/Android|iPhone|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera) ? true : false),
        debug   : true
    }
    GLOBALS = window.GLOBAL_VARS;
    // if (GLOBALS.debug) console.log('GLOBALS (window.GLOBAL_VARS): ', GLOBALS);


    /* INITIATE FUNCTIONS
    ================================================== */
    FFA.init = function(){
        FFA.setElements();
        FFA.alertBar();

    };

    /* SET ELEMENTS
    ================================================== */
    FFA.setElements = function(){
        // FFA Universal Elements
        FFA.el = {};

        // Theme specific elements
        FFA.el.alerts                = $('#alerts');
        FFA.el.alert                 = $('#alerts .alert');
        FFA.el.splash_wrap           = $('#splash');

    };
    /* ALERT BAR
    ================================================== */
    FFA.alertBar = function(duration) {

        // vars
        var alert_btns = $('a[href="#alert');

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
              , alerts            = FFA.el.alerts
              , alerts_container  = alerts.find('#alert_container')
              , alert_close       = alerts.find('#alert_close')
              , content           = $this.data('content')
              , title             = $this.data('title')
              , local_storage_id  = $this.data('local-storage-id')
              , header            = FFA.el.header_nav
              , page_wrap         = FFA.el.page_wrap;
            
            // if there are not any existing alerts in the alert container, and if local storage key is not false
            if ( $('#alerts .alert').length <= 0  && localStorage['FFA_' + local_storage_id] != 'false' ) {
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
                    page_wrap.animate({ 'top' : ''+alert_offset+'px' });
                }, duration)
            }

        });

        // close button
        $('#alert_close').click(function (event) {

            var alerts      = FFA.el.alerts
              , page_wrap   = FFA.el.page_wrap
              , ls_prefix   = 'FFA_'
              , ls_key      = $('#alerts .alert').data('ls-id');

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
    /* SELF INVOKING ANONYMOUS FUNCTION(s)
    ================================================== */
    (function(){

        // FFA.setVars();

    })();


})(jQuery);