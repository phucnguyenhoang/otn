<?php $this->lang->load($alias.'_category'); ?>

<div class="form-group">
    <label class="col-sm-2">
        <?php echo $this->lang->line('parent'); ?>
    </label>
    <div class="col-sm-10">
        <input type="text" id="input_category_parent" value="" placeholder="<?php echo $this->lang->line('parent'); ?>" class="form-control">
        <!-- <ul id="input_category_dropdown" class="dropdown-menu" style="top: 35px; left: 15px; display: block;">
            <li data-value="0"><a href="#"> --- None --- </a></li>
            <li data-value="87"><a href="#">Áo</a></li>
            <li data-value="91"><a href="#">Áo&nbsp;&nbsp;&gt;&nbsp;&nbsp;Áo khoác</a></li>
            <li data-value="88"><a href="#">Áo&nbsp;&nbsp;&gt;&nbsp;&nbsp;Áo kiểu</a></li>
            <li data-value="89"><a href="#">Áo&nbsp;&nbsp;&gt;&nbsp;&nbsp;Áo sơmi</a></li>
            <li data-value="90"><a href="#">Áo&nbsp;&nbsp;&gt;&nbsp;&nbsp;Áo thun</a></li>
        </ul> -->
    </div>
    <input type="hidden" name="category[parent]" id="input_category_parent_id">
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
      	<select name="category[status]" id="input-status" class="form-control">
      		<option value="1" selected="selected"><?php echo $this->lang->line('status_enabled'); ?></option>
        	<option value="0"><?php echo $this->lang->line('status_disabled'); ?></option>
        </select>
    </div>
</div>



