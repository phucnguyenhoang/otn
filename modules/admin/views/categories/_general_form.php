<?php $this->lang->load($alias.'_category'); ?>

<div class="form-group required form-group-line">
    <label class="col-sm-2 control-label">
        <?php echo $this->lang->line('category_name'); ?>
    </label>
    <div class="col-sm-10">
        <input type="text" name="<?php echo $alias; ?>_category[name]" value="" placeholder="<?php echo $this->lang->line('category_name'); ?>" id="input-name1" class="form-control">
        <?php echo form_error('name'); ?>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">
        <?php echo $this->lang->line('description'); ?>
    </label>
    <div class="col-sm-10">
        <?php 
            echo modules::run('filemanager',array(
                'class' => 'box-content-article',
                'id' => 'box-content-article',
                'name' => $alias.'_category[description]',
                'row' => 3,
                'content' => 'content input'
            ));
        ?>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">
        <?php echo $this->lang->line('key_word'); ?>
    </label>
    <div class="col-sm-10">
      <textarea name="<?php echo $alias; ?>_category[keyword]" rows="5" placeholder="<?php echo $this->lang->line('key_word'); ?>" id="input-meta-keyword1" class="form-control"></textarea>
    </div>
    <div class="clear"></div>
</div>
