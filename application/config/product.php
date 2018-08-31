<div class="container product">

    <!-- OPTION 1 -->

    <?php
        $check = 0;
        if(get_total_rows($listProductInCart) > 0){

            foreach($listProductInCart as $productInCart){
                if($productInCart['id'] == $info->id)
                {
                    $check = 1;
                    break;
                }
            } 

        }
    ?>

    <div class="row">

        <div class="col-sm-4">
            <div class="row video">

                <div class="col-sm-12">

                <iframe ID="frame1" width="100%" height="220" src="https://www.youtube.com/embed/<?php echo $info->video;?>" frameborder="0" allowfullscreen auto></iframe>

                </div>

            </div>
            <div class="row component" style="margin-top: 10px;">

                <div class="col-sm-12">

                    <span class="btn-title">thông số phụ kiện</span>

                </div>

                <div class="list-component col-sm-10 col-sm-offset-1">

                <?php echo  $info->parameter_tecnical;?>



                </div>

            </div>
        </div>

        <div class="row image col-sm-4">

                <div class="big-image ">

                    <div class="col-sm-10 col-sm-offset-1">

                        <img src="<?php echo upload_image_url($info->image_thumb); ?>" alt="" class="img-responsive">

                    </div>

                </div>

                <div class="list-small-image col-sm-12">

                    <div class="owl-carousel owl-theme">

                        

                        <?php

                        if (isset($info->listImageThumb) && $info->listImageThumb) {
                             foreach($info->listImageThumb as $image) { ?>
                            
                            <div class="item">

                                <img src="<?php echo upload_image_url($image); ?>" alt="">

                            </div>

                        <?php 
                            }
                        } ?>

                        

                    </div>

                </div>


        </div>

            <!-- 

             -->


        <div class="col-sm-4 info">

            <div class="col-sm-12 name text-center"><?php echo $info->name; ?></div>

            <div class="col-sm-12 price text-center">

                <?php if(isset($info->priceDiscount) && $info->priceDiscount ) {?>

                <span class="new-price"><?php echo $info->priceDiscount;?></span>
                <span class="old-price"><?php echo $info->priceVND;?></span>
                <?php }
                else { ?>
                <span class="new-price"><?php echo $info->priceVND;?></span>
                <?php

                    }

                 ?>

            </div>

            <div class="col-sm-12 amount text-center">

                Số lượng:

                <input type="number" name="" id="slMua" value="1">

                <button class="btn btn-default minus btn-xs">

                    <b class="fa fa-minus"></b>

                </button>

                <button class="btn btn-default plus btn-xs">

                    <b class="fa fa-plus"></b>

                </button>

            </div>

            <div class="col-sm-12 text-center btn">
                <?php if ($check == 0) {?>
                    <a value="<?php echo base_url() . 'addtocart/'.$info->id; ?>" class="add-to-cart addCart">Mua hàng</a>
                <?php }
                else { ?>
                    <a href="<?php echo base_url() . 'deletefromdetail?rowid='.$info->id; ?>" class="add-to-cart addCart"" class="add-to-cart addCart">Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i></a>
                <?php } ?>
            </div>

            <hr>

            <div class="col-sm-12 promotion">

                <span class="btn-title">Chính sách khuyến mãi</span>

                <div class="detail">

                    <?php echo $info->promotion;?>

                </div>

                <hr>

            </div>



            <div class="col-sm-12 policy">

                <span class="btn-title">Chương trình áp dụng</span>

                <div class="detail">

                    <ul>

                        <li>Bảo hành chính hãng: thân máy

                            <b>12 tháng</b>, pin

                            <b> 6 tháng</b>, sạc 6 tháng</li>

                        <li>Giao hàng tận nơi miễn phí trước

                            <b> 09:00 </b>ngày

                            <b>06/11</b> . Tìm hiểu</li>

                        <li>

                            <b>1 đổi 1</b> trong

                            <b> 1 tháng</b> với sản phẩm lỗi</li>

                    </ul>

                </div>

                <hr>

            </div>

        </div>

</div>

    </div>

    <!-- END-OPTION1 -->

</div>

<script>

    $(document).ready(function(){

        $("#slMua").change(function(){

            if($(this).val() < 1)

            $(this).val(1);

        });

        $(".addCart").click(function(){
            var url = $(this).attr('value');
            var slMua = $("#slMua").val();
            url = url.concat("?soluong="+slMua);
            $(location).attr('href',url);
        });

    });

</script>