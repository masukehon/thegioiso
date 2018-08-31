<div class="col-sm-9 content category-product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Thay đổi quyền hạn: </h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <!-- form -->
                <form class="form-horizontal" method="POST" action="">
                    <div class="form-group">
                        <label for="sel1" class="control-label col-sm-4">Quyền hạn: </label>
                        <div class="col-sm-6">
                            <select class="form-control" name='id_role'>
                                <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role->id ?>" 
                                    <?php echo ($role->id == $info->id_role) ? 'selected' : '' ?>
                                    >
                                    <?php echo $role->role ?>
                                        
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">
                                <b class="fa fa-plus-floppy-o"></b> Lưu
                            </button>
                        </div>
                    </div>

                </form>
                <!-- end-form -->
            </div>
        </div>
    </div>
</div>