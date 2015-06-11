<?php $this->lang->load($alias.'_category'); ?>

<div class="form-group required form-group-line">
    <label class="col-sm-2 control-label" for="input-name1">
        <?php echo $this->lang->line('category_name'); ?>
    </label>
    <div class="col-sm-10">
      <input type="text" name="category_description[1][name]" value="" placeholder="<?php echo $this->lang->line('category_name'); ?>" id="input-name1" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="input-meta-keyword1">
        <?php echo $this->lang->line('description'); ?>
    </label>
    <div class="col-sm-10">
        <?php 
            echo modules::run('filemanager',array(
                'class' => 'box-content-article',
                'id' => 'box-content-article',
                'name' => 'box-content-article',
                'row' => 3,
                'content' => 'content input'
            ));
        ?>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="input-meta-keyword1">
        <?php echo $this->lang->line('key_word'); ?>
    </label>
    <div class="col-sm-10">
      <textarea name="category_description[1][meta_keyword]" rows="5" placeholder="<?php echo $this->lang->line('key_word'); ?>" id="input-meta-keyword1" class="form-control"></textarea>
    </div>
</div>
