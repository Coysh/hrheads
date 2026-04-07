(function() {
    tinymce.create('tinymce.plugins.Tryvary', {
        init : function(ed, url) {
            ed.addButton('tryvary_code_block', {
                title : 'Add Video',
                cmd : 'tryvary_code_block',
                icon: 'plus'
            });

            ed.addCommand('tryvary_code_block', function() {
                ed.windowManager.open({
                    title: 'Add a video',
                    body: [{
                        type: 'textbox',
                        name: 'video_url',
                        placeholder: 'Enter video URL',
                        multiline: false,
                        minWidth: 700,
                        minHeight: 30,
                    },],
                    onsubmit: function( e ) {
                        ed.insertContent( '[embed_video url="'+e.data.video_url+'"]');
                    }
                });
            });
        },
    });
    tinymce.PluginManager.add( 'tryvary_code_block', tinymce.plugins.Tryvary);
})();
