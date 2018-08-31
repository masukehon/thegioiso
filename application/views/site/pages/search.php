<div class="container full-search" style="margin-top: 15px;">

	<div class="col-md-7">
		<div>
			<span class="btn-title">Sản phẩm liên quan</span>
		</div>
		<div class="list" style="margin-top: 20px">
			<?php if ($listProduct) : ?>
				<?php foreach ($listProduct as $product) : ?>
					<div class="col-sm-12" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1)">
						<div class="item col-sm-12" style="padding-bottom: 10px">
							<a href="<?php echo base_url('sanpham/' . $product->id) ?>">
								<div class="col-md-5">
									<img src="<?php echo upload_image_url($product->image_thumb); ?>" alt="" class="img-responsive">
								</div>
								<div class="col-md-7">
									<h4 style="color: #444; font-weight: 700; text-transform: uppercase; font-size: 15px;"><?php echo $product->name ?></h4>
									<p style="color: #d35400; font-weight: 700; text-transform: uppercase; font-size: 13px;"><?php echo vnd($product->price) ?></p>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p>Không tìm thấy kết quả phù hợp</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-5">
		<div>
			<span class="btn-title">Tin tức liên quan</span>
		</div>
		<div class="col-md-12 list-news">
			<?php if ($listNews) : ?>
				<?php foreach ($listNews as $news): ?>
					<div class="item row">
						<a href="<?php echo base_url('/tintuc/chitiet?aliasD=' . $news->alias_name) ?>">
							<div class="col-md-4 img">
								<img src="<?php echo base_url('sanpham/' . $news->id) ?>" alt="" class="img-responsive">
							</div>
							<div class="col-md-8 info">
								<h4 style="font-weight: 600"><?php echo $news->name ?></h4>
							</div>
							<div class="col-md-12"><?php echo $news->describes ?></div>
							<div class="col-md-12">
								<p style="font-size: 11px" class="text-right"><?php echo getTimeCreated($news->create_at) ?></p>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<p>Không tìm thấy kết quả phù hợp</p>
			<?php endif; ?>
		</div>
	</div>
</div>	