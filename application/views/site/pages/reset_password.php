<div class="col-sm-4 col-sm-offset-4 content order-detail" style="margin-top: 100px">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Tạo mật khẩu mới
                    </h3>
                </div>
                <?php
                if (isset($successPass)) {

                    echo $successPass;
                }

                 ?>
                <div class="panel-body" style="padding-top: 10px">
                    <form action="" class="form-horizontal" method="post">

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="">Mật khẩu: </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="" placeholder="" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="">Xác nhận mật khẩu: </label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="" placeholder="" name="prepassword">
                            </div>
                        </div>
                        <div class="error-form"><?php echo validation_errors(); ?></div>
                        
                        <div class="form-group">
                            <div class="col-sm-8 ">
                                <button type="submit" class="btn btn-info btn-block">Xác nhận</button>
                            </div>
                            <div class="col-sm-4 ">
                                <a href="<?php echo admin_url('login') ?>"  class="btn btn-success btn-block">Vào trang đăng nhập</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>