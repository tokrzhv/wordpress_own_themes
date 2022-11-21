<?php get_header();?>
<section class="templateux-hero"  data-scrollax-parent="true">
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

<section class="templateux-portfolio-overlap mb-5" id="next">
    <div class="container-fluid">
        <div class="row">
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
    'post_type'   => 'post', //only experts posts
    'suppress_filters' => true, //suppression of work of filters of change sql of receipt
));
    foreach($posts as $post){
    setup_postdata($post);
    ?>
            <div class="col-md-6" data-aos="fade-up">
                <a class="post animsition-link" href="<?php the_permalink();?>">
                    <figure>
                        <img src="<?php echo get_the_post_thumbnail_url();?>" alt="Free Template" class="img-fluid">
                    </figure>
                    <div class="project-hover">
                        <div class="project-hover-inner">
                            <h2><?php the_title();?></h2>
                            <span><?php echo date('F Y')?></span>
                        </div>
                    </div>
                </a>
            </div>
<?php
}
wp_reset_postdata();
?>
        </div>
        <div class="row pt-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-12 text-center">
                <a href="#" class="button button--red  mb-5">Load More Posts...</a>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>
