$(function() {
    Admin.run();
});
var Admin = {
    loading: function(visible){
        var load = $('#loading');
        if (visible) {
            load.show();
        }
        else {
            load.hide();
        }
    },
    init: function() {
        this._initModal();
        this._initDataTable();
        this._initImageSelector();
    },
    eventHandle: function() {
        this.onClickBtnImageSelector();
    },
    _initDataTable: function() {
        var table = $('.data-tables');
        table.DataTable({
            responsive: true,
            "columnDefs": [
                { "orderable": false, "targets": table.find('th').length - 1 }
            ]
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
            if ($.trim(imgInput.data('image')) != '') {
                view.css('backgroundImage', 'url("' + imgInput.data('image') + '")');
            }

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
        url = currInputImage.val(),
        baseUrl = $('#base_url').val(),
        imageName = url.replace(baseUrl + 'resources/files/source/', '');

    url = url.replace('/files/source', '/files/thumbs');
    currInputImage.next().css('backgroundImage', 'url("' + url + '")');
    currInputImage.val(imageName);
}
