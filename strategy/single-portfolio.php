<?php get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>

<section class="templateux-hero"  data-scrollax-parent="true">
    <div class="container">
        <div class="row align-items-center justify-content-center intro">
            <div class="col-md-10" data-aos="fade-up">
                <h1><?php the_title();?></h1>
                <a href="#next" class="go-down js-smoothscroll"></a>
            </div>
        </div>
    </div>
</section>

<section class="templateux-portfolio-overlap mb-5" id="next">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row work-detail">
                    <div class="col-md-4 ">
                        <span class=caption>Role</span>
                        <strong>Strategy & Design</strong>
                    </div>
                    <div class="col-md-4">
                        <span class=caption>Team</span>
                        <strong>John Smith, Chris Gold</strong>
                    </div>
                    <div class="col-md-4">
                        <span class=caption>Company</span>
                        <strong>Tote Bag Co.</strong>
                    </div>
                </div>

                <p class="text-center mb-5"><img src="<?php echo get_the_post_thumbnail_url();?>" alt="Image placeholder" class="img-fluid"></p>

                <div class="row mb-5">
                    <div class="col-md-12">
                        <p><?php the_content();?></p>
                    </div>
                </div>
                <p class="text-center"><a href="#" class="button button--red">Visit Website</a></p>
            </div>
        </div>
    </div>
</section>

<section class="testimony">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php
                $ceo = get_post(152);
                $title = $ceo -> post_title;
                $content = $ceo -> post_content;
                echo '<blockquote class="mb-5"><p>'.$content.'</p></blockquote>';
                echo '<p class="author">&mdash; <span>'.$title.'</span></p>';
                ?>
            </div>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>
<?php get_footer();?>
