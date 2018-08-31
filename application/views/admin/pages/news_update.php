<div class="col-sm-9 content category-product">



    <div class="panel panel-success">



        <div class="panel-heading">



            <h3 class="panel-title">Sửa tin tức</h3>



        </div>



        <div class="panel-body">



            <div class="col-sm-12" style="margin-top: 10px">



                <?php if ($message){



                    echo $message;                    



                } ?>



                <!-- form -->



                <form class="form-horizontal" action="" enctype="multipart/form-data" method="POST">



                    <!-- tiêu đề -->



                    <div class="form-group">



                        <label class="control-label col-sm-4" for="email">Tiêu đề: </label>



                        <div class="col-sm-6">



                            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề" value="<?php echo $data->name; ?>">



                            <div class="error-form">



                                <?php



                                $this->load->library("form_validation");



                                echo form_error("title"); ?>



                            </div>



                        </div>



                    </div>



                    <!-- nội dung tóm tắt -->



                    <div class="form-group">



                        <label class="control-label col-sm-4" for="email">Nội dung tóm tắt: </label>



                        <div class="col-sm-6">



                            <input type="text" name="describes" class="form-control" placeholder="" value="<?php echo $data->describes; ?>">



                            <div class="error-form">



                                <?php



                                echo form_error("describes"); ?>



                            </div>



                        </div>



                    </div>



                    <!-- danh mục tin tức -->



                    <div class="form-group">



                        <label for="sel1" class="control-label col-sm-4">Danh mục tin tức: </label>



                        <div class="col-sm-6">



                            <select name="OptionCategoryNews" class="form-control" value="">



                                <?php



                                foreach($categoryNews as $row)



                                {



                                    ?>



                                    <option value="<?php echo $row->id?>" <?php 



                                     echo $row->id == $data->id_category ? 'selected' : '';



                                     ?> ><?php echo $row->name?></option>



                                    <?php } ?>



                                </select>



                            </div>



                        </div>



                        <!-- hình ảnh -->



                        <div class="form-group">



                            <label class="control-label col-sm-4" for="email">Hình ảnh (chọn nhiều hình): </label>



                            <div class="col-sm-6">



                                <input type="file" class="form-control" name="image" id="email" placeholder="Nhập giá (chỉ nhập số)">



                                <span class="note-input">Giữ ctrl để chọn nhiều hình cùng lúc.</span>



                                <div class="col-sm-6 col-sm-offset-3">



                                <img src="<?php echo upload_image_url($data->image) ?>" alt="" class="img-responsive">



                            </div>



                            </div>



                        </div>



                        <!-- Nội dung -->



                        <div class="form-group">



                            <label class="control-label col-sm-4" for="email">Nội dung: </label>



                            <div class="col-sm-6">



                                <textarea class="ckeditor" name="content" id="" ><?php echo $data->content; ?></textarea>



                                <div class="error-form">



                                    <?php



                                    echo form_error("content"); ?>



                                </div>



                            </div>



                        </div>

                        

                        <div class="form-group">



                            <div class="col-sm-offset-4 col-sm-6 checkbox">



                                <input type="checkbox" <?php if($data->is_show)echo "checked";?> value="1" name="is_show"> Hiển thị.



                            </div>



                        </div>





                        <div class="form-group">



                            <div class="col-sm-offset-4 col-sm-6">



                                <button type="submit" class="btn btn-success btn-block">



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



    <script>



        CKEDITOR.replace('content');



    </script>