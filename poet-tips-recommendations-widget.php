<?php
/*
Plugin Name: Poet Tips Recommendations Widget
Plugin URI: http://www.poet.tips/
Description: Makes recommendations of related poets using a shortocde, tags or categories
Author: Robert Peake
Version: 2.0.5
Author URI: http://www.robertpeake.com/
*/
if ( ! defined( 'WPINC' ) ) {
    die();
}

class pt_rec_widget extends WP_Widget {

    function __construct() {
        parent::__construct('pt_rec_widget', __('Poet Tips Recommendations', 'pt_rec'), array( 'description' => __( 'Displays recommended poets on category and tag pages', 'pt_rec' ), ) );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // Maintain forwards-compatability with new template for 2D/3D display
        $method = '';
        $show_title = true;

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if (is_tag()) {
            $poet = single_tag_title("", false);
        } else if (is_category()) {
            $poet = get_query_var( 'cat' );
        } else if (is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $poet = $term->name;
        }
        if (isset($poet) && strlen($poet) > 0) {
            $url = trailingslashit('http://poet.tips/poet/' . pt_urlify($poet));
            $type = 'list';
            include 'template.php';
        }
        echo $args['after_widget'];
    }
}

if (!function_exists('pt_urlify')) {
    function pt_urlify( $string ) {
       return rawurlencode(strtolower(str_replace(' ','_',$string)));
    }
}

function pt_load_widget() {
    register_widget( 'pt_rec_widget' );
}

function pt_shortcode($atts) {
    $atts = shortcode_atts( array(
                'name' => '',
                'type' => '2d',
                'show_title' => false,
            ), $atts, 'poettips' );
    $return = '';
    $poet = filter_var(trim($atts['name']),FILTER_SANITIZE_STRING);
    $show_title = (bool)$atts['show_title'];
    // Get random poet if none specified
    if (strlen($poet) == 0) {
        $call = wp_remote_get('http://poet.tips/api/random/');
        $resp = json_decode(wp_remote_retrieve_body($call),true);
        if (isset($resp[0])) {
            $poet = $resp[0];
        }
    }
    // If random poet API call fails, fall back to our most popular poet
    if (strlen($poet) == 0) {
        $poet = 'Charles Bukowski';
    }
    $method = '';
    $url = trailingslashit('http://poet.tips/poet/' . pt_urlify($poet));
    switch(strtolower($atts['type'])) {
        case 'list':
        case '1d':
        case '1-d':
            $type = 'list';
            break;
        case '3d':
        case '3-d':
            $type ='iframe';
            $method = 'jgraph';
            break;
        case '2d':
        case '2-d':
        default:
            $type = 'iframe';
            $method = 'vis';
            break;
    }
    ob_start();
    include 'template.php';
    $return = ob_get_contents();
    ob_end_clean();
    return $return;
}
add_action( 'widgets_init', 'pt_load_widget' );
add_shortcode( 'poettips', 'pt_shortcode' );
