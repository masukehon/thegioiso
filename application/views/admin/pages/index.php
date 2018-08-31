<div class="col-sm-9 content index">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">Tổng quan</h3>

        </div>

        <div class="panel-body">

            <?php if ($role1): ?>

                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('nhanvien') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #d35400">

                            <b class="fa fa-user-circle-o"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #e67e22">

                            <div class="row">Nhân viên</div>

                            <div class="row"><?php echo $totalAdmin ?></div>

                        </div>

                    </a>

                </div>

            <?php endif; ?>

            <?php if ($role1): ?>

                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('donhang') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #2980b9">

                            <b class="fa fa-file-text"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #3498db">

                            <div class="row">đơn hàng</div>

                            <div class="row"><?php echo $totalOrder ?></div>

                        </div>

                    </a>

                </div>

            <?php endif; ?>

            <?php if ($role12): ?>

                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('danhmucsanpham') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #27ae60">

                            <b class="fa fa-building-o"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #2ecc71">

                            <div class="row">Danh mục sản phẩm</div>

                            <div class="row"><?php echo $totalCategoryProduct ?></div>

                        </div>

                    </a>

                </div>



                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('sanpham') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #c0392b">

                            <b class="fa fa-cubes"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #e74c3c">

                            <div class="row">sản phẩm</div>

                            <div class="row"><?php echo $totalProduct ?></div>

                        </div>

                    </a>

                </div>

            <?php endif; ?>



            <?php if ($role13): ?>

                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('danhmuctintuc') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #8e44ad">

                            <b class="fa fa-building"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #9b59b6">

                            <div class="row">Danh mục tin tức</div>

                            <div class="row"><?php echo $totalCategoryNews ?></div>

                        </div>

                    </a>

                </div>



                <div class="col-sm-6 text-center item">

                    <a href="<?php echo admin_url('tintuc') ?>" class="col-sm-10 col-sm-offset-1 inner">

                        <div class="col-sm-4 icon" style="background-color: #f39c12">

                            <b class="fa fa-newspaper-o"></b>

                        </div>

                        <div class="col-sm-8 name" style="background-color: #f1c40f">

                            <div class="row">tin tức</div>

                            <div class="row"><?php echo $totalNews; ?></div>

                        </div>

                    </a>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

