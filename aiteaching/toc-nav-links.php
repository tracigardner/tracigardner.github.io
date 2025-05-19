<?php
/**
 * Plugin Name: TOC Navigation Links
 * Description: Adds Next and Previous links based on a TOC-style custom menu.
 * Version: 1.0
 * Author: Your Name
 */

add_filter('the_content', 'toc_nav_links_append');

function toc_nav_links_append($content) {
    if (!is_page()) return $content;

    // Replace 'toc-menu' with your actual menu slug
    $menu_name = 'toc-menu';
    $locations = get_nav_menu_locations();

    if (!isset($locations[$menu_name])) return $content;

    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    if (!$menu_items) return $content;

    // Create an ordered list of page/post IDs
    $ordered_ids = array_map(function($item) {
        return (int) $item->object_id;
    }, $menu_items);

    $current_id = get_the_ID();
    $current_index = array_search($current_id, $ordered_ids);

    if ($current_index === false) return $content;

    $prev_link = $next_link = '';

    if ($current_index > 0) {
        $prev_id = $ordered_ids[$current_index - 1];
        $prev_link = '<a href="' . get_permalink($prev_id) . '" class="toc-nav-prev" style="margin-right:20px;">&laquo; Previous</a>';
    }

    if ($current_index < count($ordered_ids) - 1) {
        $next_id = $ordered_ids[$current_index + 1];
        $next_link = '<a href="' . get_permalink($next_id) . '" class="toc-nav-next">Next &raquo;</a>';
    }

    $nav_html = '<div class="toc-nav" style="margin-top:40px;">' . $prev_link . $next_link . '</div>';

    return $content . $nav_html;
}
