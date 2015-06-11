<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $lang_title; ?>
    </div>
    <div class="panel-body">
        <div class="form-group <?php echo !empty(form_error('name')) ? 'has-error' : '' ?>">
            <label class="control-label">Country name</label>
            <input name="name" type="text" class="form-control" value="<?php
            //validation
            echo set_value('name');
            //update record
            if(!empty($record->name)) echo $record->name;

            ?>">
            <?php echo form_error('name'); ?>
        </div>
        <div class="form-group <?php echo !empty(form_error('iso_code')) ? 'has-error' : '' ?>">
            <label class="control-label">Iso code</label>
            <input id="iso_code" name="iso_code" class="form-control"  value="<?php
                //validation
            echo set_value('iso_code');
                if(!empty($record->iso_code)) echo $record->iso_code;
                ?>">
            <?php echo form_error('iso_code'); ?>
        </div>


        <div class="form-group <?php echo !empty(form_error('status')) ? 'has-error' : '' ?>">
            <label class="control-label">Status</label>
                        <select class="form-control" name="status">
                            <?php
                            //var_dump($record->status);
                                if(!empty($record->status)){
                                    //echo set_value('status');
                                    if ($record->status == 1) {
                                        echo "<option value='1' selected >Available</option>";
                                        echo "<option value='0' >Not Available</option>";
                                    }else {
                                        echo "<option value='1' >Available</option>";
                                        echo "<option value='0' selected >Not Availabel</option>";
                                    }
                                }else {
                                ?>
                                    <option value="1" >Available</option>
                                    <option value="0" >Not Availabel</option>
                                <?php
                                }
                                ?>
                        </select>
            <?php echo form_error('status'); ?>
        </div>
        <input type="hidden" name="_id" value="<?php if(!empty($record->_id)) echo $record->_id; ?>">
        <input class="btn btn-success pull-right" type="submit" value="Save" />
    </div>
</div>