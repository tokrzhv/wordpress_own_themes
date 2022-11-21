<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>
    <main class="main">
        <section class="not-found">
            <h1 class="visually-hidden">Page not found</h1>
            <div class="container not-found__container">
                <img src="assets/img/404.png" alt="" aria-hidden="true" class="not-found__img">
                <h2 class="not-found__title blog-title">Something is wrong</h2>
                <a href="<?php echo home_url(); ?>" class="not-found__back">
                    <span>Go to home page</span>
                </a>
            </div>
        </section>
    </main>
<?php get_footer(); ?>