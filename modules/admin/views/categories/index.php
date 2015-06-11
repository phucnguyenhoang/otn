<div class="row" id="category_scope">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo $this->lang->line('list_title'); ?></strong>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover data-tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('name'); ?></th>
                                <th><?php echo $this->lang->line('sort_order'); ?></th>
                                <th><?php echo $this->lang->line('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $order => $category) : ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo($order + 1); ?></td>
                                        <td><?php echo $category->name; ?></td>
                                        <td><?php //echo $category->description; ?></td>
                                        <td class="center">
                                            <a class="btn btn-xs btn-success" href="<?php echo base_url("admin/categories/edit/$category->_id"); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                            <button class="btn btn-xs btn-danger btn-category-del-record-model" 
                                                data-category-name="<?php echo $category->name; ?>"
                                                data-category-id="<?php echo $category->_id; ?>"
                                            ><i class="glyphicon glyphicon-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade category-delete-model display-none" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header fontbold">Thông báo</div>
          <div class="modal-body ">
            <?php echo $this->lang->line('delete_confirm'); ?><span class="text-primary text-category-name"></span> ?
          </div>
          <div class="col-lg-12 message-alert"></div>
          <div class="clear"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-category-del-record-confirm" >Xóa</button>
            <button type="button" class="btn btn-default btn-category-cancel-del-record" data-dismiss="modal">Hủy</button>
          </div>
        </div>
      </div>
    </div>

</div>
<script src="<?php echo base_url('modules/admin/resources/js/category_page.js'); ?>"></script>