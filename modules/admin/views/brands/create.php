<div class="row">
    <div class="col-lg-12">
        <input type="text" class="image-selector">
        <input type="text" class="image-selector">
    </div>
</div>
<br>
<!-- <div id="img_selector_view_pattern">
    <div class="control">
        <button type="button" class="btn btn-sm btn-primary btn-open-image-selector"><?php // echo $this->lang->line('btn_edit'); ?> <span class="glyphicon glyphicon-edit"></span></button>
    </div>
</div> -->

<!-- <div class="modal fade" id="dialog_image_selector" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php // echo $this->lang->line('file_manager_title'); ?></h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px width: 560px;">
                <iframe id="frm_file_manager" width="100%" height="600" src="<?php // echo base_url('modules/filemanager/resources/js/filemanager'); ?>/dialog.php?type=1&lang=<?php // echo $this->lang->line('file_manager_lang'); ?>&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div>
    </div>
</div> -->

<?php //echo validation_errors(); ?>


<?php echo form_open(base_url('admin/brands/store')); ?>

<?php /*
<h5>Username</h5>
<?php echo form_error('username'); ?>
<?php echo form_input(array('id' => 'username', 'name' => 'username', 'value' => set_value('username'))); ?>

<h5>Password</h5>
<?php echo form_error('password'); ?>
<?php echo form_input(array('type' => 'password' ,'id' => 'password', 'name' => 'password','value' => set_value('password'))); ?>

<h5>Password Confirm</h5>
<?php echo form_error('passconf'); ?>
<?php echo form_input(array('id' => 'passconf', 'name' => 'passconf')); ?>

<h5>Email Address</h5>
<?php echo form_error('email'); ?>
<?php echo form_input(array('id' => 'email', 'name' => 'email')); ?>

<div><input type="submit" value="Submit" /></div> */ ?>



<?php echo form_close(); ?>