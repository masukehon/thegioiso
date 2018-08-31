<div class="col-sm-9 content category-product">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Danh mục sản phẩm</h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12" style="margin-top: 10px">
				<!-- form -->
				<div class="col-sm-9 create-category-product">
					
					<form class="form-horizontal" action="" method="POST" >
						<div class="form-group">
							<label class="control-label col-sm-4" for="name">Tên danh mục</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="<?php echo $info->name; ?>">
								<div class="error-form"><?php echo form_error('name') ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-6">
								<button type="submit" class="btn btn-success btn-block">
									<b class="fa fa-floppy-o"></b> Lưu
								</button>
							</div>
						</div>
					</form>
				</div>
				<!-- end-form -->
				<!-- btn -->
				<div class="col-sm-3 text-right">
					<a href="<?php echo admin_url('danhmuctintuc') ?>" class="btn btn-info btn-lg">
						<b class="fa fa-plus-circle"></b> Thêm mới</a>
					</div>
					<!-- end-btn -->
					<!-- table -->
					<div class="col-sm-12">
						<h3>Danh sách danh mục sản phẩm</h3>
						<table class="table table-hover table-responsive text-center">
							<thead>
								<tr>
									<th>STT</th>
									<th>TÊN DANH MỤC</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 0;
								foreach ($list as $row) : 
									?>
									<tr>
										<td><?php echo ++$i; ?></td>
										<td style="text-transform: uppercase;"><?php echo $row->name ?> <a href="<?php echo admin_url('danhmuctintuc/sua/') . $row->id ?>" class="btn btn-warning btn-xs"><b class="fa fa-pencil-square-o"></b></a></td>
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