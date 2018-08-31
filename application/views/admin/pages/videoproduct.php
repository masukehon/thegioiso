<script type="text/javascript">



    jQuery(document).ready(function() {

        /*Bắt sự kiện lọc lượt xem, validation dữ liệu và gửi ajax xuống controller để lọc*/

        <?php for ($i=1; $i <= count($list); $i++)

        { ?>

            $('#filter<?php echo $i ?>').click(function() {

                var idVideo = $('#video<?php echo $i ?>').val();

                var seconds = $('#seconds<?php echo $i ?>').val();

                if(seconds <=  0 || seconds == '' )

                {

                    $("#erorr<?php echo $i ?>").html(' * Nhập vào 1 số dương !!!');

                }

                else{



                    $.ajax({

                        url: 'http://thegioiso.net.vn/admin/videoProduct/filter',

                        type: 'POST',

                        dataType: 'html',

                        data: {idVideo: idVideo, seconds:seconds},

                        success: function(response ){

                            $("#result<?php echo $i ?>").html('<div class="alert alert-success">Số lượt xem trên ' + " "+ seconds + " giây là" + " " + response + " lượt" +'</div>');           

                        }

                    })

                    

                    

                    $("#erorr<?php echo $i ?>").html('*');  

                }

            });

            <?php   } ?>

            /* end*/



            /*Bắt sự kiện xóa thống kê của 1 sản phẩm*/

            $('.delete').click(function(event){

                idVideo = $(this).val();

                $.confirm({

                    title: 'Xóa',

                    content: 'Bạn có muốn xóa thống kê của video này ? ',

                    buttons:

                    {

                        Yes:

                        {

                            text:'Đồng ý',

                            action:function(){

                                $.ajax({

                                    url: 'http://thegioiso.net.vn/admin/videoProduct/delete',

                                    type: 'POST',

                                    dataType: 'html',

                                    data: {idVideo: idVideo},

                                    success:function(){

                                        $.alert({

                                            content:"Xóa thành công !!!",

                                            title:'Xóa',

                                            buttons:{

                                                OK:{

                                                    text:'OK',

                                                    action:function(){

                                                        location.reload();

                                                    }

                                                }

                                            }

                                        })



                                    }



                                })

                            }

                        },

                        No: {

                            text: 'Hủy', 

                        }

                    }

                });

            }); 

            /* end*/



        });         

    </script>

    <div class="col-sm-9 content product">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Video sản phẩm trang chủ </h3>

            </div>

            <?php if (count($list) > 0): ?>

                <div class="panel-body">

                    <div class="col-sm-12" style="margin-top: 10px">



                        <!-- form -->

                        <div class="col-sm-9">

                            <form class="form-horizontal" action="<?php echo admin_url('videosanpham') ?>" method="GET">

                                <div class="form-group">

                                    <label class="control-label col-sm-4" for="email">Từ khóa:</label>

                                    <div class="col-sm-6">

                                        <input type="text" class="form-control" name="keyWord" placeholder="Nhập từ khóa cần tìm"

                                         value="<?php echo ($this->input->get('keyWord') != null) ? $this->input->get('keyWord') : ""  ?>">

                                         

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="sel1" class="control-label col-sm-4">Danh mục: </label>

                                    <div class="col-sm-6">

                                        <select class="form-control" name="listCat">

                                            <option value="">Tất cả</option>

                                            <?php

                                            if (count($cat) > 0):

                                                foreach ($cat as $cats):

                                                 ?>

                                                 <option value="<?php echo $cats->id ?>" <?php echo ($this->input->get('listCat') == $cats->id ) ? 'selected' : ""  ?>><?php echo $cats->name ?></option>

                                                 <?php

                                             endforeach;

                                             endif; ?>

                                         </select>

                                     </div>

                                 </div>

                                 <div class="form-group">

                                    <div class="col-sm-offset-4 col-sm-10">

                                        <button type="submit" class="btn btn-success btn-group-vertical">

                                            <b class="fa fa-search"></b> Tìm kiếm

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <!-- end-form -->

                        <!-- table -->

                        <div class="col-sm-12">

                            <h3>Danh sách video hiện thị tại trang chủ</h3>

                            <table class="table table-hover table-responsive text-center table-bordered">

                                <thead>

                                    <tr>

                                        <th>STT</th>

                                        <th>TÊN SẢN PHẨM</th>

                                        <th>TÊN DANH MỤC</th>

                                        <th>THỐNG KÊ</th>

                                        <th class="col-sm-4">VIDEO</th>

                                        <th>TÙY CHỌN</th>

                                    </tr>

                                </thead>

                                <tbody>

                                   <tr>

                                    <?php

                                    $i = 1;

                                    foreach ($list as $lists):

                                      ?>

                                      <td><?php echo $i ?>

                                       <input type="hidden"

                                       id="video<?php echo $i ?>"

                                       value="<?php echo $lists->video ?>" >

                                   </td>

                                   <td><?php echo $lists->name ?></td>

                                   <td><?php echo $lists->catName ?></td>

                                   <td style="text-align: center;width: 50%">

                                    <h5 class="panel-title" style="margin-bottom: 20px;">Tổng số lượt xem:<?php echo $lists->count ?> </h5>

                                    <div class="form-group">

                                        <label for="">Số lượt xem theo giây

                                        </label>

                                        <span id="erorr<?php echo $i ?>" style="color:red">*</span>

                                        <input type="number" class="form-control" id="seconds<?php echo $i ?>"  placeholder="Nhập số giây(ví dụ: 15) lấy ra số lượt xem trên 15 giây">

                                    </div>

                                    <button type="button" id="filter<?php echo $i ?>" class="btn btn-info">Lọc</button>

                                    <div id="result<?php echo $i ?>"></div>

                                </td>

                                <td class="col-sm-4"><iframe width="200" height="150" src="https://www.youtube.com/embed/<?php echo $lists->video; ?>?modestbranding=0&autoplay=0&controls=0&showinfo=0&rel=0&wmode=opaque&enablejsapi=1" frameborder="0" allowfullscreen auto></iframe></td>

                                <td>

                                    <button class="btn btn-danger btn-sm delete" value="<?php echo $lists->video ?>"><i class="fa fa-trash" aria-hidden="true"></i>

                                   </button>

                               </td>

                           </tr>

                           <?php

                           $i++;

                           endforeach ?>

                       </tbody>

                   </table>

                   <?php

                   echo $pagination;



                   ?>

               </div>

               <!-- end-table -->

           </div>

       </div>

   <?php endif ?>

</div>

</div>