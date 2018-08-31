<div class="container product">



    <ol class="breadcrumb" style="margin-top: 10px">

    <li><a style="color: #262626" href="<?php echo base_url() ?>">Trang chủ</a></li>

    <li><a style="color: #262626" href="<?php echo base_url('danhmucsanpham/' . $parentCategory->alias_name) ?>"><?php echo $parentCategory->name ?></a></li>

    <li class="active"><?php echo $info->name ?></li>

    </ol>



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

        <div class="col-sm-8">

            <div class="row">

                <div class="col-sm-6">

                    <iframe class="video-product" ID="frame1" width="100%" src="https://www.youtube.com/embed/<?php echo $info->video;?>" frameborder="0" allowfullscreen auto></iframe>

                </div>

                

                <div class="image col-sm-6">

                    

                    <div class="big-image">

        

                        <img src="<?php echo upload_image_url($info->image_thumb); ?>" alt="" class="img-responsive img-main">

        

                    </div>

        

                    <div class="" style="margin-top: 15px">

        

                        <div class="owl-carousel owl-theme">

        

                            <?php if (isset($info->listImageThumb) && $info->listImageThumb): ?>

                                    <img src="<?php echo upload_image_url($info->image_thumb); ?>" class="img-sub img-responsive" alt="">

                                <?php foreach($info->listImageThumb as $image) :?>

                                    <img src="<?php echo upload_image_url($image); ?>" class="img-sub img-responsive" alt="">

                                

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                        

                

            </div>



        </div>



        <div class="col-sm-4 info">

        

            <div class="col-sm-12 name text-center"><?php echo $info->name; ?></div>

        

            <div class="col-sm-12 price text-center">

                <?php if(isset($info->priceDiscount) && $info->priceDiscount ) {?>

                    <span class="new-price"><?php echo $info->priceDiscount;?></span>

                    <span class="old-price"><?php echo $info->priceVND;?></span>

                <?php } else { ?>

                    <span class="new-price"><?php echo $info->priceVND;?></span>

                <?php } ?>

            </div>



            <div class="col-sm-12 amount text-center">

            

                Số lượng:

            

                <input type="number" name="" id="slMua" value="1" class="inputAmount" min="1" max="100">

            

                <button class="btn btn-default minus btn-xs">

            

                    <b class="fa fa-minus"></b>

            

                </button>

            

                <button class="btn btn-default plus btn-xs">

            

                    <b class="fa fa-plus"></b>

            

                </button>

            

            </div>

            

            <div class="col-sm-12 text-center">

                <?php if ($check == 0) {?>

                <a value="<?php echo base_url() . 'addtocart/'.$info->id; ?>" class="add-to-cart addCart">Mua hàng</a>

                <?php }

                else { ?>

                <a value="<?php echo base_url() . 'deletefromdetail'?>" class="add-to-cart deleteCart">Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i></a>

                <?php } ?>

            </div>

            

            <hr>

            

            <div class="col-sm-12 promotion">

            

                <span class="btn-title">Ưu đãi khi mua sản phẩm</span>

            

                <div class="detail">

            

                    <?php if($info->promotion && $info->promotion != '') echo $info->promotion; else echo "Không có ưu đãi"?>

            

                </div>

            

                <hr>

            

            </div>

            

            <div class="col-sm-12 policy">

            

                <span class="btn-title">Chính sách bảo hành</span>

            

                <div class="detail">

            

                    <?php if($info->describe && $info->describe != '')echo $info->describe; else echo "Không có chính sách bảo hành"?>

            

                </div>

            

                <hr>

            

            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-12 component" style="margin-top: 30px;">

            

                    <div class="col-sm-12">

            

                        <span class="btn-title">thông số phụ kiện</span>

            

                    </div>

            

                    <div class="list-component col-sm-10 col-sm-offset-1">

            

                        <?php echo  $info->parameter_tecnical;?>

            

            

            

                    </div>

            

                </div>
    </div>



<!-- END-OPTION1 -->



</div>

<style>

.img-sub {

    cursor:pointer;

}


</style>



<script>



    $(document).ready(function(){



        $("#slMua").change(function(){



            if($(this).val() < 1)



                $(this).val(1);



        });



        //thêm sp vào giỏ hàng

        $(".addCart").click(function(){

            var url = $(this).attr('value');

            var slMua = $("#slMua").val();

            url = url.concat("?soluong="+slMua);

            $(location).attr('href',url);

        });



        //xóa sp khỏi giỏ hàng

        $(".deleteCart").click(function(){

            var urlTrangHienTai = $(location).attr('href');

            var urlXoaSP = $(this).attr('value');

            var id = <?php echo $info->id; ?>;

            urlXoaSP = urlXoaSP.concat("?rowid="+id);

            $.ajax({

                url:urlXoaSP,

                type:"GET",

                dataType:"text",

                success:function(result){        

                    $(location).attr('href',urlTrangHienTai);

                }

            });

        });

        //load hình phụ lên hình chính

        $('.img-sub').click(function(){

            //đường dẫn của hình phụ

            var src = $(this).attr('src');

            $('.img-main').attr('src',src);

        });



        $('.owl-carousel').owlCarousel({

            loop: false,

            margin: 5,

            mouseDrag: false,

            nav: true,

            dots: false,

            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],

            responsive: {

                0: {

                    items: 2

                },

                768: {

                    items: 3

                },

                1000: {

                    items: 3

                }

            }

        });

    });







</script>