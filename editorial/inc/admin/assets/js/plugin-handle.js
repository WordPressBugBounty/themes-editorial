/**
 * Get Started button on dashboard notice.
 *
 * @package Editorial
 */

jQuery(document).ready(function($) {
    var WpAjaxurl       = ogAdminObject.ajax_url;
    var _wpnonce        = ogAdminObject._wpnonce;
    var buttonStatus    = ogAdminObject.buttonStatus;

    /**
     * Popup on click demo import if mysterythemes demo importer plugin is not activated.
     */
    if( buttonStatus === 'disable' ) $( '.editorial-demo-import' ).addClass( 'disabled' );

    switch( buttonStatus ) {
        case 'activate' :
            $( '.editorial-get-started' ).on( 'click', function() {
                var _this = $( this );
                editorial_do_plugin( 'editorial_activate_plugin', _this );
            });
            $( '.editorial-activate-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                editorial_do_plugin( 'editorial_activate_plugin', _this );
            });
            break;
        case 'install' :
            $( '.editorial-get-started' ).on( 'click', function() {
                var _this = $( this );
                editorial_do_plugin( 'editorial_install_plugin', _this );
            });
            $( '.editorial-install-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                editorial_do_plugin( 'editorial_install_plugin', _this );
            });
            break;
        case 'redirect' :
            $( '.editorial-get-started' ).on( 'click', function() {
                var _this = $( this );
                location.href = _this.data( 'redirect' );
            });
            break;
    }
    
    editorial_do_plugin = function ( ajax_action, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

    $('.mt-action-btn').click(function(){
        var _this = $(this), actionBtnStatus = _this.data('status'), pluginSlug = _this.data('slug');
        console.log(actionBtnStatus);
        switch(actionBtnStatus){
            case 'install':
                editorial_do_free_plugin( 'editorial_install_free_plugin', pluginSlug, _this );
                break;

            case 'active':
                editorial_do_free_plugin( 'editorial_activate_free_plugin', pluginSlug, _this );
                break;
        }

    });

    editorial_do_free_plugin = function ( ajax_action, pluginSlug, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                'plugin_slug': pluginSlug,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

});