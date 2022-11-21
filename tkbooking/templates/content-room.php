<article id="post-<?php the_ID();?>" <?php post_class();?> xmlns="http://www.w3.org/1999/html">
    <?php
    if (get_the_post_thumbnail(get_the_ID(), 'large')){
        echo '<div class="image">'.get_the_post_thumbnail(get_the_ID(), 'large').'</div>';
    }
    ?>
    <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
    <div class="description">
        <?php the_excerpt(); ?>
    </div>
    <div class="metabox">
        <?php echo esc_html__('Room Price: ', 'tkbooking'). get_post_meta(get_the_ID(),'tkbooking_price', true)?><br>
        <?php echo esc_html__('Beds Count: ', 'tkbooking'). get_post_meta(get_the_ID(),'tkbooking_beds_count', true)?>
    </div>

    <?php
    $locations = get_the_terms(get_the_ID(), 'location');
    if (!empty($locations)){
        foreach ($locations as $location) {
            echo '<span class="location">'.esc_html__('Location: ', 'tkbooking').$location -> name.'</span>';
        }
    }
    $types = get_the_terms(get_the_ID(), 'type');
    if (!empty($types)){
        foreach ($types as $type) {
            echo '<span class="type">'.esc_html__('Type: ', 'tkbooking').$type -> name.'</span>';
        }
    }
    ?>
</article>