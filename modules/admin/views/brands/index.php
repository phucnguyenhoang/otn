<div class="row" id="brand_scope">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo $lang_list_title; ?></strong>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover data-tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $lang_name; ?></th>
                                <th><?php echo $lang_description; ?></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($brands)): ?>
                                <?php foreach ($brands as $order => $brand) : ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo($order + 1); ?></td>
                                        <td><?php echo $brand->name; ?></td>
                                        <td><?php echo $brand->description; ?></td>
                                        <td class="center">
                                            <a class="btn btn-xs btn-success" href="<?php echo base_url("admin/brands/edit/$brand->_id"); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                            <button class="btn btn-xs btn-danger btn-brand-del-record-model" 
                                                data-brand-name="<?php echo $brand->name; ?>"
                                                data-brand-id="<?php echo $brand->_id; ?>"
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

    <div class="modal fade brand-delete-model display-none" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header fontbold">Thông báo</div>
          <div class="modal-body ">
            bạn có muốn xóa tên thương hiệu <span class="text-primary text-brand-name"></span> ?
          </div>
          <div class="col-lg-12 message-alert"></div>
          <div class="clear"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-brand-del-record-confirm" >Xóa</button>
            <button type="button" class="btn btn-default btn-brand-cancel-del-record" data-dismiss="modal">Hủy</button>
          </div>
        </div>
      </div>
    </div>

</div>