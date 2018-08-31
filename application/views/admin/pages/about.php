<div class="col-sm-9 content order-detail">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Giới thiệu</h3>
        </div>
        <div class="panel-body">
            <?php if ($message) 
                    echo $message;
            ?>
            <!-- form -->
            <form class="form" enctype="multipart/form-data" action="" method="POST">

                <!-- Nội dung -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea name="about" class="ckeditor" id=""><?php echo $info->content;?></textarea>
                        <div class="error-form">
                            <?php echo form_error("about");?>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right col-sm-11" style="margin-top: 10px">
                    <button type="submit" class="btn btn-success btn-group-vertical">
                        <b class="fa fa-plus"></b> Lưu
                    </button>
                </div>
            </form>

            <!-- end-form -->
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('about');
</script>