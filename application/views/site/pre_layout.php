<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>Thế Giới Số</title>



    <!-- CSS vender -->

    <!-- <link href="../css/vendor/reset.css" rel="stylesheet"> -->

    <link href="<?php echo public_url(); ?>css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="<?php echo public_url(); ?>css/vendor/animate.min.css" rel="stylesheet"> -->

    <!-- <link href="<?php echo public_url(); ?>css/vendor/owl.theme.default.min.css" rel="stylesheet"> -->



    <!-- CSS custom -->

    <link href="<?php echo public_url(); ?>css/admin-custom.css" rel="stylesheet">



    <!-- JS vender -->

    <script src="<?php echo public_url(); ?>js/vendor/jquery.min.js"></script>

    <script src="<?php echo public_url(); ?>js/vendor/bootstrap.min.js"></script>

    <script src="https://use.fontawesome.com/b7adafb658.js"></script>

    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>



    <!-- js custom -->

    <script src="<?php echo public_url(); ?>js/admin-custom.js"></script>



    <!-- GG font -->

    <!-- <link href="//fonts.googleapis.com/css?family=Lora:700" rel="stylesheet"> -->

    <!-- <link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed" rel="stylesheet"> -->



    <!--[if lt IE 9]>

       <script src="js/html5shiv.js"></script>

       <script src="js/respond.min.js"></script>

     <![endif]-->

</head>



<body>

    <div class="wrapper">

        <!-- menu -->

        <div class="menu">

    <nav class="navbar navbar-default" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="<?php echo base_url() ?>admin" class="logo">

                <span>THẾ GIỚI SỐ</span>

                <br>

                <span>SÂN CHƠI CÔNG NGHỆ CỦA BẠN</span>

            </a>

        </div>



        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse navbar-ex1-collapse">

            

            <ul class="nav navbar-nav navbar-right">

                

                <li>

                    <a class="text-center" href="<?php echo base_url() ?>">

                        <i class="icon-navbar fa fa-sign-out"></i>

                        <br>

                        <span>Về trang chủ</span>

                    </a>

                </li>

            </ul>

        </div>

        <!-- /.navbar-collapse -->

    </nav>

</div>

        <!-- end-menu -->



        <!-- form -->

        <?php $this->load->view($page); ?>

        <!-- end-form -->

    </div>









    <!-- back-to-top -->

    <div class="back-to-top text-center">

        <b class="fa fa-caret-up"></b>

    </div>

    <!-- end-back-to-top -->





    </div>

</body>



</html>