<div class="col-sm-9 content category-product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm video slider</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <?php if ($message){
                    echo $message;                    
                } ?>
                <!-- form -->
                <form class="form-horizontal" action="" method="POST">
                    <!-- tiêu đề -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Tiêu đề: </label>
                        <div class="col-sm-6">
                            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề" value="<?php echo set_value('title') ?>">
                            <div class="error-form">
                                <?php echo form_error("title") ?>
                            </div>
                        </div>
                    </div>
                    <!-- nội dung tóm tắt -->
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Đường dẫn video (link): </label>
                        <div class="col-sm-6">
                        Example: https://www.youtube.com/watch?v=7spBkzzFUto chỉ nhập dãy chữ và số ở sau cùng là: <b>7spBkzzFUto</b>
                            <input type="text" name="video" class="form-control" placeholder="" value="<?php echo set_value('video') ?>">
                            <div class="error-form">
                                <?php
                                echo form_error("video"); ?>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6 checkbox">
                            <input type="checkbox" checked name="is_show"> Hiển thị.
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">
                                <b class="fa fa-plus-circle"></b> Thêm
                            </button>
                        </div>
                    </div>


                </form>

                <!-- end-form -->
            </div>
        </div>
    </div>
</div>
