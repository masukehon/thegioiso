<div class="col-sm-9 content category-product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Danh mục đơn hàng</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <!-- form -->
                <div class="col-sm-9">
                    <form class="form-horizontal" method="get" action="<?php echo admin_url('order/') ?>">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-sm-4">Tình trạng đơn hàng: </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="statusOrder">
                                    <option value="">Tất cả</option>
                                    <option 
                                    <?php echo ($this->input->get('statusOrder') == "Đơn hàng mới") ? "selected" : "";
                                    ?>
                                    >Đơn hàng mới</option>
                                    <option
                                    <?php echo ($this->input->get('statusOrder') == "Đang xử lý") ? "selected" : "";
                                    ?>
                                    >Đang xử lí</option>
                                    <option
                                    <?php echo ($this->input->get('statusOrder') == "Đã xử lý") ? "selected" : "";
                                    ?>
                                    >Đã xử lí</option>
                                    <option
                                    <?php echo ($this->input->get('statusOrder') == "Đã hủy") ? "selected" : "";
                                    ?>
                                    >Đã hủy</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1" class="control-label col-sm-4">Tình trạng duyệt: </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="seenOrder">
                                    <option value="" >Tất cả</option>
                                    <option value="0"
                                    <?php echo ($this->input->get('seenOrder') == "0") ? "selected" : "";
                                    ?>
                                    >Chưa duyệt</option>
                                    <option value="1"
                                    <?php echo ($this->input->get('seenOrder') == "1") ? "selected" : "";
                                    ?>
                                    >Đã duyệt</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="submit" class="btn btn-success btn-group-vertical"><b class="fa fa-search"></b></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end-form -->
                <!-- btn -->
                <div class="col-sm-3 text-right">
                </div>
                <!-- end-btn -->
                <!-- table -->
                <?php

                if(count($list) > 0)
                {
                  ?>                  
                  <div class="col-sm-12">
                    <h3>Danh sách sản phẩm</h3>
                    <table class="table table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>TÊN khách hàng</th>
                                <th>điện thoại</th>
                                <th>email</th>
                                <th>ngày đặt</th>
                                <th>trạng thái</th>
                                <th>duyệt</th>
                                <th>Đã thanh toán</th>
                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($list as $listOrder) {
                               ?>
                               <tr>
                                <td><?php echo $listOrder->id; ?></td>
                                <td><a href="<?php echo admin_url("chitietdonhang/?id=$listOrder->id") ?>">
                                    <?php echo $listOrder->customer_name ;?></a></td>

                                    <td><?php echo $listOrder->phone_number; ?></td>
                                    <td><?php echo $listOrder->email; ?></td>
                                    <td><?php echo $listOrder->create_at; ?></td>
                                    <td><?php echo $listOrder->status; ?></td>
                                    
                                    <td>
                                        <input disabled="disabled"  type="checkbox" name="isSeen" id="isSeen" value="1"<?php
                                            if($listOrder->is_seen == "1")
                                            {
                                                echo "checked";
                                            }
                                            else
                                            {
                                                echo "unchecked";
                                            }
                                        ?>>
                                    </td>
                                    <td>
                                        <input disabled="disabled" type="checkbox" name="isPaid" id="isPaid" value="1"
                                        <?php
                                            if($listOrder->is_paid == "1")
                                            {
                                                echo "checked";
                                            }
                                            else
                                            {
                                                echo "unchecked";
                                            }

                                        ?>>
                                    </td>

                                    <td><a href="<?php echo admin_url("chitietdonhang/?id=$listOrder->id") ?>" class="btn btn-primary btn-xs">Chi Tiết</a></td>
                                </tr>
                                <?php }

                                ?>
                            </tbody>
                        </table>
                        <?php
                       
                        echo $pagination;               
                       
                        ?>

                        <!-- end-table -->

                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <a href="<?php echo admin_url('order/') ?>">Hiện không có đơn hàng nào, click vào đây để quay lại</a>
                    <?php

                } 
                ?>
            </div>
        </div>
    </div>
</div>