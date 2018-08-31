<div class="col-sm-9 content category-product">


<div class="panel panel-success">


  <div class="panel-heading">


    <h3 class="panel-title">Danh mục tin tức</h3></div>


  <div class="panel-body">


    <div class="col-sm-12" style="margin-top: 10px">


      <!-- form -->


      <div class="col-sm-9 create-category-news">


        <?php if (isset($messageCategoryNew)) {


  echo $messageCategoryNew;


}





?>


          <form class="form-horizontal" role="form" method="POST" action="<?php echo admin_url('danhmuctintuc/them'); ?>">


            <form class="form-horizontal" role="form" method="POST" action="">


              <div class="form-group">


                <label class="control-label col-sm-4" for="email">Tên danh mục</label>


                <div class="col-sm-6">


                  <input type="text" name="name" class="form-control" id="email" placeholder="Nhập tên danh mục" value="<?php echo set_value('name') ?>">


                  <div class="error-form">


                    <div class="error-form">


                      <?php echo form_error('name') ?>


                    </div>


                  </div>


                </div>


              </div>


              <div class="form-group">


                <div class="col-sm-offset-4 col-sm-6">


                  <button type="submit" id="btnAddCatNews" name="btnAddCatNews" class="btn btn-success btn-block"><b class="fa fa-floppy-o"></b>Thêm </button>


                </div>


              </div>


            </form>


      </div>


      <!-- end-form -->


      <!-- table -->


      <div class="col-sm-12">


        <h3>Danh sách danh mục tin tức</h3>


        <table class="table table-hover table-responsive text-center">


          <thead>


            <tr>


              <th>STT</th>


              <th>TÊN DANH MỤC</th>


            </tr>


          </thead>


          <tbody>


            <?php $i=1;


foreach($list as $row) {


  ?>


              <tr>


                <td>


                  <?=$i?>


                </td>


                <td style="text-transform: uppercase;">


                  <?=$row->name?><a href="<?php echo admin_url("danhmuctintuc/sua/").$row->id;?>" class="btn btn-warning btn-sm"><b class="fa fa-pencil-square-o"></b></a>


                    <?php if($checkRole): ?> <a value="<?php echo admin_url("danhmuctintuc/xoa/").$row->id;?>" class="btn btn-danger btn-sm delete"><b class="fa fa-times"></b></a>


                      <?php endif;


      ?>


                </td>


              </tr>


              <?php $i++;


}





?>


          </tbody>


        </table>


      </div>


      <!-- end-table -->


    </div>


  </div>


</div>


</div>
