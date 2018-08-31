<div class="container">

    <!-- menu-new -->

    <div class="menu-news row">

        <div class="navbar">

            <ul class="nav navbar-nav">

                <?php

                if (count($category_news) > 0)

                {

                    foreach ($category_news as $category)

                    {

                     ?>

                     <li class="active">

                        <a href="<?php echo base_url().'tintuc?alias='.$category->alias_name ?>"><?php echo $category->name ?></a>

                    </li>

                    <?php 

                }

            }

            ?>

        </ul>

    </div>



</div>

<!-- end-menu-new -->



<!-- news-highlight -->



<div class="row">

    <?php

    if(count($highlightNews) > 0)

    {

       ?>

       <div class="news-hightlight">

        <?php

        foreach ($highlightNews as $highlight) {

         ?>

         <div class="col-sm-3">

            <div class="item">

                <a href="<?php echo base_url() . 'tintuc/chitiet?aliasD='.$highlight->alias_name ?>">

                    <img src="<?php echo upload_image_url($highlight->image_thumb) ?>" alt="" class="img-responsive">

                    <h4><?php echo $highlight->name ?></h4>

                    <p class="text-right"><?php echo $highlight->create_at ?></p>

                </a>

            </div>

        </div>

        <?php

    }

    ?>

</div>

<?php

}

?>

<!-- end-news-highlight -->

<!-- list -->

<?php



        // print_r($news);

        // print_r($test) ;

        // echo $pagination;



?>

<?php



if(count($news) > 0)

{

  ?>

  <div class="col-sm-12 list-news">

    <?php

    foreach ($news as $newsIndex) {



     ?>

     <div class="item row">

        <a href="<?php echo base_url() . 'tintuc/chitiet?aliasD='.$newsIndex->alias_name ?>">

            <div class="col-sm-3 img">

                <img src="<?php echo upload_image_url($newsIndex->image_thumb) ?>" alt="" class="img-responsive">

            </div>

            <div class="col-sm-9 info">

                <h4 style="font-weight: 600"><?php echo $newsIndex->name ?></h4>

                <p><?php echo $newsIndex->describes ?>

                </p>

                <p style="font-size: 12px"><?php echo $newsIndex->catName ?></p>

                <p style="font-size: 12px"><?php echo $newsIndex->create_at; ?></p>

            </div>

        </a>

    </div>

    <?php

}

?>







</div>



<!-- end-list -->

<!-- pagination -->

<div class="row text-center">

    <ul class="pagination pagination-lg">

       <?php echo $pagination ?>

   </ul>

</div>

<!-- end-pagination -->

<?php

}

?>



</div>
</div>
