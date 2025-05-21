<?php
/**
 * Plugin Name: TOC Navigation Shortcode
 * Description: Adds a shortcode [toc_nav menu="Your Menu Name"] for Previous/Next links based on custom menu order.
 * Version: 1.1
 * Author: Your Name
 */

defined('ABSPATH') || exit;

function toc_nav_shortcode($atts) {
    $a = shortcode_atts([
        'menu' => ''
    ], $atts);

    if (empty($a['menu']) || !is_page()) {
        return '';
    }

    $menu = wp_get_nav_menu_object($a['menu']);
    if (!$menu) {
        return '';
    }

    $menu_items = wp_get_nav_menu_items($menu->term_id);
    if (!$menu_items || !is_array($menu_items)) {
        return '';
    }

    $ordered_ids = array();
    foreach ($menu_items as $item) {
        if ($item->object === 'page') {
            $ordered_ids[] = (int) $item->object_id;
        }
    }

    $current_id = get_the_ID();
    $current_index = array_search($current_id, $ordered_ids);

    if ($current_index === false) {
        return '';
    }

    $prev_link = $next_link = '';

    if ($current_index > 0) {
        $prev_id = $ordered_ids[$current_index - 1];
        $prev_link = '<a href="' . esc_url(get_permalink($prev_id)) . '" class="toc-nav-prev" style="margin-right:20px;">&laquo; Previous</a>';
    }

    if ($current_index < count($ordered_ids) - 1) {
        $next_id = $ordered_ids[$current_index + 1];
        $next_link = '<a href="' . esc_url(get_permalink($next_id)) . '" class="toc-nav-next">Next &raquo;</a>';
    }

    return '<div class="toc-nav" style="margin-top:40px;">' . $prev_link . $next_link . '</div>';
}

add_shortcode('toc_nav', 'toc_nav_shortcode');
