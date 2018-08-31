<div class="col-sm-9 content category-product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Cập nhật thông tin</h3>
        </div>
        <div class="panel-body">
            <?php if ($message)
                 echo $message;
                ?>
            <div class="col-sm-12" style="margin-top: 10px">
                <!-- form -->
                <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
                    <!-- tiêu đề -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Họ Tên: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" id="email" placeholder="Họ tên cá nhân" value="<?php echo $info->fullname; ?>">
                            <div class="error-form">
                                <?php echo form_error("name"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Số Điện Thoại: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone" id="email" placeholder="Số điện thoại liên lạc" value="<?php echo $info->phone; ?>">
                            <div class="error-form">
                                <?php echo form_error("phone"); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button href="" type="submit" class="btn btn-success btn-block">
                                <b class="fa fa-plus-circle"></b> Lưu
                            </button>
                        </div>
                    </div>

                </form>
                <!-- end-form -->
            </div>
        </div>
    </div>
</div>