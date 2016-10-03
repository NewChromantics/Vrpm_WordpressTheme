var elixir = require('laravel-elixir');

// Assets path
elixir.config.assetsPath = 'assets';

// Run elixir tasks
elixir(function(mix) {
    mix.sass('barebones.scss', 'style.css')
       .scripts([
            'vendor/jquery.parallax-1.1.3.js',
            'vendor/three.min.js',
            'vendor/D.min.js',
            'vendor/uevent.min.js',
            'vendor/doT.min.js',
            'vendor/photo-sphere-viewer.min.js',
            'script.js'
        ], 'js/script.min.js');
});
