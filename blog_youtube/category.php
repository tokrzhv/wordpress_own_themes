<?php get_header(); ?>
<main class="main">
    <section class="category-banner">
        <h1 class="category-banner__title">
            <?php
                $category = get_the_category();
                echo $category[0] -> cat_name;
            ?>
        </h1>
    </section>
    <section class="content">
        <h2 class="visually-hidden"><?php the_title();?></h2>
        <div class="container content__container">
            <div class="posts">
                <ul class="post-grid list-reset">
                    <?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
                    <li class="post-grid__item">
                        <article class="blog-post">
                            <?php
                            $category = get_the_category();
                            $cat_link = get_category_link( $category[0]);
                            ?>
                            <a href="<?php echo $cat_link; ?>" class="blog-post__category">
                                <?php echo $category[0]->cat_name; ?></a>
                            <h3 class="blog-post__title blog-title">
                                <a href="<?php the_permalink();?>" class="blog-post__link">
                                    <?php the_title();?></a>
                            </h3>
                            <p class="blog-post__descr"><?php echo get_the_excerpt();?></p>
                            <time class="blog-post__date"><?php the_date('j M Y'); ?></time>
                        </article>
                    </li>
                    <?php } } else { echo "<p> no records</p>"; }?>
                </ul>
                <?php echo custom_pagination();?>
            </div>
            <?php get_sidebar();?>
        </div>
    </section>
</main>
<?php get_footer(); ?>