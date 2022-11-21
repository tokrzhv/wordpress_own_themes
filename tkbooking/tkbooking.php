<?php
/**
* Plugin name: TkBooking
* Description: scx
* Author: tkrzh
* Version: 1.0
* Text Domain: tkbooking
* Domain Path: /lang
*/

if (!defined('ABSPATH')){
    die(404);
}
//load templates
define( 'TKBOOKING_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( !class_exists( 'Gamajo_Template_Loader' ) ) {
    require TKBOOKING_PLUGIN_DIR. 'includes/class-gamajo-template-loader.php';
}
require TKBOOKING_PLUGIN_DIR.'includes/class-tkbooking-template-loader.php';

require_once TKBOOKING_PLUGIN_DIR . 'includes/meta-box-class/class-tkbooking-meta-boxes.php';
if (is_admin()){
    $prefix = 'tkbooking_';

    $config = array(
        'id'             => 'tkbooking_settings_room_1',          // meta box id, unique per meta box
        'title'          => 'Simple Meta Box fields',          // meta box title
        'pages'          => array('post', 'page', 'room'),      // post types, accept custom post types as well, default is array('post'); optional
        'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
        'priority'       => 'high',            // order of meta box: high (default), low; optional
        'fields'         => array(),            // list of meta fields (can be added by field arrays)
        'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

     // Initiate your meta box
    $room_meta =  new AT_Meta_Box($config);

    //Add fields to your meta box
    $room_meta->addText($prefix.'beds_count',array('name'=> esc_html__('Beds count ', 'tkbooking')));

    /*
    //textarea field
    $my_meta->addTextarea($prefix.'textarea_field_id',array('name'=> 'My Textarea '));
    //checkbox field
    $my_meta->addCheckbox($prefix.'checkbox_field_id',array('name'=> 'My Checkbox '));
    //select field
    $my_meta->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> 'My select ', 'std'=> array('selectkey2')));
    //radio field
    $my_meta->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> 'My Radio Filed', 'std'=> array('radionkey2')));
    //Image field
    $my_meta->addImage($prefix.'image_field_id',array('name'=> 'My Image '));
    //file upload field
    $my_meta->addFile($prefix.'file_field_id',array('name'=> 'My File'));
    //file upload field with type limitation
    $my_meta->addFile($prefix.'file_pdf_field_id',array('name'=> 'My File limited to PDF Only','ext' =>'pdf','mime_type' => 'application/pdf'));
*/
    $room_meta->Finish();
}

class TkBooking
{
    public function register(){
        add_action('init', [$this, 'custom_post_type']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_front']);
        add_filter('template_include', [$this, 'room_template']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_filter('plugin_action_links_'.plugin_basename(__FILE__), [$this, 'add_plugin_setting_link']);
        add_action('admin_init', [$this, 'settings_init']);
        add_action('admin_menu', [$this, 'add_meta_box_for_room']);
        add_action('save_post', [$this, 'save_metadata'], 10, 2); // 2-> parameter
    }

    public function add_meta_box_for_room(){
        add_meta_box(
            'tkbooking_rooms',
            'Room Settings',
            [$this, 'meta_box_html'],
            'room',
            'normal',
            'default'
        );
    }
    public function meta_box_html($post){
        $price = get_post_meta($post->ID, 'tkbooking_price', true);
        $size = get_post_meta($post->ID, 'tkbooking_size', true);

        //addition protection
        wp_nonce_field('tkbookingnoncefield', '_tkbooking');
        echo '<table class="form-table">
            <tbody>
               <tr>
                  <th><label for="tkbooking_price">'.esc_html__('Room Price', 'tkbooking').'</label></th>
                  <td><input type="text" id="tkbooking_price" name="tkbooking_price" value="'.esc_attr($price).'" /></td>
               </tr>
                <tr>
                  <th><label for="tkbooking_size">'.esc_html__('Room Size', 'tkbooking').'</label></th>
                  <td><input type="text" id="tkbooking_size" name="tkbooking_size" value="'.esc_attr($size).'" /></td>
               </tr>
            </tbody></table>';
    }

    public function save_metadata($post_id, $post){
        //check nonce fields
        if(!isset($_POST['_tkbooking']) || !wp_verify_nonce($_POST['_tkbooking'], 'tkbookingnoncefield')){
            return $post_id;}
        //if is not autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
            return $post_id;}
        //check post_type
        if ($post->post_type != 'room'){
            return $post_id;}
        //if user has permission
        $post_type = get_post_type_object($post->post_type);
        if (!current_user_can($post_type->cap->edit_post, $post_id)){
            return $post_id;
        }
        if (is_null($_POST['tkbooking_price'])){
            delete_post_meta($post_id, 'tkbooking_price');
        }else{
            update_post_meta($post_id, 'tkbooking_price', sanitize_text_field(intval($_POST['tkbooking_price'])));}

        if (is_null($_POST['tkbooking_size'])){
            delete_post_meta($post_id, 'tkbooking_size');
        }else{
            update_post_meta($post_id, 'tkbooking_size', sanitize_text_field(intval($_POST['tkbooking_size'])));}

        return $post_id;
    }

    public function get_terms_hierarchical($tax_name, $current_term){
        $taxonomy_terms = get_terms($tax_name, ['hide_empty'=>false, 'parent'=>0]);
        if(!empty($taxonomy_terms)){
            foreach ($taxonomy_terms as $term){
                if ($current_term == $term->term_id){
                    echo '<option value="'.$term->term_id.'" selected>'.$term->name.'</option>';
                }else{
                    echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
                }
                $child_terms = get_terms($tax_name, ['hide_empty' => false, 'parent' => $term->term_id]);
                if (!empty($child_terms)){
                    foreach ($child_terms as $child){
                        echo '<option value="'.$child->term_id.'">--'.$child->name.'</option>';
                    }
                }
            }
        }
    }

    //register settings
    public function settings_init(){
        register_setting('booking_settings', 'booking_settings_options');
        add_settings_section('booking_settings_section', esc_html__('Settings', 'tkbooking'), [$this, 'settings_section_html'], 'tkbooking_settings');
        add_settings_field('post_per_page', esc_html__('Posts per page', 'tkbooking'), [$this, 'posts_per_page_html'], 'tkbooking_settings', 'booking_settings_section');
        add_settings_field('title_for_rooms', esc_html__('Archive page title', 'tkbooking'), [$this, 'title_for_rooms_html'], 'tkbooking_settings', 'booking_settings_section');
    }
    public function settings_section_html(){
        echo esc_html__('This you can setting next fields', 'tkbooking');
    }
    public function posts_per_page_html(){
        $options = get_option('booking_settings_options') ?>
        <input type="text" name="booking_settings_options[posts_per_page]" value="<?php echo isset($options['posts_per_page']) ?  $options['posts_per_page'] : ""; ?>" />
    <?php }
    public function title_for_rooms_html(){
        $options = get_option('booking_settings_options') ?>
        <input type="text" name="booking_settings_options[title_for_rooms]" value="<?php echo isset($options['title_for_rooms']) ?  $options['title_for_rooms'] : ""; ?>" />
    <?php }


    public function add_admin_menu(){
        add_menu_page(
            esc_html__('TkBooking Settings Page', 'tkbooking'),
            esc_html__('TkBooking', 'tkbooking'),
            'manage_options',
            'tkbooking_settings',
            [$this, 'tkbooking_page'],
            'dashicons-admin-multisite',
            100
        );
    }

    //tkbooking Admin Html
    public function tkbooking_page(){
        require_once plugin_dir_path(__FILE__).'admin/admin.php';
    }
    // add setting link to plugin page
    public function add_plugin_setting_link($link){
        $custom_link = '<a href="admin.php?page=tkbooking_settings">'.esc_html__('Setting', 'tkbooking').'</a>';
        array_push($link, $custom_link);
        return $link;
    }

    //custom template for room // check for replaced file our plugin
    public function room_template($template){
        if (is_post_type_archive('room')){
            $theme_files = ['archive-room.php', 'tkbooking/archive-room.php'];//search same file name in users theme
            $exist_in_theme = locate_template($theme_files, false); //check for exist of this file in users theme
            if ($exist_in_theme != ''){
                return $exist_in_theme; // if files exist we use them
            }else{
                return plugin_dir_path(__FILE__).'templates/archive-room.php'; //use our files
            }
        }
        return $template;
    }

    public function enqueue_admin(){
        wp_enqueue_style('tkbookingstyle', plugins_url('/assets/admin/style.css', __FILE__));
        wp_enqueue_script('tkbookingscript', plugins_url('/assets/admin/script.js', __FILE__));
    }
    public function enqueue_front(){
        wp_enqueue_style('tkbookingstyle', plugins_url('/assets/front/style.css', __FILE__));
        wp_enqueue_script('tkbookingscript', plugins_url('/assets/front/script.js', __FILE__));
    }

    public function custom_post_type(){
        register_post_type('room',
        [
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'rooms'],
            'label' => esc_html__('Room', 'tkbooking'),
            'supports' => ['title', 'editor', 'thumbnail']
        ]
        );

        //add
        $labels = array(
            'name'              => _x( 'Location', 'taxonomy general name', 'tkbooking' ),
            'singular_name'     => _x( 'Location', 'taxonomy singular name', 'tkbooking' ),
            'search_items'      => __( 'Search Location', 'tkbooking' ),
            'all_items'         => __( 'All Location', 'tkbooking' ),
            'parent_item'       => __( 'Parent Location', 'tkbooking' ),
            'parent_item_colon' => __( 'Parent Location:', 'tkbooking' ),
            'edit_item'         => __( 'Edit Location', 'tkbooking' ),
            'update_item'       => __( 'Update Location', 'tkbooking' ),
            'add_new_item'      => __( 'Add New Location', 'tkbooking' ),
            'new_item_name'     => __( 'New Location Name', 'tkbooking' ),
            'menu_name'         => __( 'Location', 'tkbooking' ),
        );
        $args = array(
            'hierarchical'      => true, //subcategories
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'room/location' ),
        );
        register_taxonomy('location', 'room', $args);

        $labels_type = array(
            'name'              => _x( 'Types', 'taxonomy general name', 'tkbooking' ),
            'singular_name'     => _x( 'Type', 'taxonomy singular name', 'tkbooking' ),
            'search_items'      => __( 'Search Type', 'tkbooking' ),
            'all_items'         => __( 'All Type', 'tkbooking' ),
            'parent_item'       => __( 'Parent Type', 'tkbooking' ),
            'parent_item_colon' => __( 'Parent Type:', 'tkbooking' ),
            'edit_item'         => __( 'Edit Type', 'tkbooking' ),
            'update_item'       => __( 'Update Type', 'tkbooking' ),
            'add_new_item'      => __( 'Add New Type', 'tkbooking' ),
            'new_item_name'     => __( 'New Type Name', 'tkbooking' ),
            'menu_name'         => __( 'Type', 'tkbooking' ),
        );
        $args_type = array(
            'hierarchical'      => false, //child_category
            'labels'            => $labels_type,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'room/location' ),
        );
        register_taxonomy('type', 'room', $args_type);
    }

    static function activation(){
        flush_rewrite_rules();
    }
    static function deactivation(){
        flush_rewrite_rules();
    }
}

if (class_exists('TkBooking')){
    $tkBooking = new TkBooking();
    $tkBooking -> register();
}

register_activation_hook(__FILE__, array('tkBooking', 'activation'));
register_deactivation_hook(__FILE__, array('tkBooking', 'deactivation'));