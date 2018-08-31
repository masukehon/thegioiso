<div class="col-sm-9 content order-detail">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Chi tiết đơn hàng</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
             <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                <div class="col-sm-12">
                    <div>
                        <span class="order-title">Thông tin đơn hàng: </span>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST">
                            <!-- truyen id don hang cho input -->
                            <input type="hidden" name="id_Order_Status" value="<?php 
                            echo (count($info) > 0) ? $info->id : ""
                            ?>">
                            <!-- danh mục tin tức -->
                            <div class="form-group">
                                <label for="sel1" class="control-label col-sm-6">Trạng thái đơn hàng: </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="detail_Status">
                                        <!-- nhận giá trị từ post và so sánh  -->
                                        <option
                                        <?php echo ($this->input->post('detail_Status') == "Đơn hàng mới") ? "selected" : "";
                                        ?>
                                        >Đơn hàng mới</option>
                                        <option
                                        <?php echo ($this->input->post('detail_Status') == "Đang xử lí") ? "selected" : "";
                                        ?>
                                        >Đang xử lí</option>
                                        <option
                                        <?php echo ($this->input->post('detail_Status') == "Đã xử lí") ? "selected" : "";
                                        ?>
                                        >Đã xử lí</option>
                                        <option
                                        <?php echo ($this->input->post('detail_Status') == "Đã hủy") ? "selected" : "";
                                        ?>
                                        >Đã hủy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10 text-center">
                                    <button type="submit" class="btn btn-success btn-group-vertical">
                                        <b class="fa fa-plus-circle"></b> Lưu
                                    </button>

                                </div>
                            </div>
                        </form>
                        <?php


                        // xuất ra thông báo nếu có thay đổi trạng thái
                        if(isset($notification)){
                            ?>
                            <i style="color: blue"><?php echo $notification; ?></i>
                            <?php 

                        }
                        ?>
                    </div>
                    <div class="col-sm-6 text-right">

                     <div class="row">
                        <div class="col-sm-6" style="float: right;width:30%">
                         <form action="" method="POST">
                            <!-- truyen id don hang cho input -->
                            <input type="hidden" name="id_Order_Paid" value="<?php 
                            echo (count($info) > 0) ? $info->id : ""
                            ?>">
                            <input type="hidden" name="detail_Paid" value="1">
                            <button type="submit" class="btn btn-primary">Đã thanh toán</button>
                        </form>
                    </div>
                    <div class="col-sm-6" style="float: right;width:30%">
                     <form action="" method="POST">
                        <!-- truyen id don hang cho input -->
                        <input type="hidden" name="id_Order_Seen" value="<?php 
                        echo (count($info) > 0) ? $info->id : ""
                        ?>">
                        <input type="hidden" name="detail_Seen" value="1">
                        <button type="submit" class="btn btn-primary">Duyệt đơn hàng</button>
                    </form>
                </div>

            </div>



        </div>
    </div>
</div>
<hr>
<div class="col-sm-12">
    <span class="order-title">Tình trạng đơn hàng:</span>
    <?php
    if(count($info) > 0)
    {
     ?>

     <span class="label label-info"><?php echo ($info->is_seen == "1") ? "Đã duyệt" : "Chưa duyệt" ?></span>
     <span class="label label-info"><?php echo $info->status ?></span>
     <span class="label label-info"><?php echo ($info->is_paid == "1") ? "Đã thanh toán" : "Chưa thanh toán" ?></span>
     <?php } ?>
 </div>

 <div class="col-sm-12">
    <div style="margin:20px 0">
        <span class="order-title">Chi tiết giỏ hàng: </span>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="col-sm-3"></th>
                <th class="col-sm-2">Tên sản phẩm</th>
                <th class="col-sm-2">Mã sản phẩm</th>
                <th class="col-sm-2">Đơn giá</th>
                <th class="col-sm-1">Số lượng</th>
                <th class="col-sm-2">Thành tiền</th>
            </tr>
        </thead>
        <?php
        if(count($detail) > 0 )
        {
            $totalOrder = 0;

            foreach ($detail as $detailOrder) {
             ?>
             <tbody class="text-center">
                <tr>
                    <td>
                        <img src="<?php echo base_url().'upload/image/'.$detailOrder->image_thumb; ?>" class="img-responsive" alt="" width=100 height = 100>
                    </td>
                    <td><?php echo $detailOrder->name ?></td>
                    <td><?php echo $detailOrder->code ?></td>
                    <td><?php echo number_format($detailOrder->priceorder,'0',',','.') ?>đ</td>
                    <td class="order-amount">
                     <?php echo $detailOrder->amount ?> 
                 </td>
                 <td><?php

                 $totalProduct = ($detailOrder->amount * $detailOrder->priceorder);
                 echo number_format($totalProduct,'0',',','.')
                 ?>đ</td>
             </tr>

         </tbody>
         <?php
         // tổng tiền của oder += số tiền những sản phẩm
         $totalOrder += $totalProduct;
     }
     ?>

 
</table>
<div class="div text-right sum">
    Tổng tiền: <?php 
    echo number_format($totalOrder,'0',',','.')."đ";
     }?>
</div>
</div>
<?php
if(count($info) > 0){
   ?>
   <div class="col-sm-12 customer-info">

    <div>
        <span class="order-title">Thông tin khách hàng: </span>
    </div>
    <p>
        <span>Tên khách hàng: </span><?php echo  $info->customer_name;  ?></p>
        <p>
            <span>Điện thoại: </span><?php echo $info->phone_number;  ?></p>
            <p>
                <span>Địa chỉ: </span><?php echo $info->address;  ?></p>
                <p>
                    <span>Ngày đặt mua: </span><?php echo $info->create_at;  ?></p>
                    <p>
                        <span>Ghi chú : </span>
                        <p><?php echo $info->note;  ?></p>
                    </p>
                </div>
                <?php } ?>

                <div class="col-sm-12 text-right">
                    <a href="<?php echo admin_url('donhang') ?>" class="btn btn-primary">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>