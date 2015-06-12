<?php $this->lang->load($alias.'_category'); ?>

<div class="form-group">
    <label class="col-sm-2">
        <?php echo $this->lang->line('parent'); ?>
    </label>
    <div class="col-sm-10">
      <input type="text" name="category[parent]" value="" placeholder="<?php echo $this->lang->line('parent'); ?>" class="form-control">
    </div>
    <div class="clear"></div>
</div>

<div class="form-group">
    <label class="col-sm-2">
    	<?php echo $this->lang->line('image'); ?>
    </label>
    <div class="col-sm-10">
        <input class="image-selector" name="category[image]" value="<?php
        	if(!empty($record->image)) echo $record->image;
        ?>" data-image="<?php
        	if(!empty($record->image)) echo $this->image->get($record->image,'thumb');
        ?>">
    </div>
    <div class="clear"></div>
</div>

<div class="form-group">
    <label class="col-sm-2">
        <?php echo $this->lang->line('top'); ?>
    </label>
    <div class="col-sm-10">
      <input type="checkbox" name="category[top]">
    </div>
    <div class="clear"></div>
</div>

<div class="form-group">
    <label class="col-sm-2">
        <?php echo $this->lang->line('sort_order'); ?>
    </label>
    <div class="col-sm-10">
      <input type="text" name="category[order]" value="" placeholder="<?php echo $this->lang->line('sort_order'); ?>" class="form-control">
    </div>
    <div class="clear"></div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="input-status">
    	<?php echo $this->lang->line('status'); ?>
    </label>
    <div class="col-sm-10">
      	<select name="status" id="input-status" class="form-control">
      		<option value="1" selected="selected"><?php echo $this->lang->line('status_enabled'); ?></option>
        	<option value="0"><?php echo $this->lang->line('status_disabled'); ?></option>
        </select>
    </div>
</div>



