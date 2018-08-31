<div class="col-sm-9 content product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Thông tin cá nhân</h3>
        </div>
        <div class="panel-body">
            <?php if ($message)
                    echo $message;
            ?>
            <div class="col-sm-12" style="margin-top: 10px">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="alert alert-info" style="font-size: 20px">
                        <p><b>Email:</b> <?php echo $info->email; ?></p> 
                        <p><b>Quyền Hạn:</b> <?php echo $info->roleName; ?> </p>
                        <p><b>Họ Tên:</b> <?php echo $info->fullname; ?> </p>
                        <p><b>Điện Thoại</b> <?php echo $info->phone; ?> </p>
                        
                    </div>
                </div>
                <!-- btn -->
                <div class="col-sm-12 text-center">
                    <a class="btn btn-primary" href=" <?php echo admin_url('capnhatthongtin') ?> ">
                        <b class="fa fa-plus-circle"></b> Cập nhật thông tin</a>
                    </div>
                    <!-- end-btn -->
                </div>
            </div>
        </div>
    </div>