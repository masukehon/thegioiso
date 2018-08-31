<div class="col-sm-3 sidebar">
    <!-- product -->

<?php if ($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2): ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí sản phẩm</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('danhmucsanpham') ?>">Danh mục sản phẩm</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('sanpham') ?>">Sản phẩm</a>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- end-product -->
    <!-- news -->
<?php if ($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 3): ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí tin tức</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('danhmuctintuc') ?>">Danh mục Tin tức</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('tintuc') ?>">Tin tức</a>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- end-news -->

<?php if ($this->session->userdata('id_role') == 1): ?>
    <!-- member -->
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí nhân sự</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('nhanvien') ?>">Nhân viên</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('quanlihoatdong') ?>">Quản lý hoạt động</a>
            </div>
        </div>
    </div>
    <!-- end-member -->
    <!-- order -->
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí đơn hàng</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('donhang') ?>">đơn đặt hàng</a>
            </div>
        </div>
    </div>
    <!-- end-order -->
    <!-- info -->
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí thông tin</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('gioithieu') ?>">Giới thiệu</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('copyright') ?>">Copyright</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('dichvu') ?>">Dịch vụ</a>
            </div>
            
        </div>
    </div>
    <!-- end-info -->
    <!-- video -->
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí video</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('slider') ?>">Video slider</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('videonoibat') ?>">Video nổi bật</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('videosanpham') ?>">Video sản phẩm trang chủ</a>
            </div>
        </div>
    </div>
    <!-- end-video -->
    <?php endif; ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Cá nhân</h3>
        </div>
        <div class="panel-body">
            <div class="item">
                <a href="<?php echo admin_url('thongtin') ?>">thông tin</a>
            </div>
            <div class="item">
                <a href="<?php echo admin_url('doimatkhau') ?>">Đổi mật khẩu</a>
            </div>
        </div>
    </div>
</div>