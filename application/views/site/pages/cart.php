<script type="text/javascript">
    /* hàm chuyển vnd*/
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2 + 'đ';
    }
    /* end*/
    /* truyền số lượng sản phẩm ajax */
    $(document).ready(function(){
        <?php for ($i=1; $i <= count($cart) ; $i++) { ?>
            $('#upCart<?php echo $i ?>').on('change keyup', function(){
                var abc = $(this);
                var newQty = $('#upCart<?php echo $i ?>').val();
                var rowId = $('#rowId<?php echo $i ?>').val();
                var proId = $('#proId<?php echo $i ?>').val();

                if(newQty <= 0)
                {
                    alert("Value is impossible");
                }
                else
                {
                    $.ajax({
                        type:'get',
                        dataType:'text',
                        url:"<?php echo base_url('site/cart/update/'); ?>",
                        data:"qty= "+ newQty + "& rowId=" + rowId + "& proId=" + proId,
                        success: function(response ){

                         var b = JSON.parse(response);
                         var totalPrice = 0;
                         for (var key in b)
                         {
                            if(b[key].rowid == rowId)
                            {

                                $('#subtotal<?php echo $i ?>').text(addCommas(b[key].subtotal));

                            }
                            totalPrice +=  b[key].subtotal;
                        }
                        $('.sum').text(addCommas(totalPrice));


                    }   
                });
                }
            });
            <?php } ?>
            /* end*/
            /* Xóa một sp trong giỏ hàng*/
            $('.delete-product').click(function(){
                var rowId = $(this).val();
                $.ajax({

                    type:'get',
                    dataType:'text',
                    url:"<?php echo base_url('site/cart/delete/'); ?>",
                    data:"rowid= "+ rowId,
                    success: function(response ){
                        location.reload();
                    }
                });
            });
            /* end*/
            
        });
    

</script>

<div class="container cart-review" style="min-height: 500px">
    <div class="row">
        <?php
        if (count($cart) > 0) :
           ?>
           <div class="col-sm-6 col-xs-12">
            <div style="margin:20px 0">
                <span class="btn-title">Giỏ hàng</span>
            </div>

            <div class="table-responsive">
    <table class="table table-hover">
                    <thead>
                        <tr>

                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $totalPrice = 0; 
                            $count = 1;
                            foreach ($cart as $carts):

                            ?>
                            <tr>
                                <td><?php echo $carts['real_name'] ?>
                                    <input type="hidden" name="rowId" id="rowId<?php echo $count ?>" value="<?php echo $carts['rowid'] ?>" >
                                    <input type="hidden" name="proId" id="proId<?php echo $count ?>" value="<?php echo $carts['id'] ?>" >
                                </td>
                                <td><?php echo vnd($carts['price'])  ?></td>
                                <td class="order-amount">
                                    <input type="number" name="qty_<?php echo $carts['id'] ?>" id="upCart<?php echo $count ?>" value="<?php echo $carts['qty'] ?>" size="5">

                                    <!-- <span style="display:block; height: 20px;"></span>
                                <button class="btn btn-default minus btn-xs">
                                    <b class="fa fa-minus"></b>
                                </button>
                                <button class="btn btn-default plus btn-xs">
                                    <b class="fa fa-plus"></b>
                                </button>  -->
                            </td>

                            <td id="subtotal<?php echo $count ?>" ><?php echo vnd($carts['subtotal'])  ?></td>
                            <td>
                                <button value="<?php echo $carts['id'] ?>" class="btn btn-default btn-sm delete-product">
                                    <b class="fa fa-times "></b>
                                </button>

                            </td>
                        </tr>
                        <?php 
                        $totalPrice += $carts['subtotal'];
                        $count++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
            
        <div class="div text-right sum">
            <?php echo vnd($totalPrice) ?>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12 user-info">

        <form action="<?php echo base_url().'site/order/checkOut' ?>" method="GET" role="form" >
            <div style="margin:20px 0">
                <span class="btn-title">Thông tin khách hàng</span>
            </div>
            <div class="form-group">
                <label for="namecustomer">Họ tên khách hàng
                   
                </label>
                <input type="text" class="form-control" id="namecustomer" name="namecustomer" placeholder="Họ tên khách hàng" required>
            </div>
            <div class="form-group">
                <label for="form-contact-phone">Điện thoại khách hàng
                    
                </label>
                <input type="text" class="form-control" id="phonecustomer" name="phonecustomer" placeholder="Điện thoại khách hàng" required pattern="\d*">
            </div>
            <div class="form-group">
                <label for="form-contact-email">Địa chỉ email</label>
                <input type="email" class="form-control" id="emailcustomer" name="emailcustomer" placeholder="Địa chỉ email" required>
            </div>
            <div class="form-group">
                <div style="margin:20px 0">
                    <span class="btn-title">Phương thức giao hàng</span>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="order" id="order" value="home" required>
                        <b class="fa fa-truck"></b> Giao hàng tận nhà</label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="order" id="order" value="store" required>
                            <b class="fa fa-home"></b> Nhận tại cửa hàng</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-contact-address">Địa chỉ giao hàng
                            
                        </label>
                        <input type="text" class="form-control" name="adrcustomer" id="adrcustomer" placeholder="Địa chỉ giao hàng (Số nhà, tên đường,...)" required
                        >
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú
                        </label>
                        <input type="textarea" class="form-control" id="" placeholder="Yêu cầu thêm của bạn" name="note">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="order-btn" class="btn btn-default btn-order">Xác nhận đặt hàng</button>
                    </div>
                </form>
            </div>
            <?php 
        else:
         ?>
         <div class="noneitem">
            <?php 
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                 ?>
             <i class="fa fa-shopping-cart  fa-5x fa-custom" aria-hidden="true" style="color: red"></i>
             <p>Không có sản phẩm nào trong giỏ hàng</p>
             <button type="button" class="btn btn-default "><a href="<?php echo base_url() ?>">Quay lại trang chủ</a></button>

         </div>
     <?php endif; ?>
 </div>
</div>

