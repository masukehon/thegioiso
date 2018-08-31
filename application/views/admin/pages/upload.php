<div class="col-sm-9 content order-detail">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Giới thiệu</h3>
        </div>
        <div class="panel-body">
            <!-- form -->
            <form class="form" enctype="multipart/form-data" method="post" action="<?php echo admin_url('upload') ?>">

                <!-- Nội dung -->
                <div class="form-group">
                    <input type="file" name="image" multiple="">
                </div>

                <div class="form-group text-right col-sm-11" style="margin-top: 10px">
                    <button type="submit" class="btn btn-success btn-group-vertical" name="submit">
                        <b class="fa fa-plus"></b> up
                    </button>
                </div>
            </form>

            <!-- end-form -->
        </div>
    </div>
</div>