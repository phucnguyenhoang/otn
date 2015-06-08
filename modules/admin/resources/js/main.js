$(function() {
    Admin.run();
});
var Admin = {
    init: function() {
        this._initModal();
        this._initDataTable();
        this._initImageSelector();
    },
    eventHandle: function() {
        this.onClickBtnImageSelector();
    },
    _initDataTable: function() {
        $('.data-tables').DataTable({
            responsive: true
        });
    },
    _initImageSelector: function() {
        var n = 0,
            pattern = $('#img_selector_view_pattern');
        $('.image-selector').each(function() {
            n += 1;
            var imgInput = $(this),
                id = 'img_selector_' + n,
                url = $('#frm_file_manager').attr('src') + '&field_id=' + id,
                view = pattern.clone();

            imgInput.attr('id', id);
            view.removeAttr('id');
            view.addClass('image-selector-view');
            view.find('button').data({
                id: id,
                url: url
            });
            imgInput.after(view);
        });
    },
    _initModal: function() {
        $('#dialog_image_selector').modal({
            show: false,
            backdrop: 'static'
        });
    },
    onClickBtnImageSelector: function() {
        $(document).on('click', '.btn-open-image-selector', function() {
            var btn = $(this);
            $('#frm_file_manager').attr('src', btn.data('url'));
            $('#dialog_image_selector').modal('show');
        });
    },
    run: function() {
        this.init();
        this.eventHandle();
    }
};

var Verify = {
    eventHandle: function(){
        
    },
    run: function(){
        this.eventHandle();
    }
};
function responsive_filemanager_callback(field_id){
    var currInputImage = $('#'+field_id),
        url = currInputImage.val();

    url = url.replace('/files/source', '/files/thumbs');
    currInputImage.next().css('backgroundImage', 'url("' + url + '")');
    console.log(url);
}
