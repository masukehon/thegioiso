<div class="col-sm-9 content product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Video slider</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <?php 
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <!-- form -->
                <div class="col-sm-9">
                    
                </div>
                <!-- end-form -->
                <div class="col-sm-3 text-right">
                    <a class="btn btn-info btn-lg" href="<?php echo admin_url('slider/them') ?>">
                        <b class="fa fa-plus-circle"></b> Thêm video mới</a>
                </div>
                <!-- table -->
                <div class="col-sm-12">
                <h3>Danh sách video</h3>
                    <table class="table table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Hiển thị</th>
                                <th>Ngày tạo</th>
                                <th>Video</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $i = 0; foreach($listVideo as $video) { ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        <?php echo $video->name; ?>
                                    </td>
                                    <td>
                                    <input type="checkbox" name="show" id="" <?php if ($video->is_show) echo 'checked' ?> disabled>
                                    </td>
                                    <td>
                                    <?php echo $video->create_at; ?>
                                    </td>
                                    <td>
                                    <iframe width="200" height="150" src="https://www.youtube.com/embed/<?php echo $video->video; ?>?modestbranding=0&autoplay=0&controls=0&showinfo=0&rel=0&wmode=opaque&enablejsapi=1" frameborder="0" allowfullscreen auto></iframe>
                                    </td>
                                    <td>
                                         <?php if($checkRole){ ?>                                
                                             <a value="<?php echo admin_url('slider/xoa/').$video->id; ?>" class="btn btn-danger btn-sm delete"><b class="fa fa-times"></b></a>

                                         <?php }?>
                                        <a href="<?php echo admin_url('slider/sua/').$video->id; ?>" class="btn btn-warning btn-sm"><b class="fa fa-pencil-square-o"></b></a>
                                    </td>
                                </tr>
                                <?php }?>
                        </tbody>
                    </table>
                </div>
                <!-- end-table -->
            </div>
        </div>
    </div>
</div>
<script>

$(".filter").click(function(){
    var ID = $(this).val();
    var second = $(this).parent("td").find("input").val();

    $.ajax({
        url:"<?php echo admin_url("slider/filter"); ?>",
        type:"POST",
        dataType : "text",
        data:{
            idVideo:ID,
            seconds:second
        },
        success:function(result){
            alert("Số lượt xem trên "+second+"s là: "+result);
        }
    });
});

</script>