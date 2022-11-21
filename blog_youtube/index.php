<?php get_header(); ?>
<main class="main">
    <section class="banner">
        <h1 class="visually-hidden">Site blog</h1>
    </section>
    <section class="content">
        <h2 class="visually-hidden">Our blog articles </h2>
            <div class="container content__container">
                <div class="posts">
<!--  out banner post -->
<?php
    $rezult = wp_get_recent_posts([
            'numberposts'     => 1,
            'offset'          => 0,
            'category'        => 0,
            'orderby'         => 'post_date',
            'post_type'       => 'post',
            'suppress_filter' => true,
    ], OBJECT);
    foreach ($rezult as $post){
        setup_postdata( $post); ?>
            <article class="blog-post blog-post--main">
                <?php
                    $category = get_the_category();
                    $cat_link = get_category_link($category[0]);
                ?>
                <a href="<?php echo $cat_link ?>" class="blog-post__category">
                    <?php $category[0] -> cat_name?>
                </a>
                <h3 class="blog-post__title blog-title">
                    <a href="<?php the_permalink();?>" class="blog-post__link">
                        <?php the_title()?>
                    </a>
                </h3>
                <p class="blog-post__descr">
                    <?php echo get_the_excerpt()?>
                </p>
                <time class="blog-post__date"><?php the_date('j M Y')?></time>
            </article>
        <?php }
                wp_reset_postdata(); ?>
                    <ul class="post-grid list-reset">
                    <!-- ALL posts-->
                    <?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
                    <li class="post-grid__item">
                        <article class="blog-post">
                            <?php
                            $category = get_the_category();
                            $cat_link = get_category_link( $category[0]);
                            ?>
                            <a href="<?php echo $cat_link; ?>" class="blog-post__category">
                                <?php echo $category[0]->cat_name; ?>
                            </a>
                            <h3 class="blog-post__title blog-title">
                                <a href="<?php the_permalink();?>" class="blog-post__link">
                                    <?php the_title();?>
                                </a>
                            </h3>
                            <p class="blog-post__descr">
                                <?php echo get_the_excerpt();?>
                            </p>
                            <time class="blog-post__date"><?php the_date('j M Y'); ?></time>
                        </article>
                            </li>
                    <?php } } else { echo "<p> no records</p>";  }?>
                    </ul>
    <?php echo custom_pagination();?>
                </div>
    <?php get_sidebar();?>
            </div>
    </section>
</main>
<?php get_footer(); ?>