<div class="col-sm-9 content category-product">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">Sản phẩm</h3>

        </div>

        <div class="panel-body">

            <div class="col-sm-12" style="margin-top: 10px">

                <div class="text-right" style="margin-bottom: 15px">

                    <a class="btn btn-primary btn-lg" href="<?php echo admin_url('sanpham') ?>">Danh sách sản phẩm</a>

                </div>

                <?php 

                if ($this->session->flashdata('message')) {

                    echo $this->session->flashdata('message');

                }

                 ?>

                <!-- form -->

                <form class="form-horizontal" enctype="multipart/form-data" method="POST">

                    <!-- tên sản phẩm -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="name">Tên sản phẩm: </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="<?php echo set_value('name') ?>">

                            <div class="error-form"><?php echo form_error('name') ?></div>

                        </div>

                    </div>

                    <!-- hien thi -->

                    <div class="form-group">

                        <div class="col-sm-offset-4 col-sm-6 checkbox">

                            <label><input type="checkbox" checked value="1" name="is_show"> Hiển thị.</label>

                        </div>

                    </div>

                    <?php if($role1): ?>

                    <!-- noi bat -->

                    <div class="form-group">

                        <div class="col-sm-offset-4 col-sm-6 checkbox">

                            <label><input type="checkbox" value="1" name="is_highlight"> Video nổi bật.</label>

                        </div>

                    </div>

                    <!-- show index -->

                    <div class="form-group">

                        <div class="col-sm-offset-4 col-sm-6 checkbox">

                            <label><input type="checkbox" value="1" name="show_in_index"> Đăt ở trang chủ.</label>

                        </div>

                    </div>

                <?php endif; ?>

                    <!-- danh mục cap 1 -->

                    <div class="form-group">

                        <label for="sel1" class="control-label col-sm-4">Danh mục cấp 1: </label>

                        <div class="col-sm-6">

                            <select class="form-control" style="text-transform: uppercase;" name="id_parent_category" id="parent_category">

                                <?php foreach($categoryParentList as $category): ?>

                                    <option style="text-transform: uppercase;" value="<?php echo $category->id ?>"

                                    >

                                    <?php echo $category->name ?>

                                        

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <!-- danh mục cấp 2 -->

                    <div class="form-group">

                        <label for="sel1" class="control-label col-sm-4">Danh mục cấp 2: </label>

                        <div class="col-sm-6">

                            <select class="form-control" style="text-transform: uppercase;" name="id_parent_category_2" id="parent_category_2">

                            </select>

                        </div>

                        <div class="col-sm-1"><a href="<?php echo admin_url('danhmucsanpham/them') ?>" class="btn btn-success">Thêm mới</a></div>

                    </div>

                    <!-- danh mục cấp 3 -->

                    <div class="form-group">

                        <label for="sel1" class="control-label col-sm-4">Danh mục cấp 3: </label>

                        <div class="col-sm-6">

                            <select class="form-control" style="text-transform: uppercase;" name="id_category" id="category">

                            </select>

                        </div>

                        <div class="col-sm-1"><a href="<?php echo admin_url('danhmucsanpham/them') ?>" class="btn btn-success">Thêm mới</a></div>

                    </div>

                    <!-- màn hình -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Màn hình (đối với điện thoại, laptop): </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="screen" name="screen" placeholder="Nhập số (đơn vị inch)" value="<?php echo set_value('screen') ?>">

                            <div class="error-form"><?php echo form_error('screen') ?></div>

                        </div>

                    </div>

                    <!-- Lens -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Lens (đối với máy ảnh): </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="lens" name="lens" placeholder="Nhập  số (đơn vị mm)" value="<?php echo set_value('lens') ?>">

                            <div class="error-form"><?php echo form_error('lens') ?></div>

                        </div>

                    </div>

                    <!-- giá sản phẩm -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Giá sản phẩm: </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá (chỉ nhập số)" value="<?php echo set_value('price') ?>">

                            <div class="error-form"><?php echo form_error('price') ?></div>

                        </div>

                    </div>

                    <!--giảm giá sản phẩm -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Giảm giá: </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Nhập số tiền giảm giá (chỉ nhập số)" value="<?php echo set_value('discount') ?>">

                            <div class="error-form"><?php echo form_error('discount') ?></div>

                        </div>

                    </div>

                    

                    <!-- hình ảnh -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Hình ảnh (hình đại diện, hình lớn): </label>

                        <div class="col-sm-6">

                            <input type="file" class="form-control" placeholder="Nhập giá (chỉ nhập số)" name="image">

                            <span class="note-input">Chỉ chọn 1 hình. Kích thước tối đa 3000x1500; tối thiểu 500x500, dạng file .jpg,.png; Dung lượng tối đa 10MB.</span>

                            <div class="error-form"><?php echo form_error('image') ?></div>

                        </div>

                    </div>

                    <!-- hình ảnh nho-->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Danh sách hình nhỏ (hình chi tiết): </label>

                        <div class="col-sm-6">

                            <input type="file" class="form-control" id="email" placeholder="Nhập giá (chỉ nhập số)" multiple name="image_list[]">

                            <span class="note-input">Chọn nhiều hình. Giữ ctrl để chọn nhiều hình cùng lúc. Kích thước tối đa 3000x1500, dung lượng tối đa 10MB.</span>

                            <div class="error-form"><?php echo form_error('image_list') ?></div>

                        </div>

                    </div>

                    <!--video -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Video (ID video youtube): </label>

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="discount" name="video" placeholder="" value="<?php echo set_value('video') ?>">

                            <div class="error-form"><?php echo form_error('video') ?></div>

                        </div>

                    </div>

                    <!-- Mô tả -->

                    <div class="form-group">

                        <label class="control-label col-sm-4 " for="email">Chính sách bảo hành: </label>

                        <div class="col-sm-6">

                            <textarea name="describe"  class="ckeditor" id=""><?php echo set_value('describe') ?></textarea>

                            <div class="error-form"><?php echo form_error('describe') ?></div>

                        </div>

                    </div>

                    <!-- thông số kỹ thuật -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Thông số kỹ thuật: </label>

                        <div class="col-sm-6">

                            <textarea name="parameter_tecnical" class="ckeditor" id="" rows="10" ><?php echo set_value('parameter_tecnical') ?></textarea>

                            <div class="error-form"><?php echo form_error('parameter_tecnical') ?></div>

                        </div>

                    </div>

                    <!-- chính sách khuyến mãi -->

                    <div class="form-group">

                        <label class="control-label col-sm-4" for="email">Ưu đãi khi mua sản phẩm: </label>

                        <div class="col-sm-6">

                            <textarea name="promotion" class="ckeditor" id="" class="form-control" rows="8"><?php echo set_value('promotion') ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-4 col-sm-6">

                            <button type="submit" class="btn btn-success btn-block">

                                <b class="fa fa-floppy-o"></b> Thêm

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

    CKEDITOR.replace('parameter_tecnical');
    CKEDITOR.replace('describe');
    CKEDITOR.replace('promotion');

    $(document).ready(function() {

        //load mac dich danh muc dien thoai

        loadCategory(1);

        //event thay doi parent category

        $('#parent_category').on('change', function() {

            $('#category')

                .find('option')

                .remove()

                .end();

            id = this.value;

            loadCategory(id);

        })

        //load danh muc theo id

        function loadCategory(id) {

            $.ajax({

                url: '<?php echo base_url('api/danhmucsanpham/')?>'+ id

            })

            .done(function(data) {

                data = JSON.parse(data);

                $.each(data, function (i, item) {

                $('#category')

                .append($('<option>', { 

                    value: item.id,

                    text : item.name

                    }));

                });

            })

            .fail(function() {

                console.log("error");

            })

        }

    });

</script>