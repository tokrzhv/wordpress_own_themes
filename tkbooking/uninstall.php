<?php

if (!defined('WP_UNINSTALL_PLUGIN')){
    die();
}

//remove all post with post_type('room')  from database
//global $wpdb;
//$wpdb -> query("DELETE FROM {$wpdb->posts} WHERE post_type IN ('room');");

//without access to db ---> more safely
$rooms = get_posts(array('post_type'=>'room', 'number_post'=>-1));
foreach ($rooms as $room){
    wp_delete_post($room->ID, true); // true for all posts
}


//remove meta



//remove tax/terms



//remove comments

