<div class="col-sm-4 col-sm-offset-4 content order-detail" style="margin-top: 100px">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Quên mật khẩu</h3>
                </div>
                <?php
                if (isset($successRest)) {
                    echo $successRest;
                    
                }
                 ?>
                <div class="panel-body" style="padding-top: 10px">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Email: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" placeholder="Nhập email của bạn !" name="email">
                            </div>
                        </div>

                        
                        <div class="error-form"><?php echo validation_errors(); ?></div>
                        
                        <div class="form-group">
                            <div class="col-sm-8 ">
                                <button type="submit" class="btn btn-info btn-block">Lấy lại mật khẩu</button>
                            </div>
                             <div class="col-sm-4 ">
                                <a href="<?php echo admin_url('login') ?>" class="btn btn-success btn-block">Trở về trang chủ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>