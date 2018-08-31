<?php 



$this->ci = & get_instance();

$this->ci->load->model('news_model');

$this->ci->load->model('product_model');

$this->ci->load->model('copyright_model');



$copyright = $this->ci->copyright_model->get_info(1);

$input['limit'] = array('3','0');

$input['order_by'] = array('update_at','DESC');

$listProduct = $this->ci->product_model->get_list($input);

$listNews = $this->ci->news_model->get_list($input);

?>



<footer class="footer-fluid" style="margin-top:30px;">

   <div class="container-fluid">

    <div class="row text-left" style="margin: 20px 0">

        <div class="col-sm-3 col-xs-12 footer-left">

            <a class="footer-brand" href="<?php echo base_url(); ?>" class="logo">

                <span>THẾ GIỚI SỐ</span>

                <br>

                <span style="color:#fff">SÂN CHƠI CÔNG NGHỆ CỦA BẠN</span>

            </a>

            

            <div class="col-sm-12 col-xs-6 about-us" style="margin-top: 25px">

                <p><i class="fa fa-check-circle-o check icons" aria-hidden="true"></i> Đảm bảo chất lượng tốt nhất, giá rẻ nhất</p>

                <p><i class="fa fa-check-circle-o check icons" aria-hidden="true"></i> Đội ngũ chuyên nghiệp</p>

                <p><i class="fa fa-check-circle-o check icons" aria-hidden="true"></i> Cam kết 1 đổi 1 nếu lỗi</p>

                <p><i class="fa fa-check-circle-o check icons" aria-hidden="true"></i> Sữa chữa, bảo hành 24/7</p>

                <p><i class="fa fa-check-circle-o check icons" aria-hidden="true"></i> Miễn phí vận chuyển trong nội thành</p>

            </div>

        </div>

        <div class="col-sm-3" id="footer-product">

            <div class="btn-title">Sản Phẩm</div>

            <?php foreach($listProduct as $product) {?>

            <div class="news-item">

                <div class="row" style="margin-top: 5px">

                    <a href="<?php echo base_url()."sanpham/".$product->id;?>">

                        <div class="col-sm-4 col-md-4 col-xs-4">

                            <img src="<?php echo upload_image_url($product->image_thumb);?>" class="img-responsive" alt="">

                        </div>

                        <div class="col-sm-8 col-md-8 col-xs-4">

                            <p class="news-title"><?php echo $product->name; ?></p>

                            <p class="news-title"><?php echo vnd($product->price - $product->discount); ?></p>

                        </div>

                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

        <div class="col-sm-3" id="footer-news">

            <div class="btn-title">Tin Tức</div>

            <?php foreach($listNews as $news) {?>

            <div class="news-item">

                <div class="row" style="margin-top: 5px">

                    <a href="<?php echo base_url()."tintuc/chitiet/?aliasD=".$news->alias_name;?>">

                        <div class="col-sm-4 col-md-4 col-xs-4">

                            <img src="<?php echo upload_image_url($news->image_thumb);?>" class="img-responsive" alt="">

                        </div>

                        <div class="col-sm-8 col-md-8 col-xs-4">

                            <p class="news-title"><?php echo $news->name; ?></p>

                        </div>

                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

        <div class="col-sm-3 col-xs-12 footer-contact">

            <div class="btn-title">Liên Hệ</div>

            <div style="margin-top: 5px;" >

                <i class="fa fa-map-marker icons"></i>

                <span> <?php echo $copyright->address; ?></span>

            </div>

            <div style="margin-top: 25px;" >

                <i class="fa fa-phone icons"></i>

                <span> <?php echo $copyright->phone; ?></span>

            </div>

            <div style="margin-top: 25px;" >

                <i class="fa fa-fax icons"></i>

                <span>Fax: <?php echo $copyright->fax; ?></span>

            </div>

            <div style="margin-top: 25px;">

                <i class="fa fa-envelope icons"></i>

                <span> <?php echo $copyright->email; ?></span>

            </div>

            <div style="margin-top: 25px;">

                <i class="fa fa-facebook-square icons"></i>

                <a style="color: #fd6500" href="<?php echo $copyright->facebook; ?>"> Kênh Facebook của Thế Giới Số</a>

            </div>

            <div style="margin-top: 25px;">

                <i class="fa fa-youtube-square icons"></i>

                <a style="color: #fd6500" href="<?php echo $copyright->youtube; ?>">Kênh Youtube của Thế Giới Số</a>

            </div>

            

        </div>

        <div class="col-sm-12 col-lg-12 col-xs-12">

            <div class="row">

                <div id="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.078210190441!2d106.71357571418281!3d10.805321861615838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a38d364d59%3A0x87a6a1a5724639d7!2zMTQyIMSQxrDhu51uZyBEMiwgUGjGsOG7nW5nIDI1LCBCw6xuaCBUaOG6oW5oLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1512403361392" width="100%" height="100%" frameborder="0" style="border:1px solid #fff;margin-top:20px;" allowfullscreen></iframe>

                </div> 

            </div>

        </div>

        <div class="copyright">

            <div>

                <div class="col-sm-12 text-center">

                    <strong>Copyright:TheGioiSo</strong>

                </div>

            </div>

        </div>

    </div>

</div>

</footer>



