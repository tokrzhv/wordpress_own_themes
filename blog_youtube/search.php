<?php get_header();  ?>
<main class="main">
    <section class="search-blocks">
        <div class="container search-blocks__container">
            <?php if (have_posts()) { ?>
                <h1 class="search-blocks__title blog-title">Results</h1>
                <div class="posts">
                    <ul class="post-grid list-reset">
                        <?php if( have_posts() ) : while( have_posts()) : the_post(); ?>
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
                        <?php endwhile; endif;?>
                    </ul>
                    <?php echo custom_pagination();?>
                </div>
            <?php } else { ?>
                <h1 class="search-blocks__title blog-title">Results</h1>
                <span class="not-found-text">not found</span>
            <?php } ?>
    </section>
</main>
<?php get_footer(); ?>