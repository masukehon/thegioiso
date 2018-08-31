 <div class="col-sm-9 content category-product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Thay đổi mật khẩu</h3>
        </div>
        <div class="panel-body">
                <?php if ($message){
                    echo $message;                    
                } ?>
            <div class="col-sm-12" style="margin-top: 10px">
                <!-- form -->
                <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
                    <!-- tiêu đề -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Mật khẩu hiện tại: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="oldpass" id="email">
                            <div class="error-form">
                                <?php echo form_error("oldpass") ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Mật khẩu mới: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="newpass" id="email">
                            <div class="error-form">
                                <?php echo form_error("newpass") ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Nhập lại mật khẩu mới: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="renewpass" id="email">
                            <div class="error-form">
                                <?php echo form_error("renewpass") ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">
                                <b class="fa fa-plus-circle"></b> Xác nhận
                            </button>
                        </div>
                    </div>

                </form>
                <!-- end-form -->
            </div>
        </div>
    </div>
</div>