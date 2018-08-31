<div class="col-sm-9 content order-detail">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">Copyright</h3>

        </div>

        <div class="panel-body" style="padding-top: 10px">

            <?php 

            if ($message)

                echo $message;

            ?>

            <!-- form -->

            <form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">

                <!-- địa chỉ -->

                <div class="form-group">

                    <label class="control-label col-sm-4" for="email">Địa chỉ: </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="address" id="email" placeholder="Nhập địa chỉ" value="<?php echo $info->address; ?>">

                        <div class="error-form">

                            <?php echo form_error("address");?>

                        </div>

                    </div>

                </div>



                <!-- Điện thoại -->

                <div class="form-group">

                    <label class="control-label col-sm-4" for="email">Điện thoại: </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="phone" id="email" placeholder="Nhập số điện thoại" value="<?php echo $info->phone; ?>">

                        <div class="error-form">

                            <?php echo form_error("phone");?>

                        </div>

                    </div>

                </div>



                <!-- Fax -->

                <div class="form-group">

                    <label class="control-label col-sm-4" for="email">Fax: </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="fax" id="email" placeholder="Nhập địa chỉ fax" value="<?php echo $info->fax; ?>">

                        <div class="error-form">

                            <?php echo form_error("fax");?>

                        </div>

                    </div>

                </div>



                <!-- Hotline -->

                <div class="form-group">

                    <label class="control-label col-sm-4" for="email">Hotline: </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="hotline" id="email" placeholder="Nhập hotline" value="<?php echo $info->hotline; ?>">

                        <div class="error-form">

                            <?php echo form_error("hotline");?>

                        </div>

                    </div>

                </div>



                <!-- Email -->

                <div class="form-group">

                    <label class="control-label col-sm-4" for="email">Email: </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="email" id="email" placeholder="Nhập email" value="<?php echo $info->email; ?>">

                        <div class="error-form">

                            <?php echo form_error("email");?>

                        </div>

                    </div>

                </div>



                <!-- Youtube  -->

                <div class="form-group">

                    <label class="control-label col-sm-4">Youtube : </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="youtube" id="email" placeholder="Nhập địa chỉ chanel" value="<?php echo $info->youtube; ?>">

                        <div class="error-form">

                            <?php echo form_error("youtube");?>

                        </div>

                    </div>

                </div>



                <!-- Facebook  -->

                <div class="form-group">

                    <label class="control-label col-sm-4">Facebook : </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="facebook" id="email" placeholder="Nhập địa chỉ fanpage" value="<?php echo $info->facebook; ?>">

                        <div class="error-form">

                            <?php echo form_error("facebook");?>

                        </div>

                    </div>

                </div>



                <!-- Instagram  -->

                <div class="form-group">

                    <label class="control-label col-sm-4">Instagram : </label>

                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="instagram" id="email" placeholder="Nhập địa chỉ instagram" value="<?php echo $info->instagram; ?>">

                        <div class="error-form">

                            <?php echo form_error("instagram");?>

                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Logo : </label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="logo">

                        <span class="note-input">Chỉ chọn 1 hình. Kích thước nên sử dụng 200x40, nên sử dụng dạng file png, Dung lượng tối đa 10MB.</span>

                        <div class="error-form"><?php echo form_error('logo') ?></div>


                        <div style="margin-bottom: 65px ">
                            
                               <img src="<?php echo upload_image_url($image->name) ?>" height="200" width="200">
                          
                       </div>
                   </div>
               </div>



               <div class="form-group">

                <div class="text-center col-sm-6 col-sm-offset-4">

                    <button type="submit" class="btn btn-success btn-block">

                        <b class="fa fa-floppy-o"></b> Lưu

                    </button>

                </div>

            </div>



        </form>

        <!-- end-form -->

    </div>

</div>

</div>