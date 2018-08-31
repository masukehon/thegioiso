<style type="text/css">
    #newsdetail img{
        max-width: 100%!important;
        height: auto!importantl

    }
</style>
<div class="container news-detail">

    <?php



    if(count($detail) > 0)

    {

        ?>



        <div class="col-sm-8 detail">

            <h2><?php echo $detail->name ?></h2>

            <p style="color: orange;"><?php echo $detail->catName ?></p>

            <p style="color: blue;"><?php echo $detail->create_at ?></p>



            <p >
                <div id="newsdetail">
                    <?php echo $detail->content ?>
                </div>
            </p>



        </div>

        <?php

    }



    ?>

    <?php

    if (count($involvedNews) > 0) {

      ?>

      <div class="col-sm-4">

        <div>

            <span class="btn-title">Tin tức cùng loại</span>

        </div>

        <div class="col-sm-12 list-news">

            <?php

            foreach ($involvedNews as $news) {

             ?>

             <div class="item row">

                <a href="<?php echo base_url().'tintuc/chitiet?aliasD='.$news->alias_name  ?>">

                    <div class="col-sm-2 img">

                        <img src="<?php echo upload_image_url($news->image_thumb) ?>" alt="" class="img-responsive">

                    </div>

                    <div class="col-sm-10 info">

                        <h4 style="font-weight: 600"><?php echo $news->name ?></h4>

                    </div>

                    <div class="col-sm-12"><?php echo $news->describes ?></div>

                    <div class="col-sm-12">

                        <p style="font-size: 11px" class="text-right"><?php echo $news->create_at ?></p>

                    </div>

                </a>

            </div>

            <?php

        }

        ?>                 

        <div class="text-right" style="margin-top: 10px">

            <a href="<?php echo base_url().'tintuc/?alias='.$aliasCat->alias_name; ?>" class="btn-see-more">Xem thêm.</a>

        </div>

    </div>

</div>

<?php 

}

?>

</div>

<script>
$(document).ready(function(){
     mediaSize();
     window.addEventListener('resize', mediaSize, false);
});
function mediaSize() {

    if (window.matchMedia('(max-width: 768px)').matches) {
      
        $('.cart').hide();
        $('#news').hide();
        $('#all-in-one').hide();
        $('#may-anh').hide();
        $('.facebook').hide();
        $('#footer-news').hide();
        $('#footer-product').hide();
        $('.about-us').hide();
        $('#map').hide();


    } else {
        $('#news').show();
        
    }
};


</script>