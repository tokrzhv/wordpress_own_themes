<a class="templateux-section templateux-cta animsition-link mt-5" href="/contact/" data-aos="fade-up">
    <div class="container-fluid">
        <div class="cta-inner">
            <h2><span class="words-1">Start a Project.</span> <span class="words-2">Let's chat we are good people.</span></h2>
        </div>
    </div>
</a>
<footer class="templateux-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-md-left text-center">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                </p>
            </div>
            <div class="col-md-6 text-md-right text-center footer-social">
<?php
$posts = get_posts(array(
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  => '',
    'post_type'   => 'social',
    'suppress_filters' => true,
));
foreach($posts as $post){
    setup_postdata($post);
    ?>
                 <a href="<?php echo get_post_meta(get_the_ID(), 'link', true)?>" class="p-3" target="_blank">
                     <span class="icon-<?php the_title();?>"></span></a>
<?php
}
wp_reset_postdata();
?>
            </div>
        </div>
    </div>
</footer>
</div>

<?php wp_footer();?>
</body>
</html>