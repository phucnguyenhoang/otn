<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $lang_title; ?>
    </div>
    <div class="panel-body">
        <div class="form-group <?php echo !empty(form_error('name')) ? 'has-error' : '' ?>">
            <label class="control-label">Brand name</label>                
            <input name="name" type="text" class="form-control" value="<?php 
            	//validation
                if(!empty(set_value('name'))){
                    echo set_value('name'); 
                }else{
                    //update record
                    if(!empty($record->name)) echo $record->name;
                }
            ?>">
            <?php echo form_error('name'); ?>
        </div>
        <div class="form-group">
            <label>Image</label>
            <div>
                <input class="image-selector" name="image" value="<?php
                	if(!empty($record->image)) echo $record->image;
                ?>" data-image="<?php
                	if(!empty($record->image)) echo $this->image->get($record->image,'thumb');
                ?>">
            </div>
        </div>
        <div class="form-group <?php echo !empty(form_error('description')) ? 'has-error' : '' ?>">
            <label class="control-label">Description</label>                
            <textarea id="description" name="description" class="form-control" row="4" ><?php 
                //validation
                echo set_value('description');
                if(!empty($record->description)) echo $record->description;
            ?></textarea>
            <?php echo form_error('description'); ?>
        </div>
        <input type="hidden" name="_id" value="<?php if(!empty($record->_id)) echo $record->_id; ?>">
    </div>
</div>   