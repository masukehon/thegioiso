<!-- menu -->



<div class="menu">

    <nav class="navbar navbar-default" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header" style="height: 75px">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <?php

            $this->ci = & get_instance();

            $this->ci->load->model('logo_model');

            $logo = $this->ci->logo_model->get_row();

            ?>

            <a class="navbar-brand" href="<?php echo base_url(); ?>" class="logo">

               <img src="<?php echo upload_image_url($logo->name) ?>" width=200 height=60>

               

           </a>

           <div class="col-sm-4 col-xs-12 custom-xs-5 ">

            <form class="form-search" role="search" action="<?php echo base_url('/search') ?>" method="GET">

                <div class="input-group">

                    <input type="text" class="form-control" placeholder="Nhập từ khóa cần tìm" name="key" id="search" autocomplete="off" required>



                    <div class="input-group-btn">

                        <button class="btn btn-default" type="submit">

                            <i class="glyphicon glyphicon-search"></i>

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <?php

        $this->ci = & get_instance();

        $this->ci->load->model('copyright_model');

        $copyright = $this->ci->copyright_model->get_info(1);



        ?>

        <div class="col-sm-5 address-menu" style="margin-top: 15px">

            <div class="col-sm-9" style="margin: 0; padding: 0"><p class="pull-right" style="color: #fd6500; font-size: 14px"><b class="fa fa-map-marker fa-2x"></b> <?php echo $copyright->address; ?></p></div>

            <div class="col-sm-3" style="margin: 0; padding: 0"><p class="pull-right" style="color: #fd6500; font-size: 14px"><b class="fa fa-phone-square fa-2x"></b> <?php echo $copyright->phone; ?></p></div>

        </div>

        

    </div>





    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse navbar-ex1-collapse  flex-menu">

     

        <ul class="nav navbar-nav">

           <li class="<?php echo $url == '' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url() ?>">

                <i class="icon-navbar fa fa-home"></i>

                <br>

                <span>Trang chủ</span>

            </a>

        </li>



        <li class="<?php echo $url == 'dien-thoai' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/dien-thoai'); ?>">

                <i class="icon-navbar fa fa-mobile"></i>

                <br>

                <span>ĐIỆN THOẠI </span>

            </a>

        </li>



        <li class="<?php echo $url == 'laptop' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/laptop'); ?>">

                <i class="icon-navbar fa fa-laptop"></i>

                <br>

                <span>LAPTOP </span>

            </a>

        </li>

        <li class="<?php echo $url == 'camera-quan-sat' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/camera-quan-sat'); ?>">

                <i class="icon-navbar fa fa-video-camera"></i>

                <br>

                <span> CAMERA quan sát</span>

            </a>

        </li>

        <li class="<?php echo $url == 'all-in-one' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/all-in-one'); ?>">

                <i class="icon-navbar fa fa-desktop"></i>

                <br>

                <span>ALL IN ONE </span>

            </a>

        </li>

        <li class="<?php echo $url == 'may-anh' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/may-anh'); ?>">

                <i class="icon-navbar fa fa-camera"></i>

                <br>

                <span>Máy ảnh </span>

            </a>

        </li>

        <li class="<?php echo $url == 'phu-kien' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/phu-kien'); ?>">

                <i class="icon-navbar fa fa-headphones"></i>

                <br>

                <span>Phụ KIỆN </span>

            </a>

        </li>

        <li class="<?php echo $url == 'beats' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('danhmucsanpham/beats'); ?>">

                <i class="icon-navbar fa fa-bold"></i>

                <br>

                <span>Beats</span>

            </a>

        </li>

        

        <li class="<?php echo $url == 'tintuc' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('tintuc'); ?>">

                <i class="icon-navbar fa fa-newspaper-o"></i>

                <br>

                <span> tin tức </span>

            </a>

        </li>

        <li class="<?php echo $url == 'bang-gia' ? 'active' : '' ?>">

            <a class="text-center" href="<?php echo base_url('bang-gia'); ?>">

                <i class="icon-navbar fa fa-book"></i>

                <br>

                <span>bảng giá </span>

            </a>

        </li>

    </ul>

</div>

<!-- /.navbar-collapse -->

</nav>

</div>

<!-- end-menu -->