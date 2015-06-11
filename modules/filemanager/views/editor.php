<script type="text/javascript" src="<?php echo base_url('modules/filemanager/resources/js/tinymce/tinymce.min.js') ?>"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea.tinymce",
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       filemanager_crossdomain: true,
       external_filemanager_path:"<?php echo base_url('modules/filemanager/resources/js/filemanager/'); ?>/",
       filemanager_title:"Quản lý files" ,
       external_plugins: { "filemanager" : "<?php echo base_url('modules/filemanager/resources/js/tinymce/plugins/responsivefilemanager/plugin.min.js'); ?>"},
       setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
   });
</script>


<textarea rows="<?php echo !empty($row)? $row : 10 ?>" name="<?php echo !empty($name)? $name : '' ?>" id='<?php echo !empty($id)? $id : "" ?>' class="col-lg-12 tinymce <?php echo !empty($class)? $class : '' ?>">
    <?php 
        if(!empty($content)){
            echo $content;
        }
    ?>
</textarea>