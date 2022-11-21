<?php get_header('about') ;?>
<section class="templateux-hero overlay"  data-scrollax-parent="true">
    <div class="cover" data-scrollax="properties: { translateY: '30%' }">
        <img src="<?php echo get_the_post_thumbnail_url();?>" />
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center intro">
            <div class="col-md-10" data-aos="fade-up">
                <h1><?php the_title();?></h1>
                <p class="lead"><?php echo get_post_meta(get_the_ID(), 'descr', true)?></p>
                <a href="#next" class="go-down js-smoothscroll"></a>
            </div>
        </div>
    </div>
</section>

<section class="templateux-section" id="next">
    <div class="container py-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12 clearfix mb-3">
                <h2>We Are Experts</h2>
            </div>
<?php
$posts = get_posts(array(
    'numberposts' => -1, //-1 -> all our posts
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  => '',
    'post_type'   => 'experts', //only experts posts
    'suppress_filters' => true, //suppression of work of filters of change sql of receipt
));
foreach($posts as $post){
    setup_postdata($post);
    //output format
    ?>
        <div class="col-md-6">
            <p><?php echo get_post_meta(get_the_ID(), 'experts1', true)?></p>
            <p><?php echo get_post_meta(get_the_ID(), 'experts2', true)?></p>
        </div>
        <div class="col-md-6">
            <p><?php echo get_post_meta(get_the_ID(), 'experts3', true)?></p>
        </div>
    </div>
<?php
}
wp_reset_postdata();
?>
        <div class="row templateux-section">
            <div class="col-md-12 clearfix mb-5">
                <h2>Team</h2>
            </div>
<?php
$posts = get_posts(array(
    'numberposts' => 3,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'ASC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  => '',
    'post_type'   => 'team',
    'suppress_filters' => true,
));
foreach($posts as $post){
    setup_postdata($post);
    ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="block-38 ">
                    <div class="block-38-img">
                        <div class="block-38-header">
                            <?php
                                $photo = get_post_meta(get_the_ID(), 'team-image', true);
                                $img = pods_image_url($photo, 'large');
                                echo "<img src='".$img."', alt=\"Image placeholder\">";
                            ?>
                            <h3 class="block-38-heading"><?php the_title();?></h3>
                            <p class="block-38-subheading"><?php echo get_post_meta(get_the_ID(), 'team-post', true);?></p>
                        </div>
                        <div class="block-38-body">
                            <p><?php echo get_post_meta(get_the_ID(), 'team-descr', true);?></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
wp_reset_postdata();
?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" data-aos="fade-up">
                <div class="owl-carousel dots-overlap wide-slider">
<?php
    if (get_post_meta(get_the_ID(), 'page-slider', false)){
        $pageSlider = get_post_meta(get_the_ID(), 'page-slider', false);
    }
    foreach ($pageSlider as $slider){
        $fulimg = pods_image_url($slider, 'large');
        echo '<div class="item"><img src="'.$fulimg.'"  class="img-fluid"></div>';
    }
?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="templateux-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix mb-5" data-aos="fade-up">
                <h2>We Are Experts</h2>
            </div>
        </div>
        <div class="row">
<?php
$posts = get_posts(array(
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'ASC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  => '',
    'post_type'   => 'expert-adv',
    'suppress_filters' => true,
));
foreach($posts as $post){
    setup_postdata($post);
    ?>
    <div class="col-md-4"  data-aos="fade-up" data-aos-delay="100">
        <div class="media templateux-media mb-4">
            <div class="mr-4 icon">
                <span class="<?php echo get_post_meta(get_the_ID(), 'adv-icon', true) ?> display-3"></span>
            </div>
            <div class="media-body">
                <h3 class="h5"><?php the_title();?></h3>
                <p><?php the_content();?></p>
            </div>
        </div>
    </div>
    <?php
}
wp_reset_postdata();
?>
        </div>
    </div>
</section>
<?php get_footer();?>