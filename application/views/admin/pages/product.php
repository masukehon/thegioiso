

<div class="col-sm-9 content product">



    <div class="panel panel-success">



        <div class="panel-heading">



            <h3 class="panel-title">Sản phẩm</h3>



        </div>



        <div class="panel-body">



            <div class="col-sm-12" style="margin-top: 10px; padding: 0">



                <?php 



                if (isset($message)) {



                    echo $message;



                }



                ?>



                <!-- form -->



                <div class="col-sm-12">



                    <form class="form-inline" method="get" action="<?php echo admin_url('sanpham/timkiem') ?>">



                        <div class="form-group">



                            <label class="control-label" for="email">Từ khóa:</label>



                            <input 



                            type="text" 



                            class="form-control" 



                            id="key" 



                            placeholder="Nhập từ khóa cần tìm" 



                            name="key"



                            value="<?php if(isset($searchKey)){



                                echo $searchKey;



                            } ?>"



                            >



                        </div>



                        <div class="form-group">



                            <label for="sel1" class="control-label">Danh mục lớn: </label>



                            <select class="form-control" id="parent_category" name="parent_category">



                                <option value="0">Tất cả</option>



                                <?php foreach ($categoryList as $category): ?>



                                    <option



                                    value="<?php echo $category->id ?>"



                                    <?php if(isset($searchParentCategory)) {



                                        echo ($searchParentCategory == $category->id) ? 'selected' : '';



                                    }?>



                                    >



                                    <?php echo $category->name ?></option>



                                <?php endforeach; ?>



                            </select>





                        </div>



                        <div class="form-group">



                            <label for="sel1" class="control-label">Danh mục nhỏ: </label>





                            <select class="form-control" id="category" name="category">

                                <option value="">Lựa chọn</option>



                                <?php if(isset($categoryChildList)): ?>



                                    <?php foreach ($categoryChildList as $categoryChild): ?>



                                        <option



                                        value="<?php echo $categoryChild->id ?>"



                                        <?php echo ($searchCategory == $categoryChild->id) ? 'selected' : '' ?>



                                        >



                                        <?php echo $categoryChild->name ?></option>



                                    <?php endforeach; ?>



                                <?php endif; ?>



                            </select>



                        </div>





                        <button type="submit" class="btn btn-success btn-group-vertical">



                            <b class="fa fa-search"></b>



                        </button>





                    </form>



                </div>



                <!-- end-form -->



                <!-- btn -->



                <div class="col-sm-12 text-right" style="margin-top: 5px">


                    <a href="<?php echo admin_url('sanpham/sapxep') ?>" class="btn btn-primary"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Sắp xếp thứ tự hiển thị</a>
                    <a href="<?php echo admin_url('sanpham/them') ?>" class="btn btn-info"><b class="fa fa-plus-circle"></b> Thêm sản phẩm mới</a>

                    

                    <button class="btn btn-primary btnEditMode"><b class="fa fa-pencil-square-o"></b> Chế độ sửa nhanh</button>

                    <button class="btn btn-success btnSave" style="display: none"><b class="fa fa-floppy-o"></b> Lưu thay đổi</button>

                    <button class="btn btn-danger btnCancel" style="display: none"><b class="fa fa-close"></b> Hủy</button>

                </div>



                <!-- end-btn -->



                <!-- table -->



                <div class="col-sm-12" style="padding: 0">



                    <h3>Danh sách sản phẩm</h3>



                    <table class="table table-hover table-responsive text-center">



                        <thead>



                            <tr>


                                <th>SỐ THỨ TỰ</th>
                                <th>TÊN SẢN PHẨM</th>



                                <th>DANH MỤC SẢN PHẨM</th>

                                

                                <th>HIỂN THỊ</th>

                                <?php if($role1): ?>

                                    <th>Nổi bật</th>



                                    <th>Đặt ở trang chủ</th>

                                <?php endif; ?>

                                <th>GIÁ BÁN</th>



                                <th>GIảm giá</th>



                                <th>NGÀY NHẬP</th>



                                <th></th>



                            </tr>



                        </thead>



                        <tbody>


                            <?php 
                            if (intval($this->uri->segment(3)) == 0) {
                               $i = 1;
                           }
                           else
                           {
                            $i = intval($this->uri->segment(3));
                            $i = ($i - 1) * count($list) + 1;

                        }



                        ?>
                        <?php foreach ($list as $row): ?>



                            <tr>
                                <td class="col-sm-2">
                                   <?php echo $i; ?>

                               </td>
                               <!-- NAME -->

                               <td class="col-sm-2">

                                <p class="editModeOff"><a name="product#<?php echo $row->id ?>#name" href="<?php echo admin_url('sanpham/sua/') . $row->id ?>"><?php echo $row->name ?></a></p>



                                <p class="editModeOn"><input type="text" name="product#<?php echo $row->id ?>#name" id="" value="<?php echo $row->name ?>"></p>

                            </td>

                            <!-- CATEGORY -->

                            <td>

                                <?php 

                                $CI =& get_instance();

                                $CI->load->model('category_product_model');



                                ;?>

                                <p class="editModeOff" name="product#<?php echo $row->id ?>#id_category">

                                    <?php 

                                            //dieu kien lay ten danh muc

                                    if($category = $CI->category_product_model->get_info($row->id_category, 'name')) {

                                        echo $category->name;

                                    } else {

                                        echo 'Không tồn tại';

                                    }

                                    ?>

                                </p>

                                <?php

                                        //dieu kien load danh sach

                                $inputList['where'] = array('id_parent_category' => $row->id_parent_category);

                                $subList = $CI->category_product_model->get_list($inputList);



                                ?>

                                <select class="editModeOn" name="product#<?php echo $row->id ?>#id_category">

                                    <?php foreach($subList as $subRow): ?>

                                        <option value="<?php echo $subRow->id ?>" <?php echo $subRow->id == $row->id_category ? 'selected' : '' ?>> <?php echo $subRow->name ?> </option>

                                    <?php endforeach; ?>

                                </select>

                            </td>

                            <!-- IS_SHOW -->

                            <td>

                                <p class="editModeOff"><input type="checkbox" name="product#<?php echo $row->id ?>#is_show" id="" <?php if ($row->is_show) echo 'checked' ?> disabled></p>

                                <p class="editModeOn"><input type="checkbox" name="product#<?php echo $row->id ?>#is_show" <?php echo $row->is_show ? 'checked' : '' ?>></p>



                            </td>

                            <!-- IS_HIGHLIGHT -->

                            <?php if($role1): ?>

                                <td>

                                    <p class="editModeOff"><input type="checkbox" name="product#<?php echo $row->id ?>#is_highlight" id="" <?php if ($row->is_highlight) echo 'checked' ?> disabled></p>

                                    <p class="editModeOn"><input type="checkbox" name="product#<?php echo $row->id ?>#is_highlight" <?php echo $row->is_highlight ? 'checked' : '' ?>></p>

                                </td>

                                <!-- SHOW_IN_INDEX -->

                                <td>

                                    <p class="editModeOff"><input type="checkbox" name="product#<?php echo $row->id ?>#show_in_index" id="" <?php if ($row->show_in_index) echo 'checked' ?> disabled></p>

                                    <p class="editModeOn"><input type="checkbox" name="product#<?php echo $row->id ?>#show_in_index" <?php echo $row->show_in_index ? 'checked' : '' ?>></p>

                                </td>

                            <?php endif; ?>

                            <!-- PRICE -->

                            <td>

                                <p class="editModeOff" name="product#<?php echo $row->id ?>#price"><?php echo $row->price ?></p>

                                <p class="editModeOn"><input type="text" name="product#<?php echo $row->id ?>#price" size="11" value="<?php echo $row->price ?>"></p>

                            </td>

                            <!-- DISCOUNT -->

                            <td>

                                <p class="editModeOff" name="product#<?php echo $row->id ?>#discount"><?php echo $row->discount ?></p>

                                <p class="editModeOn"><input type="text" name="product#<?php echo $row->id ?>#discount" size="11" value="<?php echo $row->discount ?>"></p>

                            </td>



                            <td>

                                <p><?php echo $row->create_at ?></p>

                            </td>



                            <td>



                                <?php if($role1): ?>



                                    <a href="<?php echo admin_url("sanpham/xoa/").$row->id;?>" class="btn btn-danger delete btn-sm"><b class="fa fa-times"></b></a>



                                <?php endif; ?>

                            </td>




                        </tr>


                        <?php 
                        $i++;
                        endforeach; ?>



                    </tbody>



                </table>



            </div>



            <!-- end-table -->


            
            <div class="col-sm-12 text-center"><?php echo isset($pagination) ? $pagination : '' ?></div>



        </div>



    </div>



</div>



</div>