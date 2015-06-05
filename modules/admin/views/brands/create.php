<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $lang_title; ?> <small><?php echo $lang_create; ?></small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <input type="text" class="image-selector">
        <input type="text" class="image-selector">
    </div>
</div>
<br>
<div id="img_selector_view_pattern">
    <div class="control">
        <button type="button" class="btn btn-sm btn-primary btn-open-image-selector"><?php echo $this->lang->line('btn_edit'); ?> <span class="glyphicon glyphicon-edit"></span></button>
    </div>
</div>

<div class="modal fade" id="dialog_image_selector" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo $this->lang->line('file_manager_title'); ?></h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px width: 560px;">
                <iframe id="frm_file_manager" width="100%" height="600" src="<?php echo base_url('modules/filemanager/resources/js/filemanager'); ?>/dialog.php?type=1&lang=<?php echo $this->lang->line('file_manager_lang'); ?>&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div>
    </div>
</div>