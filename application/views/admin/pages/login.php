<div class="col-sm-4 col-sm-offset-4 content order-detail" style="margin-top: 100px">

            <div class="panel panel-success">

                <div class="panel-heading">

                    <h3 class="panel-title">Đăng nhập</h3>

                </div>

                <div class="panel-body" style="padding-top: 10px">

                    <form action="" class="form-horizontal" method="post">

                        <div class="form-group">

                            <label class="control-label col-sm-3" for="email">Email: </label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="email" placeholder="" name="email">

                            </div>

                        </div>



                        <div class="form-group">

                            <label class="control-label col-sm-3" for="email">Mật khẩu: </label>

                            <div class="col-sm-8">

                                <input type="password" class="form-control" id="email" placeholder="" name="password">

                            </div>

                        </div>

                        <div class="error-form"><?php echo form_error('login'); ?></div>

                        

                        <div class="form-group">

                            <div class="col-sm-8 col-sm-offset-3">

                                <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>

                            </div>

                        </div>



                        <div class="text-right">

                            <a href="<?php echo base_url().'quenmatkhau' ?>" class="btn btn-link">Quên mật khẩu.</a>
                            
                            
                        </div>

                    </form>

                </div>

            </div>

        </div>