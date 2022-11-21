<?php  get_header();
       $options = get_option('booking_settings_options');
       $instance = new TkBooking();
       $templates = new Tkbooking_Template_Loader();
?>

<div class="wrapper">
    <div class="booking_rooms">
        <?php  if (isset($options['title_for_rooms'])) echo "<h1>".$options['title_for_rooms']."</h1>";?>
        <div class="filter">
            <form method="post" action="<?php echo get_post_type_archive_link('room');?>">
                <select name="location_op">
                    <option value=""><?php esc_html_e('Select location', 'tkbooking')?></option>
                    <?php
                        $instance -> get_terms_hierarchical('location', $_POST['location_op']);
                    ?>
                </select>
                <select name="type_op">
                    <option value=""><?php esc_html_e('Select type', 'tkbooking')?></option>
                    <?php
                    $instance -> get_terms_hierarchical('type', $_POST['type_op']);
                    ?>
                </select>
                <input type="text" name="price_down" value="<?php if(isset($_POST['price_down'])){echo esc_attr($_POST['price_down']);}?>" />
                <input type="text" name="price_up" value="<?php if(isset($_POST['price_up'])){echo esc_attr($_POST['price_up']);}?>" />
                <input type="number" name="beds" value="<?php if(isset($_POST['beds'])){echo esc_attr($_POST['beds']);}?>" placeholder="Min Beds"/>
                <input type="submit" name="submit" value="<?php esc_html_e('Filter', 'tkbooking')?>"/>
            </form>
        </div>
    <?php
        $posts_per_page = -1;
        if ($options['posts_per_page']){
            $posts_per_page = $options['posts_per_page'];
        }
        $args = [
            'post_type' => 'room',
            'posts_per_page' => -1,
            'tax_query' => array('relation' => 'AND'),
            'meta_query' =>array('relation' => 'AND'),
        ];

        if (isset($_POST['beds']) && $_POST['beds']!=''){
            array_push($args['meta_query'], array(
               'key' => 'tkbooking_beds_count',
               'value' => esc_attr($_POST['beds']),
               'type' => 'numeric',
               'compare' => '>='
            ));
        }

        if (isset($_POST['price_down']) && $_POST['price_up']){
            array_push($args['meta_query'], array(
                'key' => 'tkbooking_price',
                'value' => [$_POST['price_down'], $_POST['price_up']],
                'type' => 'numeric',
                'compare' => 'BETWEEN'
            ));}

        if (isset($_POST['location_op']) && $_POST['location_op']!=''){
            array_push($args['tax_query'], array(
                'taxonomy' => 'location',
                'terms' => $_POST['location_op'],
            ));}

        if (isset($_POST['type_op']) && $_POST['type_op']!=''){
            array_push($args['tax_query'], array(
                'taxonomy' => 'type',
                'terms' => $_POST['type_op'],
            ));}

         if (!empty($_POST['submit'])){
             //on submit
                $search_listing = new WP_Query($args);

             if ($search_listing -> have_posts()){
                 while ($search_listing -> have_posts()){
                     $search_listing -> the_post();
                     $templates -> get_template_part('content','room');
                     }
             }else{
                 echo esc_html__('No posts', 'tkbooking');
             }
         }else{
             $paged = 1;
             if (get_query_var('paged')){ $paged = get_query_var('paged');}
             if (get_query_var('page')){$paged =get_query_var('page');}

             $default_listing = [
                 'post_type' => 'room',
                 'posts_per_page' => esc_attr($posts_per_page),
                 'paged' => $paged,
             ];
             $rooms_listing = new WP_Query($default_listing);

             if ($rooms_listing -> have_posts()){
                 while ($rooms_listing -> have_posts()){
                     $rooms_listing -> the_post();
                     $templates -> get_template_part('content', 'room');
                    }

                 $big = 999999999; // need an unlikely integer
                 echo paginate_links( array(
                     'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                     'format' => '?paged=%#%',
                     'current' => max( 1, get_query_var('paged') ),
                     'total' => $rooms_listing->max_num_pages
                 ) );

             }else{
                 echo esc_html__('No posts', 'tkbooking');
             }
         }
    ?>
    </div>
</div>

<?php  get_footer(); ?>