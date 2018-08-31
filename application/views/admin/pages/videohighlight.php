<script type="text/javascript">



	jQuery(document).ready(function() {

		/*Bắt sự kiện lọc lượt xem, validation dữ liệu và gửi ajax xuống controller để lọc*/

		<?php for ($i=1; $i <= count($videoHighLight); $i++)

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

						url: 'http://thegioiso.net.vn/admin/videoHighLight/filter',

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

			<?php	} ?>

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

									url: 'http://thegioiso.net.vn/admin/videoHighLight/delete',

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



	<div class="col-sm-9 content ">

		<div class="panel panel-success">

			<div class="panel-heading">

				<h3 class="panel-title">Video nổi bật</h3>

			</div>

			<?php 

			if(count($videoHighLight)):

				?>

				<div class="panel-body">



					<div class="col-sm-12" >

						<!-- start table -->

						<table class="table table-hover table-responsive text-center table table-bordered">

							<thead>

								<tr>

									<th>STT</th>

									<th>Tên Sản Phẩm</th>

									<th>Danh mục</th>

									<th>Thống kê</th>

									<th class="col-sm-4">Video</th>

									<th>Tùy chọn</th>

								</tr>

							</thead>

							<tbody>

								<?php



								$i = 1 ;

								foreach ($videoHighLight as $videos):





									?>

									<tr> 

										<td>

											<?php echo $i ?>

											<input type="hidden" id="video<?php echo $i ?>" value="<?php echo $videos->video ?>">

										</td>

										<td><?php echo $videos->name ?></td>

										<td><?php echo $videos->catName ?></td>

										<td style="text-align: center;width: 50%">

											<h5 class="panel-title" style="margin-bottom: 20px;">Tổng số lượt xem: <?php echo $videos->count ?></h5>

											<div class="form-group">

												<label for="">Số lượt xem theo giây

												</label>

												<span id="erorr<?php echo $i ?>" style="color:red">*</span>

												<input type="number" class="form-control" id="seconds<?php echo $i ?>"  placeholder="Nhập số giây(ví dụ: 15) lấy ra số lượt xem trên 15 giây">

											</div>

											<button type="button" id="filter<?php echo $i ?>" class="btn btn-info">Lọc</button>

											<div id="result<?php echo $i ?>"></div>

										</td>

										<td class="col-sm-4">

											<iframe width="200" height="150" src="https://www.youtube.com/embed/<?php echo $videos->video; ?>?modestbranding=0&autoplay=0&controls=0&showinfo=0&rel=0&wmode=opaque&enablejsapi=1" frameborder="0" allowfullscreen auto></iframe>

										</td>

										<td>

											<button class="btn btn-danger btn-sm delete" value="<?php echo $videos->video ?>"><i class="fa fa-trash" aria-hidden="true"></i>

											</button>

										</td>

									</tr>

									<?php

									$i++;

									endforeach ?>

								</tbody>

							</table>

							<!-- end table -->

						</div>

					</div>

				<?php endif ?>

			</div>

		</div>