<div class="container-fluid">

    <!-- header -->

<div class="row" style="margin-top: 10px">

  <div class="col-sm-8 col-xs-12 intro">

    <div id="carousel-id" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">

        <li data-target="#carousel-id" data-slide-to="0" class=""></li>

        <li data-target="#carousel-id" data-slide-to="1" class=""></li>

        <li data-target="#carousel-id" data-slide-to="2" class="active"></li>

    </ol>

    <div class="carousel-inner">

        <?php $i=1; foreach($listSlider as $row){ ?>

        <div class="item <?php if($i == 1) echo "active"; ?>">

          <iframe id="<?php echo $row->video; ?>" width="100%" height="420" src="https://www.youtube.com/embed/<?php echo $row->video; ?>?modestbranding=0&autoplay=0&controls=0&showinfo=0&rel=0&wmode=opaque&enablejsapi=1" frameborder="0" allowfullscreen auto></iframe>

      </div>

      <?php $i++; }?>

  </div>

  <a class="left carousel-control" href="#carousel-id" data-slide="prev">

    <span class="glyphicon glyphicon-chevron-left"></span>

</a>

<a class="right carousel-control" href="#carousel-id" data-slide="next">

    <span class="glyphicon glyphicon-chevron-right"></span>

</a>

</div>

</div>

<div class="col-sm-4 col-lg-4 col-xs-4 news" id="news-index">

    <div class="news-tech">

      <a href="" class="btn btn-link btn-title">Thông tin công nghệ</a>

  </div>

  <div class="news-list">

      <?php foreach($listNews as $news) { ?>

      <hr>

      <div class="news-item">

          <div class="row">

            <a href="<?php echo base_url().'tintuc/chitiet?aliasD='.$news->alias_name; ?>">

              <div class="col-sm-9">

                <p class="news-title">

                  <?php echo $news->name; ?>

              </p>

              <p class="news-time text-right">

                  <?php echo $news->distanceTimeCreate; ?>

              </p>

          </div>

          <div class="col-sm-3">

            <img src="<?php echo upload_image_url($news->image_thumb); ?>" class="img-responsive" alt="">

        </div>

    </a>

</div>

</div>

<?php } ?>



</div>

</div>

</div>

<!-- end-header -->

<hr>

</div>

<div class="container">

    <!-- promotion-modal -->

    <div class="promotion-modal">

      <div class="modal fade" id="modal-id">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header text-center">

              <div class="modal-brand">

                <span>THẾ GIỚI SỐ</span>

                <br>

                <span>SÂN CHƠI CÔNG NGHỆ CỦA BẠN</span>

            </div>

        </div>

        <div class="modal-body col-sm-12 col-lg-12 col-xs-12">

          <div class="image">

            <!-- <img src="<?php echo public_url(); ?>images/popup2.png" alt="" class="img-responsive" height=""> -->

        </div>

        <div class="buttons col-sm-12 col-lg-12 col-xs-12 text-center" style="margin-top: 10px">

            <div class="col-sm-4 col-lg-4 col-xs-4 button">

              <a href="category.html" class="btn btn-default">

                <b class="glyphicon glyphicon-phone"></b>

            </a>

        </div>

        <div class="col-sm-4 col-lg-4 col-xs-4 button">

          <a href="category.html" class="btn btn-default">

            <b class="fa fa-laptop"></b>

        </a>

    </div>

    <div class="col-sm-4 col-lg-4 col-xs-4 button">

      <a href="category.html" class="btn btn-default">

        <b class="fa fa-camera"></b>

    </a>

</div>

</div>

</div>

<div class="btn-continue text-center">

  <a href="" class="btn btn-default">TIẾP TỤC</a>

</div>

</div>

</div>

</div>

</div>

<!-- end-promotion-modal -->







<!-- video-hightlight -->

<div class="video-product-hightlight row section">



  <?php foreach($listHighLight as $product) {?>



  <div class="col-sm-4 col-lg-4 col-xs-6 product-item text-center">

      <a href="<?php echo base_url().'sanpham/'.$product->id; ?>">

        <div class="inner">

            <?php if($product->video): ?>

              <div class="image">

                <img src="<?php echo upload_image_url($product->image_thumb); ?>" alt="" class="img-responsive">

            </div>

            <div class="video" id="<?php echo $product->video ?>">

            </div>

        <?php else:  ?>

            <div class="image-novideo">

                <img src="<?php echo upload_image_url($product->image_thumb); ?>" alt="" class="img-responsive">

            </div>

        <?php endif; ?>

        <div style="font-size: 16px; font-weight: 600; color: #333">

            <?php echo $product->name ?>

        </div>

    </div>

</a>

</div>



<?php } ?>



</div>

<!-- end-video-hightlight -->



<!-- phone -->

<div class="row section">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">điện thoại</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/dien-thoai') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listPhone as $phone) {

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $phone->id)

            {$i++;break; }

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if ($phone->video): ?>

                <div class="image">

                    <img src="<?php echo upload_image_url($phone->image_thumb); ?>" alt="<?php echo $phone->name; ?>" class="img-responsive">

                </div>

                <div class="video" id="<?php echo $phone->video ?>">

                </div>

            <?php else: ?>

                <div class="image-novideo">

                    <img src="<?php echo upload_image_url($phone->image_thumb); ?>" alt="<?php echo $phone->name; ?>" class="img-responsive">

                </div>

            <?php endif; ?>

            <div class="action row">

                <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 view-detail">

                  <a href="<?php echo base_url() . 'sanpham/'.$phone->id ?>">

                    <b class="fa fa-eye"></b> chi tiết</a>

                </div>

                <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $phone->id; ?>">

                  <a value="<?php echo base_url() . 'themgiohang/'.$phone->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                      <?php

                      if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                      else echo "Mua hàng";

                      ?>

                  </a>

              </div>

          </div>

          <div class="info">

            <p class="name">

              <?php echo $phone->name; ?>

          </p>

          <p class="price">

              <?php if (isset($phone->priceDiscount) && $phone->priceDiscount) echo $phone->priceDiscount; else echo $phone->priceVND; ?>

          </p>

      </div>

  </div>

</div>



<?php } ?>



</div>

</div>

<!-- end-phone -->



<!-- laptop -->

<div class="row section">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">Laptop</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/laptop') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listLaptop as $lap) { 

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $lap->id)

            $i++;

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if ($lap->video): ?>

                <div class="image">

                    <img src="<?php echo upload_image_url($lap->image_thumb); ?>" alt="<?php echo $lap->name; ?>" class="img-responsive">

                </div>

                <div class="video" id="<?php echo $lap->video ?>">

                </div>

            <?php else: ?>

                <div class="image-novideo">

                    <img src="<?php echo upload_image_url($lap->image_thumb); ?>" alt="<?php echo $lap->name; ?>" class="img-responsive">

                </div>

            <?php endif; ?>

            <div class="action row">

                <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 view-detail">

                  <a href="<?php echo base_url() . 'sanpham/'.$lap->id ?>">

                    <b class="fa fa-eye"></b> chi tiết</a>

                </div>

                <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $lap->id; ?>">

                  <a value="<?php echo base_url() . 'themgiohang/'.$lap->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                      <?php

                      if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                      else echo "Mua hàng";

                      ?>

                  </a>

              </div>

          </div>

          <div class="info">

            <p class="name">

              <?php echo $lap->name; ?>

          </p>

          <p class="price">

            <?php if (isset($lap->priceDiscount) && $lap->priceDiscount) echo $lap->priceDiscount; else echo $lap->priceVND; ?>

        </p>

    </div>

</div>

</div>



<?php } ?>



</div>

</div>

<!-- end-laptop -->



<!-- camera -->

<div class="row section">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">camera quan sát</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/camera-quan-sat') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listCamera as $camera) { 

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $camera->id)

            $i++;

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if ($camera->video): ?>

                <div class="image">

                    <img src="<?php echo upload_image_url($camera->image_thumb); ?>" alt="<?php echo $camera->name; ?>" class="img-responsive">

                </div>

                <div class="video" id="<?php echo $camera->video ?>">

                </div>

            <?php else: ?>

                <div class="image-novideo">

                    <img src="<?php echo upload_image_url($camera->image_thumb); ?>" alt="<?php echo $camera->name; ?>" class="img-responsive">

                </div>

            <?php endif; ?>

            <div class="action row">

                <div class="col-sm-6 col-lg-6 col-xs-6 view-detail">

                  <a href="<?php echo base_url() . 'sanpham/'.$camera->id ?>">

                    <b class="fa fa-eye"></b> chi tiết</a>

                </div>

                <div class="col-sm-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $camera->id; ?>">

                  <a value="<?php echo base_url() . 'themgiohang/'.$camera->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                      <?php

                      if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                      else echo "Mua hàng";

                      ?>

                  </a>

              </div>

          </div>

          <div class="info">

            <p class="name">

              <?php echo $camera->name; ?>

          </p>

          <p class="price">

            <?php if (isset($camera->priceDiscount) && $camera->priceDiscount) echo $camera->priceDiscount; else echo $camera->priceVND; ?>

        </p>

    </div>

</div>

</div>



<?php } ?>



</div>

</div>

<!-- end-camera -->



<!-- all-in-one -->

<div class="row section" id="all-in-one">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">all in one</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/all-in-one') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listAllInOne as $alo) { 

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $alo->id)

            $i++;

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if ($alo->video): ?>

              <div class="image">

                <img src="<?php echo upload_image_url($alo->image_thumb); ?>" alt="<?php echo $alo->name; ?>" class="img-responsive">

            </div>

            <div class="video" id="<?php echo $alo->video ?>">

            </div>

        <?php else: ?>

            <div class="image-video">

                <img src="<?php echo upload_image_url($alo->image_thumb); ?>" alt="<?php echo $alo->name; ?>" class="img-responsive">

            </div>

        <?php endif; ?>

        <div class="action row">

            <div class="col-sm-6 col-lg-6 col-xs-6 view-detail">

              <a href="<?php echo base_url() . 'sanpham/'.$alo->id ?>">

                <b class="fa fa-eye"></b> chi tiết</a>

            </div>

            <div class="col-sm-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $alo->id; ?>">

              <a value="<?php echo base_url() . 'themgiohang/'.$alo->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                  <?php

                  if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                  else echo "Mua hàng";

                  ?>

              </a>

          </div>

      </div>

      <div class="info">

        <p class="name">

          <?php echo $alo->name; ?>

      </p>

      <p class="price">

        <?php if (isset($alo->priceDiscount) && $alo->priceDiscount) echo $alo->priceDiscount; else echo $alo->priceVND; ?>

    </p>

</div>

</div>

</div>



<?php } ?>



</div>

</div>

<!-- end-all-in-one -->



<!-- máy-ảnh -->

<div class="row section" id="may-anh">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">Máy ảnh</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/may-anh') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listPhotograph as $photograph) { 

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $photograph->id)

            $i++;

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if ($photograph->video): ?>

            <div class="image">

                <img src="<?php echo upload_image_url($photograph->image_thumb); ?>" alt="<?php echo $photograph->name; ?>" class="img-responsive">

            </div>

            <div class="video" id="<?php echo $photograph->video ?>">

            </div>

        <?php else: ?>

            <div class="image-novideo">

                <img src="<?php echo upload_image_url($photograph->image_thumb); ?>" alt="<?php echo $photograph->name; ?>" class="img-responsive">

            </div>

        <?php endif; ?>

        <div class="action row">

            <div class="col-sm-6 col-lg-6 col-xs-6 view-detail">

              <a href="<?php echo base_url() . 'sanpham/'.$photograph->id ?>">

                <b class="fa fa-eye"></b> chi tiết</a>

            </div>

            <div class="col-sm-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $photograph->id; ?>">

              <a value="<?php echo base_url() . 'themgiohang/'.$photograph->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                  <?php



                  if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                  else echo "Mua hàng";

                  ?>

              </a>

          </div>

      </div>

      <div class="info">

        <p class="name">

          <?php echo $photograph->name; ?>

      </p>

      <p class="price">

        <?php if (isset($photograph->priceDiscount) && $photograph->priceDiscount) echo $photograph->priceDiscount; else echo $photograph->priceVND; ?>

    </p>

</div>

</div>

</div>



<?php } ?>



</div>

</div>

<!-- end-máy-ảnh -->



<!-- phụ-kiện -->

<div class="row section">

  <div class="section-title row">

    <div class="col-sm-6 col-lg-6 col-xs-6 text-left">

      <a href="" class="btn btn-link btn-title">Phụ kiện</a>

  </div>

  <div class="col-sm-6 col-lg-6 col-xs-6 text-right">

      <a href="<?php echo base_url('danhmucsanpham/phu-kien') ?>" class="btn btn-link btn-see-more">Xem tất cả</a>

  </div>

</div>

<div class="owl-carousel">



    <?php foreach($listAccessories as $ace) { 

      $i = 0;

      foreach($listProductInCart as $row)

      { 

        if($row['id'] == $ace->id)

            $i++;

    } 

    ?>



    <div class="product-item product-item-index text-center">

        <div class="inner">

            <?php if($ace->video): ?> 

              <div class="image">

                <img src="<?php echo upload_image_url($ace->image_thumb); ?>" alt="<?php echo $ace->name; ?>" class="img-responsive">

            </div>

            <div class="video" id="<?php echo $ace->video ?>">

            </div>

        <?php else: ?>

            <div class="image-novideo">

                <img src="<?php echo upload_image_url($ace->image_thumb); ?>" alt="<?php echo $ace->name; ?>" class="img-responsive">

            </div>

        <?php endif; ?>

        <div class="action row">

            <div class="col-sm-6 col-lg-6 col-xs-6 view-detail">

              <a href="<?php echo base_url() . 'sanpham/'.$ace->id ?>">

                <b class="fa fa-eye"></b> chi tiết</a>

            </div>

            <div class="col-sm-6 col-lg-6 col-xs-6 add-to-cart product<?php echo $ace->id; ?>">

              <a value="<?php echo base_url() . 'themgiohang/'.$ace->id; ?>" class="btn-add buyProduct <?php if($i != 0) echo 'bought'; ?>">

                  <?php

                  if($i != 0)echo "Đã mua <i class='fa fa-check fa-1x' aria-hidden='true'></i>";

                  else echo "Mua hàng";

                  ?>

              </a>

          </div>

      </div>

      <div class="info">

        <p class="name">

          <?php echo $ace->name; ?>

      </p>

      <p class="price">

        <?php if (isset($ace->priceDiscount) && $ace->priceDiscount) echo $ace->priceDiscount; else echo $ace->priceVND; ?>

    </p>

</div>

</div>

</div>



<?php } ?>



</div>

</div>

<!-- end-phụ-kiện -->







</div>

<script>

$(document).ready(function() {

    mediaSize();

     window.addEventListener('resize', mediaSize, false);

});

function mediaSize() {



    if (window.matchMedia('(max-width: 768px)').matches) {

        $('#news').hide();

        $('#all-in-one').hide();

        $('#may-anh').hide();

        $('#footer-news').hide();

        $('#footer-product').hide();

        $('.about-us').hide();

        $('#map').hide();

    } else {

        $('#news').show();

        

    }

};









</script>