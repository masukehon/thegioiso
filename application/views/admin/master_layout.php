<!DOCTYPE html>



<html lang="en">



<head>



    <meta charset="utf-8">



    <meta name="viewport" content="width=device-width, initial-scale=1">



    <meta name="description" content="">



    <meta name="author" content="">



    <title>Thế Giới Số</title>



    <script src="<?php echo public_url(); ?>js/vendor/jquery.min.js"></script>



    <script src="<?php echo public_url(); ?>js/vendor/jquery-confirm.js"></script>

    

    <script src="<?php echo public_url(); ?>js/admin-custom.js"></script>



    <!-- CSS vender -->



    <link href="<?php echo public_url(); ?>css/vendor/bootstrap.min.css" rel="stylesheet">



    <link href="<?php echo public_url(); ?>css/vendor/jquery-confirm.css" rel="stylesheet">

    <!-- CSS custom -->



    <link href="<?php echo public_url(); ?>css/admin-custom.css" rel="stylesheet">



    <!--[if lt IE 9]>



       <script src="js/html5shiv.js"></script>



       <script src="js/respond.min.js"></script>



   <![endif]-->



</head>





<body>

    <div id="top"></div>

    <div class="alert-message">test</div>

    <div class="wrapper">



        <!-- menu -->



        <?php $this->load->view('admin/header'); ?>



        <!-- end-menu -->







        <!-- back-to-top -->



        <div class="back-to-top text-center">



            <b class="fa fa-caret-up"></b>



        </div>



        <!-- end-back-to-top -->







        <div class="container-fluid">



            <!-- sidebar -->



            <?php $this->load->view('admin/sidebar'); ?>



            <!-- end-sidebar -->



            <!-- content -->



            <?php $this->load->view($page); ?>



            <!-- end-content -->



            



        </div>



    </div>



    <!-- JS vender -->







    <script src="<?php echo public_url(); ?>js/vendor/bootstrap.min.js"></script>



    <script src="https://use.fontawesome.com/b7adafb658.js"></script>



    <script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>







    <!-- js custom -->



    



</body>



</html>