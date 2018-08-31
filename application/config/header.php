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
            <a class="navbar-brand" href="<?php echo admin_url('home') ?>" class="logo">
                <span>THẾ GIỚI SỐ</span>
                <br>
                <span>SÂN CHƠI CÔNG NGHỆ CỦA BẠN</span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php if ($this->session->userdata('id_role') == 1): ?>
            <ul class="nav navbar-nav navbar-left">
                <li class="active">
                    <a class="text-center" href="#">
                        <i class="icon-navbar fa fa-envelope"></i>
                        <br>
                        <span>1 đơn hàng mới<?php echo $this->session->userdata('id_role'); ?></span>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="text-center" href="#">
                        <i class="icon-navbar fa fa-user-o"></i>
                        <br>
                        <span><?php echo $this->session->userdata('name'); ?></span>
                    </a>
                </li>
                <li>
                    <a class="text-center" href="<?php echo admin_url('logout'); ?>">
                        <i class="icon-navbar fa fa-sign-out"></i>
                        <br>
                        <span>đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>