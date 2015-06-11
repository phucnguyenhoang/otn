        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<div id="loading"></div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
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
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<?php if (!empty($js)): ?>
    <?php foreach ($js as $jsPath): ?>
        <script src="<?php echo base_url('modules/admin/resources/'.$jsPath).'.js'; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="<?php echo base_url('modules/admin/resources/js/sb-admin-2.js'); ?>"></script>
<script src="<?php echo base_url('modules/admin/resources/js/main.js'); ?>"></script>
<script type="text/javascript">
    Admin.loading(false);
</script>
</body>
</html>