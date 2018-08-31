<div class="col-sm-9 content product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">nhân viên</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <?php 
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <!-- form -->
                <div class="col-sm-9 create-employee">
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Email:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="email" placeholder="Email nhân viên cần thêm" name="email">
                                <div class="error-form"><?php echo form_error('email') ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-success btn-block">
                                    <b class="fa fa-plus"></b> Thêm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end-form -->
                
                <!-- table -->
                <div class="col-sm-12">
                    <table class="table table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Quyền hạn</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach($list as $row) :
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        <?php
                                        echo $row->fullname ? $row->fullname : 'Chưa nhập';
                                        ?>

                                    </td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php 
                                        echo !$row->status ? 'Chưa chính thức' : 'Chính thức';
                                    ?></td>
                                    <td><?php 
                                    if ($row->id_role) {
                                        foreach ($roles as $role) {
                                            if($row->id_role == $role->id) {
                                                echo $role->role;
                                            }
                                        }
                                    } else {
                                        echo 'Không';
                                    }
                                    
                                    ?></td>
                                    <td>
                                        <a href="<?php echo admin_url('capnhatnhanvien/') . $row->id ?>" class="btn btn-warning"><b class="fa fa-pencil-square-o"></b> Đổi quyền hạn</a>
                                        <a href="<?php echo admin_url('xoanhanvien/') . $row->id ?>" class="btn btn-danger delete"><b class="fa fa-times"></b></a>
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