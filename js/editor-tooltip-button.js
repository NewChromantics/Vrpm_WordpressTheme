(function() {
    tinymce.PluginManager.add('ttip_shortcode_button', function( editor, url ) {
        editor.addButton( 'ttip_shortcode_button', {
            text: '[ Add panorama ]',
            icon: false,
            onclick: function() {
              editor.insertContent('[panorama image="" height="400"]');
            }
        });
    });
})();