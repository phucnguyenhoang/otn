$(function(){
    $('#btn_plugin_refresh').click(function(e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        $.get($(this).attr('href'), function(){
            btn.button('reset');
        });
    });
});