<div class="btn-sort">

    <b class="fa fa-sort-amount-desc"></b>

</div>

<div class="container category" style="min-height:300px;">

    <ol class="breadcrumb breadcrumb-category" style="margin:0">

        <li><a style="color: #262626" href="<?php echo base_url() ?>">Trang chủ</a></li>

        <li><a style="color: #262626" href="<?php echo base_url('danhmucsanpham/' . $nameCategory) ?>"><?php echo $nameCategoryNoAlias?></li>

    </ol>

    <!-- OPTION 1 -->

    <div class="row">

        <!-- topbar -->

        <div class="top-bar row">

            <form method="GET" action="">

            <!-- Option số 1 -->
                <?php if($nameCategory == 'camera-quan-sat' || $nameCategory == 'phu-kien' || $nameCategory == 'may-anh' || $nameCategory == 'beats') { ?>

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-type">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-book"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Loại

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="type" type="radio" value="all" <?php if(!$option ||$option[ "type"]=='' ) echo "checked";else if($option[

                                                "type"]=="all" ) echo "checked" ?> name="type">Tất cả</label>

                                    </li>

                                    <?php foreach($listBrand as $brand){ ?>

                                    <li>

                                        <label>

                                            <input class="type" type="radio" value="<?php echo $brand->alias_name; ?>" name="type" <?php if ($option) { if ($brand->alias_name == $option["type"]) { $brandName = $brand->name; echo "checked"; }

                                            } ?> >

                                            <?php echo $brand->name; ?>

                                        </label>

                                    </li>

                                    <?php } ?>

                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["type"] == ''||$option["type"] == "all") 

                                echo "Tất cả";

                                else 

                                echo $brandName; ?>

                            </div>

                        </div>

                    </div>

                </div>

                <?php }
                

                else { ?>

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-type">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-book"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Hãng

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="hang" type="radio" value="all" <?php if(!$option ||$option[ "nameBrand"]=='' ) echo "checked";else if($option[

                                                "nameBrand"]=="all" ) echo "checked" ?> name="brand">Tất cả</label>

                                    </li>

                                    <?php foreach($listBrand as $brand){ ?>

                                    <li>

                                        <label>

                                            <input class="hang" type="radio" value="<?php echo $brand->alias_name; ?>" name="brand" <?php if ($option) { if ($brand->alias_name == $option["nameBrand"]) { $brandName = $brand->name; echo "checked";

                                            } } ?> >

                                            <?php echo $brand->name; ?>

                                        </label>

                                    </li>

                                    <?php } ?>

                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["nameBrand"] == ''||$option["nameBrand"] == "all") 

echo "Tất cả";

else 

echo $brandName; ?>



                            </div>

                        </div>

                    </div>

                </div>

                <?php } ?>
                <!-- End Option số 1 -->


                <!-- Option số 2 -->

                <?php if($nameCategory == 'dien-thoai') {?>

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-price">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-money"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Giá

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="0" <?php if(!$option || $option[ "price"]=='' ) echo "checked";else if($option[

                                                "price"]=="0" ) echo "checked" ?> name="price">Tất cả</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="1" <?php if($option) {if($option[ "price"]=="1" ) echo "checked"; }?> name="price">Dưới 5tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="2" <?php if($option) {if($option[ "price"]=="2" ) echo "checked"; }?> name="price">5tr - 8tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="3" <?php if($option) {if($option[ "price"]=="3" ) echo "checked"; }?> name="price">Trên 8tr</label>

                                    </li>



                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["price"] == ''||$option["price"] == "0") 

echo "Tất cả";

else if($option["price"]=="1")

echo "Dưới 5tr";

else if($option["price"]=="2")

echo "5tr - 8tr"; 

else if($option["price"]=="3")

echo "Trên 8tr"; 



?>

                            </div>

                        </div>

                    </div>

                </div>

                <?php } 
else if ($nameCategory == 'all-in-one')
{
                ?>
                                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-price">

<div class="criteria row">

    <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

        <b class="fa fa-money"></b>

    </div>

    <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

        <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

            <div class="" type="button" data-toggle="dropdown">Giá

                <span class="caret"></span>

            </div>

            <ul class="dropdown-menu">

                <li>

                    <label>

                        <input class="gia" type="radio" value="0" <?php if(!$option || $option[ "price"]=='' ) echo "checked";else if($option[

                            "price"]=="0" ) echo "checked" ?> name="price">Tất cả</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="1" <?php if($option) {if($option[ "price"]=="1" ) echo "checked"; }?> name="price">Dưới 10tr</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="2" <?php if($option) {if($option[ "price"]=="2" ) echo "checked"; }?> name="price">10tr - 15tr</label>

                </li>
                <li>

                    <label>

                        <input class="gia" type="radio" value="3" <?php if($option) {if($option[ "price"]=="3" ) echo "checked"; }?> name="price">15tr - 20tr</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="4" <?php if($option) {if($option[ "price"]=="4" ) echo "checked"; }?> name="price">Trên 20tr</label>

                </li>



            </ul>

        </div>

        <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

            <?php if(!$option ||$option["price"] == ''||$option["price"] == "0") 

echo "Tất cả";

else if($option["price"]=="1")

echo "Dưới 10tr";

else if($option["price"]=="2")

echo "10tr - 15tr"; 

else if($option["price"]=="3")

echo "15tr - 20tr"; 

else if($option["price"]=="4")

echo "Trên 20tr"; 



?>

        </div>

    </div>

</div>

</div>
                <?php
}

else if ($nameCategory == 'laptop') { ?>

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-screen">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-money"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Màn hình

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="screen" type="radio" value="0" <?php if(!$option || $option[ "screen"]=='' ) echo "checked";else if($option[

                                                "screen"]=="0" ) echo "checked" ?> name="screen">Tất cả</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="screen" type="radio" value="1" <?php if($option) {if($option[ "screen"]=="1" ) echo "checked"; }?> name="screen">Dưới 14"</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="screen" type="radio" value="2" <?php if($option) {if($option[ "screen"]=="2" ) echo "checked"; }?> name="screen">14" - 16"</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="screen" type="radio" value="3" <?php if($option) {if($option[ "screen"]=="3" ) echo "checked"; }?> name="screen">Trên 16"</label>

                                    </li>



                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["screen"] == ''||$option["screen"] == "0") 

echo "Tất cả";

else if($option["screen"]=="1")

echo "Dưới 14\"";

else if($option["screen"]=="2")

echo "14\" - 16\""; 

else if($option["screen"]=="3")

echo "Trên 16\""; 



?>

                            </div>

                        </div>

                    </div>

                </div>

                <?php 

}
else if ($nameCategory == 'phu-kien') {
    ?>
    <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-product-sub">

<div class="criteria row">

    <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

        <b class="fa fa-book"></b>

    </div>

    <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

        <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

            <div class="" type="button" data-toggle="dropdown">Sản phẩm

                <span class="caret"></span>

            </div>

            <ul class="dropdown-menu">

                <li>

                    <label>

                        <input class="subPro" type="radio" value="all" <?php if(!$option ||$option[ "subPro"]=='' ) echo "checked";else if($option[

                            "subPro"]=="all" ) echo "checked" ?> name="subPro">Tất cả</label>

                </li>

                <?php foreach($listSubProductAcc as $SubProduct){ ?>

                <li>

                    <label>

                        <input class="subPro" type="radio" value="<?php echo $SubProduct->alias_name; ?>" name="subPro" <?php if ($option) { if ($SubProduct->alias_name == $option["subPro"]) { $subProductName = $SubProduct->name; echo "checked"; }

                        } ?> >

                        <?php echo $SubProduct->name; ?>

                    </label>

                </li>

                <?php } ?>

            </ul>

        </div>

        <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

            <?php if(!$option ||$option["subPro"] == ''||$option["subPro"] == "all") 

            echo "Tất cả";

            else 

            echo $subProductName; ?>

        </div>

    </div>

</div>

</div>
    <?php
}

else if ($nameCategory == 'may-anh') { ?>

<div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-type">

<div class="criteria row">

    <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

        <b class="fa fa-book"></b>

    </div>

    <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

        <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

            <div class="" type="button" data-toggle="dropdown">Hãng

                <span class="caret"></span>

            </div>

            <ul class="dropdown-menu">

                <li>

                    <label>

                        <input class="hang" type="radio" value="all" <?php if(!$option ||$option[ "nameBrand"]=='' ) echo "checked";else if($option[

                            "nameBrand"]=="all" ) echo "checked" ?> name="brand">Tất cả</label>

                </li>

                <?php foreach($listSubBrand as $brand){ ?>

                <li>

                    <label>

                        <input class="hang" type="radio" value="<?php echo $brand->alias_name; ?>" name="brand" <?php if ($option) { if ($brand->alias_name == $option["nameBrand"]) { $brandName = $brand->name; echo "checked";

                        } } ?> >

                        <?php echo $brand->name; ?>

                    </label>

                </li>

                <?php } ?>

            </ul>

        </div>

        <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

            <?php if(!$option ||$option["nameBrand"] == ''||$option["nameBrand"] == "all") 

echo "Tất cả";

else 

echo $brandName; ?>



        </div>

    </div>

</div>

</div>

                <?php 

}
else if($nameCategory == 'beats') {
    ?>
    <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-price">

<div class="criteria row">

    <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

        <b class="fa fa-money"></b>

    </div>

    <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

        <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

            <div class="" type="button" data-toggle="dropdown">Giá

                <span class="caret"></span>

            </div>

            <ul class="dropdown-menu">

                <li>

                    <label>

                        <input class="gia" type="radio" value="0" <?php if(!$option || $option[ "price"]=='' ) echo "checked";else if($option[

                            "price"]=="0" ) echo "checked" ?> name="price">Tất cả</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="1" <?php if($option) {if($option[ "price"]=="1" ) echo "checked"; }?> name="price">Dưới 1tr</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="2" <?php if($option) {if($option[ "price"]=="2" ) echo "checked"; }?> name="price">1tr - 3tr</label>

                </li>
                <li>

                    <label>

                        <input class="gia" type="radio" value="3" <?php if($option) {if($option[ "price"]=="3" ) echo "checked"; }?> name="price">3tr - 5tr</label>

                </li>

                <li>

                    <label>

                        <input class="gia" type="radio" value="4" <?php if($option) {if($option[ "price"]=="4" ) echo "checked"; }?> name="price">Trên 5tr</label>

                </li>



            </ul>

        </div>

        <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

            <?php if(!$option ||$option["price"] == ''||$option["price"] == "0") 

echo "Tất cả";

else if($option["price"]=="1")

echo "Dưới 1tr";

else if($option["price"]=="2")

echo "1tr - 3tr"; 

else if($option["price"]=="3")

echo "3tr - 5tr"; 

else if($option["price"]=="4")

echo "Trên 5tr"; 



?>

        </div>

    </div>

</div>

</div>
    <?php
}
else { ?>

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-price">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-money"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Giá

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="0" <?php if(!$option || $option[ "price"]=='' ) echo "checked";else if($option[

                                                "price"]=="0" ) echo "checked" ?> name="price">Mọi mức giá</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="1" <?php if($option) {if($option[ "price"]=="1" ) echo "checked"; }?> name="price">Dưới 1tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="2" <?php if($option) {if($option[ "price"]=="2" ) echo "checked"; }?> name="price">1tr - 5tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="3" <?php if($option) {if($option[ "price"]=="3" ) echo "checked"; }?> name="price"> 5tr - 10tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="4" <?php if($option) {if($option[ "price"]=="4" ) echo "checked"; }?> name="price">10tr - 20tr</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="gia" type="radio" value="5" <?php if($option) {if($option[ "price"]=="5" ) echo "checked"; }?> name="price">Trên 20tr</label>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["price"] == ''||$option["price"] == "0") 

echo "Mọi mức giá";

else if($option["price"]=="1")

echo "Dưới 1tr";

else if($option["price"]=="2")

echo "1tr - 5tr"; 

else if($option["price"]=="3")

echo "5tr - 10tr"; 

else if($option["price"]=="4")

echo "10tr - 20tr"; 

else if($option["price"]=="5")

echo "Trên 20tr"; ?>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

}?>
<!-- End Option số 2 -->


<!-- Option số 3 -->

                <div class="col-sm-4 col-lg-4 col-xs-12 sort-category category-sort">

                    <div class="criteria row">

                        <div class="col-sm-2 col-lg-2 col-xs-2 icon text-center">

                            <b class="fa fa-sort-amount-desc"></b>

                        </div>

                        <div class="col-sm-10 col-lg-10 col-xs-10 select text-center">

                            <div class="dropdown col-sm-6 col-lg-6 col-xs-6">

                                <div class="" type="button" data-toggle="dropdown">Sắp xếp

                                    <span class="caret"></span>

                                </div>

                                <ul class="dropdown-menu">

                                    <li>

                                        <label>

                                            <input class="sapxep" type="radio" value="0" <?php if(!$option || $option[ "order"]=='' ) echo "checked";else if($option[

                                                "order"]=="0" ) echo "checked" ?> name="order">Không</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="sapxep" type="radio" value="1" <?php if($option) {if($option[ "order"]=="1" ) echo "checked"; }?> name="order">Giá từ thấp đến cao</label>

                                    </li>

                                    <li>

                                        <label>

                                            <input class="sapxep" type="radio" value="2" <?php if($option) {if($option[ "order"]=="2" ) echo "checked"; } ?> name="order">Giá từ cao đến thấp</label>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-sm-6 col-lg-6 col-xs-6 overflow" style="overflow: hidden">

                                <?php if(!$option ||$option["order"] == ''||$option["order"] == "0") 

echo "Không";

else if($option["order"]=="1")

echo "Tăng dần";

else if($option["order"]=="2")

echo "Giảm dần"; ?>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>
        <!-- End Option số 3 -->

        <!-- end-topbar -->

        <hr>

        <div class="products-list">

            <div class="row">



                <?php 

$count = 0;



foreach($listProduct as $product){

++$count;

if($count % 3 === 1) {

    echo '<div class="clearfix"></div>';

}

$i = 0;



foreach($listProductInCart as $row)

{ 

if($row['id'] == $product->id)

$i++;

}    

?>

        <div class="col-sm-4 col-lg-4 col-xs-12 product-item text-center">

            <div class="inner">

                <div class="image-novideo">

                    <img src="<?php echo upload_image_url($product->image_thumb) ?>" alt="" class="img-responsive">

                </div>

                <div class="action row">

                    <div class="col-sm-6 col-lg-6 col-xs-6 view-detail">

                        <a href="<?php echo base_url() .'sanpham/'.$product->id; ?>">

                            <b class="fa fa-eye"></b> chi tiết

                        </a>

                    </div>

                    <div class="col-sm-6 col-lg-6 col-xs-6 add-to-cart">

                        <a value="<?php echo base_url() . 'themgiohang/'.$product->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                            <?php if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";     else echo "Mua hàng";?>

                        </a>

                    </div>

                </div>

                <div class="info">

                    <p class="name">

                        <?php echo $product->name?>

                    </p>

                    <p class="price">

                        <?php if (isset($product->priceDiscount) && $product->priceDiscount) echo $product->priceDiscount; else echo $product->priceVND;?>

                    </p>

                </div>

            </div>

        </div>



        <?php 

        

        

    } 

if($count == 0) echo "Không tìm thấy kết quả nào!";

?>



            </div>

        </div>

        <!-- pagination -->

        <div class="row text-center">

            <?php echo $pagination;?>

        </div>

        <!-- end-pagination -->

    </div>

    <!-- END-OPTION1 -->

</div>

<script>

    var videos = <?php echo json_encode($video) ?>



    $(document).ready(function () {

        $(".hang,.gia,.sapxep,.screen,.lens,.type,.subPro").change(function () {



            var form = $(this).closest("form");

            //problem: khi thay đổi option của input type="radio" thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)



            //lấy value của option vừa chọn

            var brand = $('.hang:checked').val();

            var price = $('.gia:checked').val();

            var order = $('.sapxep:checked').val();

            var screen = $('.screen:checked').val();

            var lens = $('.lens:checked').val();

            var type = $('.type:checked').val();

            var subPro = $('.subPro:checked').val();


            //trường hợp số trang nằm từ 1 đến 9999

            var patt = /([\d][?]|[\d][\d][?]|[\d][\d][\d][?]|[\d][\d][\d][\d][?])/g;



            //lấy url hiện tại 

            var url = $(location).attr('href');



            //lấy được trang hiện tại kèm dấu ? ví dụ: 1?, 2?, 3?

            var page = url.match(patt);



            //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/(:num)?brand=all&price=0&order=0

            //nếu trang hiện tại có 1 trong các query string brand,price,order

            if (page) {

                //page hiện tại không phải là 1

                if (page != "1?") {



                    //khi thay đổi option thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)

                    url = url.replace(page, "1?");

                    //cắt chuỗi

                    var start = 0;

                    var end = 0;

                    for (var i = 0; i < url.length; i++) {

                        if (url[i] == '?') end = i;

                    }

                    //lấy url trước dấu ?

                    url = url.substring(start, end);

                    //nối chuỗi



                    if ("<?php echo $nameCategory?>" == "laptop")

                        url = url.concat("?brand=" + brand + "&screen=" + screen + "&order=" + order);

                    else if ("<?php echo $nameCategory?>" == "may-anh")

                        url = url.concat("?type=" + type + "&brand=" + brand + "&order=" + order);

                    else if ("<?php echo $nameCategory?>" == "camera" || "<?php echo $nameCategory?>" == "beats")

                        url = url.concat("?type=" + type + "&price=" + price + "&order=" + order);
                    else if ("<?php echo $nameCategory?>" == "phu-kien")

                        url = url.concat("?type=" + type + "&subPro=" + subPro + "&order=" + order);
                    else

                        url = url.concat("?brand=" + brand + "&price=" + price + "&order=" + order);

                    //redirect

                    $(location).attr('href', url);

                } else //page hiện tại là 1 submit bình thường

                    form.submit();

            } else {

                //có 3 trường hợp

                //trường hợp 1: url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/(:num)

                //trường hợp 2: url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/

                //trường hợp 3: url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)

                var arrayOption = url.split("/");



                //lấy trang hiện tại

                page = arrayOption[5];



                //lấy danh mục sản phẩm hiện tại

                var category = arrayOption[4];



                //nếu tồn tại trang hiện tại

                if (page) {

                    var checkNumber = $.isNumeric(page);



                    //kiểm tra trang hiện tại nếu là số thì là trường hợp 1

                    if (checkNumber) {

                        //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/(:num)

                        if (page != "1") {

                            //nếu trang hiện không phải 1 thì sẽ chuyển về trang 1 kèm theo option người dùng chọn

                            url = url.replace(page, "1");



                            //nối chuỗi

                            if ("<?php echo $nameCategory?>" == "laptop")

                                url = url.concat("?brand=" + brand + "&screen=" + screen + "&order=" +

                                    order);

                            else if ("<?php echo $nameCategory?>" == "camera" || "<?php echo $nameCategory?>" == "beats")

                                url = url.concat("?type=" + type + "&price=" + price + "&order=" +

                                    order);

                            else if ("<?php echo $nameCategory?>" == "may-anh")

                                url = url.concat("?type=" + type + "&brand=" + brand + "&order=" + order);

                            else if ("<?php echo $nameCategory?>" == "phu-kien")

                                url = url.concat("?type=" + type + "&subPro=" + subPro + "&order=" + order);

                            else

                                url = url.concat("?brand=" + brand + "&price=" + price + "&order=" +

                                    order);



                            //redirect

                            $(location).attr('href', url);

                        } else //page hiện tại là 1 submit bình thường

                            form.submit();

                    }



                } else if (category) {

                    if (page == '') {

                        //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/

                        url = url.concat("1");

                        //nối chuỗi

                        if ("<?php echo $nameCategory?>" == "laptop")

                            url = url.concat("?brand=" + brand + "&screen=" + screen + "&order=" +

                                order);

                        else if ("<?php echo $nameCategory?>" == "may-anh")

                            url = url.concat("?type=" + type + "&brand=" + brand + "&order=" + order);

                        else if ("<?php echo $nameCategory?>" == "camera" || "<?php echo $nameCategory?>" == "beats")

                            url = url.concat("?type=" + type + "&price=" + price + "&order=" + order);
                        else if ("<?php echo $nameCategory?>" == "phu-kien")

                            url = url.concat("?type=" + type + "&subPro=" + subPro + "&order=" + order);

                        else

                            url = url.concat("?brand=" + brand + "&price=" + price + "&order=" + order);

                        //redirect

                        $(location).attr('href', url);

                    } else { //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)

                        form.submit();

                    }

                }



            }





        });

    });

</script>