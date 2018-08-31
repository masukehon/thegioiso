<div class="col-sm-8 form-group">



	<label for="sel1" class="control-label">Danh mục sản phẩm: </label>


	<form class="form-inline" action="<?php echo admin_url('product/sort') ?>" method="GET">
		<div class="form-group">
			<select class="form-control " id="parent_category" name="parent_category">
				<?php
				if (count($listcate) > 0):
				foreach ($listcate as $listcates):
				 ?>
				<option <?php echo ($this->input->get('parent_category') == $listcates->id) ? "selected" : "" ?> value="<?php echo $listcates->id ?>"><?php echo $listcates->name ?></option>

				<?php
			endforeach;
		endif;
				 ?>

				</select>
			</div>
			<div class="form-group">
				<label for="searchforname">Tìm kiếm theo tên</label>
				<input type="text" class="form-control" id="searchforname" name="searchforname" placeholder="Tìm sản phẩm theo tên">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			</div>
			<div class="form-group">
				<a href="<?php echo admin_url('sanpham/sapxep') ?>" type="submit" class="btn">Hiển thị tất cả</a>
			</div>
		</form>




	</div>
	<div class="col-sm-8" style="padding: 0">



		<h3>Danh sách sản phẩm</h3>



		<table class="table table-hover table-responsive text-center" >



			<thead>

				<tr style="text-align: center;">


					<th >SỐ THỨ TỰ</th>
					<th >TÊN SẢN PHẨM</th>

					<th >DANH MỤC SẢN PHẨM</th>

					<th >THỨ TỰ HIỂN THỊ Ở TRANG CHỦ</th>
					<th >THỨ TỰ HIỂN THỊ Ở DANH MỤC</th>
					<th ></th>

				</tr>



			</thead>



			<tbody>

				<?php 
				if (intval($this->uri->segment(4)) == 0) {
					$on = 1;
				}
				else
				{
					$on = intval($this->uri->segment(4));
					$on = ($on - 1) * count($list) + 1;

				}
				?>
				<?php
				if (count($list) > 0) :
					foreach ($list as $lists):
						?>

						<tr style="text-align: left;" >
							<td >
								<?php echo $on;  ?>
								<input type="hidden" name="idhidden" value="<?php echo $lists->id; ?>">
							</td >
							<!-- NAME -->

							<td >
								<?php echo $lists->name; ?>
							</td>

							<!-- CATEGORY -->

							<td >
								<?php echo $lists->namecate ?>
							</td>

							<!-- IS_SHOW -->

							<td >
								<select id="sortindex" name="sortindex" data-id="<?php echo $lists->id; ?>" data-url="<?php echo admin_url('product/sortPositionIndex')?>">
									<option value="NULL"></option>
									<?php
									for($i = 1;$i <= 5; $i++)
									{
										?>
										<option <?php echo  ($lists->sort_by_index == $i) ?  "selected" : ""  ?> value="<?php echo $i ?>" >Vị trí thứ <?php echo $i ?> </option>
										<?php } ?>
									</select>
								</td>
								<td >
									<select name="sortcate" id="sortcate" data-id="<?php echo $lists->id ?>" data-url="<?php echo admin_url('product/sortPositionCate')?>">
										<option value="NULL"></option>
										<?php
										for($i = 1;$i <= 20; $i++)
										{
											?>
											<option <?php echo  ($lists->sort_by_cate == $i) ?  "selected" : ""  ?> value="<?php echo $i ?>">Vị trí thứ <?php echo $i ?> </option>
											<?php } ?>
										</select>
									</td>



								</tr>

								<?php
								$on++;
							endforeach;
						endif;
						?>




					</tbody>



				</table>

				<?php print_r($pagination )?>

			</div>