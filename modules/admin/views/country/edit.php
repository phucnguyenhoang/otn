<html>
<?php echo form_open(base_url('admin/countries/update'), array('method' => 'post'));?>
<div>
    <p align="center"><?php if(isset($notify)) echo $notify ?></p>
</div>
<?php include('_form.php'); ?>
<?php echo form_close(); ?>
</html>