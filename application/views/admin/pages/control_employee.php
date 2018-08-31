<div class="col-sm-9 content product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lí hoạt động</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <!-- form -->
                <div class="col-sm-9">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="sel1" class="control-label col-sm-4">Nhân viên: </label>
                            <div class="col-sm-6">
                                <select class="form-control">
                                    <option value="0">Tất cả</option>
                                    
                                    <?php foreach ($admin as $employee) : ?>
                                    <option value="<?php echo $employee->id ?>"><?php echo $employee->fullname ?></option>
                                    <?php endforeach; ?>
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
                    <h3>Hoạt động gần đây</h3>
                    <table class="table table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>Thời gian</th>
                                <th>TÊN nhân viên</th>
                                <th>Hành động</th>
                                <th>Đối tượng</th>
                                <th class="col-sm-5">chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history as $row): ?>
                            <tr>
                                <td><?php echo get_date($row->create_at) ?></td>
                                <td>
                                    <b>
                                    <?php 
                                    foreach ($admin as $employee) {
                                        if ($employee->id == $row->id_admin) {
                                            echo $employee->fullname;
                                        }
                                    }
                                     ?>
                                    </b>  
                                </td>
                                <td><b><?php echo $row->action ?></b></td>
                                <td><b><?php echo $row->destination ?></b></td>
                                <td class="col-sm-5">
                                    <?php echo $row->detail ?>
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