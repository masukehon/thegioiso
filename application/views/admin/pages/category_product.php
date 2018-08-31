<div class="col-sm-9 content category-product">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">Danh mục sản phẩm</h3>

        </div>

        <div class="panel-body">

            <div class="col-sm-12" style="margin-top: 10px">

                <!-- form -->

                <div class="col-sm-9 create-category-product">

                    <?php 

                    if (isset($message)) {

                        echo $message;

                    }

                    ?>

                    <form class="form-horizontal" action="<?php echo admin_url('danhmucsanpham/them'); ?>" method="POST" >

                        <div class="form-group">

                            <label for="sel1" class="control-label col-sm-4">Danh mục cấp 1: </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="id_parent_category" id="parent_category">

                                    <?php foreach($list as $row): ?>

                                        <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="sel1" class="control-label col-sm-4">Danh mục nhỏ cấp 2: </label>

                            <div class="col-sm-6">

                                <select class="form-control" name="id_parent_category_2" id="parent_category_2">

                                </select>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-4" for="name">Tên danh mục mới:</label>

                            <div class="col-sm-6">

                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="<?php echo set_value('name') ?>">

                                <div class="error-form"><?php echo form_error('name')?></div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-offset-4 col-sm-6">

                                <button type="submit" class="btn btn-success btn-block btn-created-category-product">

                                    <b class="fa fa-plus"></b> Thêm

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

                <!-- end-form -->

                <!-- table -->

                <div class="col-sm-12">

                    <h3>Danh sách danh mục sản phẩm</h3>

                    <table class="table table-hover table-responsive text-center">

                        <thead>

                            <tr>

                                <th>danh muc lớn</th>

                                <th>danh mục nhỏ</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php 

                            foreach ($list as $row) : 

                                ?>

                                <tr>

                                    <td style="text-transform: uppercase;">

                                        <p><?php echo $row->name ?></p>

                                    </td>

                                    <td style="text-transform: uppercase;text-align: center;" class="text-left" >

                                        <?php 

                                        $CI =& get_instance();

                                        $CI->load->model('category_product_model');

                                        $input['where'] = array('id_parent_category' => $row->id);

                                        $subList = $CI->category_product_model->get_list($input);

                                        foreach ($subList as $subRow) :

                                           ?>

                                            <p class=""><?php echo $subRow->name ?>

                                                <?php if($role1): ?>

                                                    <a href="<?php echo admin_url("danhmucsanpham/xoa/").$subRow->id;?>" class="btn btn-danger btn-sm delete"><b class="fa fa-times"></b></a>

                                                <?php endif; ?>

                                                <a href="<?php echo admin_url('danhmucsanpham/sua/') . $subRow->id ?>" class="btn btn-warning btn-sm"><b class="fa fa-pencil-square-o"></b></a>

                                            </p>
                                                
                                            <?php 
                                            $input2['where'] = array('id_parent_category' => $subRow->id);
                                            $subList2 = $CI->category_product_model->get_list($input2);
                                            foreach($subList2 as $subRow2):
                                            ?>
                                            <p class="text-center"><?php echo $subRow2->name ?>

                                                <?php if($role1): ?>

                                                    <a href="<?php echo admin_url("danhmucsanpham/xoa/").$subRow2->id;?>" class="btn btn-danger btn-sm delete"><b class="fa fa-times"></b></a>

                                                <?php endif; ?>

                                                <a href="<?php echo admin_url('danhmucsanpham/sua/') . $subRow2->id ?>" class="btn btn-warning btn-sm"><b class="fa fa-pencil-square-o"></b></a>

                                                </p>
                                            <?php endforeach; ?>


                                        <?php endforeach; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>



            </div>

            <!-- end-table -->

        </div>

    </div>

</div>

</div>