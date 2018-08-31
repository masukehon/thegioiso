<div class="col-sm-9 content order-detail">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Chi tiết cập nhật</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div class="text-center"><h3>Trước</h3></div>
                <?php echo $info->old ?>
            </div>
            <div class="col-sm-6" style="border-left: 1px solid rgba(28, 28, 28, 0.1)">
                <div class="text-center"><h3>Sau</h3></div>
                <?php echo $info->new ?>
            </div>
        </div>
    </div>
</div>