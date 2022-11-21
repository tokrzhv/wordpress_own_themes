<footer class="footer">
    <div class="container footer__container">
        <?php if(is_front_page()) { ?>
            <a class="logo footer__logo">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/logo.svg" alt="Логотип Блога"></a>
        <?php } else {  ?>
            <a  href="<?php echo home_url();?>" class="logo footer__logo">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/logo.svg" alt="Логотип Блога"></a>
        <?php } ?>
        <nav class="nav menu-nav">
            <?php wp_nav_menu(['container' => '']);?>
        </nav>
        <small class="footer__copy">Create by tkrzh 2022.</small>
    </div>
</footer>
<?php if (is_search() or is_404()){ ?>
</div>
<?php }
wp_footer(); ?>
</body>
</html>