/*! Add socialshare button */
(function() {
    tinymce.create('tinymce.plugins.socialshare', {
        init : function(ed, url) {
            ed.addButton('socialshare', {
                title : 'Pic Social Share',
                image : url+'/share.png',
                onclick : function() {
                    ed.selection.setContent('[' + ('socialshare' + ' facebook="1" ' + 'twitter="1" ' + 'linkedin="1" ' + 'googlepluseone="1" ' + 'pinterest="1" ' + 'fixed="0" ' + 'titleshare=""') + ']');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('socialshare', tinymce.plugins.socialshare);
})();

