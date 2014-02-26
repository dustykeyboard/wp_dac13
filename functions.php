<?php

add_action( 'after_setup_theme', 'dac13_setup' );
function dac13_setup(){
	add_theme_support( 'post-formats', array( 'audio' ) );
	add_theme_support( 'post-thumbnails' );
	register_nav_menu( 'primary', 'Primary Menu' );
	add_image_size( 'tiny', 150, 75, true );
	add_image_size( 'feature', 480, 240, true );
	add_image_size( 'full', 600, 300, true );
	add_image_size( 'promotion', 960, 480, true );
}

add_action( 'init', 'create_post_types' );
function create_post_types() {
	register_post_type( 'promotion',
		array(
			'labels' => array(
				'name' => __( 'Promotions' ),
				'singular_name' => __( 'Promotion' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'thumbnail')
		)
	);
}

function new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Custom link field for promotions. src: http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-1-intro-and-basic-fields/

// Add the Meta Box  
function add_custom_meta_box() {  
    add_meta_box(  
        'promotion_link', // $id  
        'Promotion Link', // $title   
        'show_promotion_url_box', // $callback  
        'promotion', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_custom_meta_box');  

$custom_meta_fields = array(  
    array(  
        'label'=> 'Promotion Link',  
        'desc'  => 'Link for this promotion.',  
        'id'    => 'promotion_link',  
        'type'  => 'text'
    )
); 

// The Callback  
function show_promotion_url_box() {  
	global $custom_meta_fields, $post;  
	// Use nonce for verification  
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
      
    // Begin the field table and loop  
    echo '<table class="form-table">';  
    foreach ($custom_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
		echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /> 
        <br /><span class="description">'.$field['desc'].'</span>';  
        echo '</td></tr>';  
    } // end foreach  
    echo '</table>'; // end table  
}  

// Save the Data  
function save_custom_meta($post_id) {  
    global $custom_meta_fields;  
      
    // verify nonce  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
      
    // loop through fields and save the data  
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_custom_meta');


function dac13_widgets_init() {
	register_sidebar( array(
		'name' => 'Page and single post sidebar',
		'id' => 'page_and_single',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Footer sidebar',
		'id' => 'footer_sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'dac13_widgets_init' );
  
?>