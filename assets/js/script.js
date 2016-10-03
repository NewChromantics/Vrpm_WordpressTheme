(function() {

    /**
     * Window variables
     */

    var $window      = $(window);
    var windowWidth  = $window.width();


    /**
     * Responsive variables
     */

    var isMobile  = windowWidth < 768;
    var isTablet  = windowWidth <= 992;
    var isDesktop = windowWidth > 992;


    /**
     * Misc
     */

    var themeDirectory = $('meta[name="theme-directory"]').attr('content');

    /**
     * Parallax
     */

    if (isDesktop)
    {
        $('.js-parallax').parallax('50%', .25);  
    }


    /**
     * Google Maps
     */
    
    $('.map').each(function() {

        var $map   = $(this);
        var lat    = $map.data('lat');
        var lng    = $map.data('lng');
        var zoom   = $map.data('zoom');
        var latlng = new google.maps.LatLng(lat, lng);

        // Generate map
        var map = new google.maps.Map($map[0], {
            zoom        : zoom,
            center      : latlng,
            scrollwheel : false
        });

        // Generate marker
        new google.maps.Marker({
            position  : latlng,
            map       : map
        });
  
    });  


    /**
     * Mobile menu
     */

    $('.js-menu-toggle').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);

        $this.toggleClass('is-active');

        setTimeout(function() {
            $this.toggleClass('inverse');
        }, 250);

        $('.header__navigation').slideToggle();
    });


    $('.js-sphere').each(function() {

        var PSV = new PhotoSphereViewer({
            panorama: $(this).data('image'),
            container: $(this).attr('id'),
            loading_img: themeDirectory + '/img/photosphere-logo.png',
            navbar: 'autorotate fullscreen',
            default_fov: 70,
            mousewheel: false,  
            time_anim: false,
            size: {
                height: $(this).data('height')
            }
        });
        
    });

})($);