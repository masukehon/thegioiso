<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thế Giới Số</title>

    <!-- CSS vender -->
    <link href="<?php echo public_url(); ?>/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo public_url(); ?>/css/vendor/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo public_url(); ?>/css/vendor/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo public_url(); ?>/css/vendor/font-awesome.min.css" rel="stylesheet">
    
    <!-- CSS custom -->
    <link href="<?php echo public_url(); ?>/css/bundle.min.css" rel="stylesheet">
    <!-- <link href="<?php echo public_url(); ?>/css/reponsive.css" rel="stylesheet"> -->
    
    <!-- JS vender -->
    <script src="<?php echo public_url(); ?>/js/vendor/jquery.min.js"></script>

    <!-- GG font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet">

    <!--[if lt IE 9]>
       <script src="js/html5shiv.js"></script>
       <script src="js/respond.min.js"></script>
   <![endif]-->
</head>

<body>
    <div id="top"></div>
    <div class="wrapper">
        <!-- menu -->
        <?php $this->load->view('site/menu'); ?>
        <!-- menu -->
        <!-- cart -->
        <a class="cart" href="<?php echo base_url() . 'giohang' ?>">
          <b class="fa fa-shopping-cart" style="margin-right: 0px"></b><span class="badge" style="">0</span>
      </a>
      <!-- end-cart -->
      <!-- back-to-top -->
      <div class="back-to-top text-center">
        <b class="fa fa-arrow-up"></b>
    </div>
    <!-- end-back-to-top -->

    <!-- search -->
    <div class="search col-sm-7 col-xs-12">
        <div class="text-center loading-search">
            <div class="loader"></div>
            Đang tìm kiếm kết quả ..
        </div>
        <div class="text-center fail-result">
            <p><b class="fa fa-ban"></b> Xin lỗi! Không tìm thấy kết quả phù hợp.</p>
        </div>
        <div class="result">
            <div class="col-sm-6 col-xs-12 result-product">
                <div class="result-title">Sản phẩm</div>
                <div class="product-list">
                </div>
                <div class="text-center product-remain">
                </div>
                <div class="text-center result-none-product">
                    <p><b class="fa fa-ban"></b>Không tìm thấy kết quả.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 result-news">
                <div class="result-title">Tin tức</div>
                <div class="news-list">
                </div>
                <div class="text-center news-remain"></div>
                <div class="text-center result-none-news">
                    <p><b class="fa fa-ban"></b>Không tìm thấy kết quả.</p>
                </div>
            </div>
            <div class="col-sm-12 text-center see-more-result" style="display: none;">
                <a href="" class="btn-see-more">Xem thêm kết quả</a>
            </div>
        </div>
        
    </div>
    <!-- end-search -->

    <!-- content -->
    <?php $this->load->view($page); ?>
    <!-- end-content -->
    <!-- footer -->
    <?php $this->load->view('site/footer'); ?>
    <!-- end-footer -->
</div>
<!-- JS vender -->

<script src="<?php echo public_url(); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo public_url(); ?>/js/vendor/owl.carousel.min.js"></script>

<!-- CSS custom -->
<script src="<?php echo public_url(); ?>/js/custom.js"></script>
</body>

</html>