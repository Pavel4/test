
jQuery(document).ready(function($) {


    jQuery('#upload-logo').click(function() {
    var gallery_window = wp.media({
        title: 'Select Logo',
        library: { type: 'image'},
        multiple: false,
        button: { text: 'SELECT' }
    });

    gallery_window.on('select',function(){
        var user_selection = gallery_window.state().get('selection').toJSON();
        var toappend = '';
        var selected = [];

        for(var i=0;i<user_selection.length;i++){
            console.log(user_selection[i]);
            selected.push(user_selection[i]['id']);
            var url = user_selection[i]['sizes']['full']['url'];
        }
        console.log(selected);

        jQuery('#selected-logo').css('background-image','url('+url+')');
        jQuery('#dess-logo').val(url);
    });

    
    gallery_window.open();
    });

    $('.remove-logo').click(function(e){
        e.preventDefault();
        $('#selected-logo').css('background-image','none');
        jQuery('#dess-logo').val('');
    })
});
