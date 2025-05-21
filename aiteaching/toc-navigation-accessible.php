<?php
/**
 * Plugin Name: TOC Navigation with Accessibility
 * Description: Automatically adds accessible Next/Previous navigation to pages listed in a custom menu.
 * Version: 1.0
 * Author: traci gardner (tengrrl)
 */

defined('ABSPATH') || exit;

function toc_nav_links_auto_append($content) {
    if (!is_page()) return $content;

    $menu_name = 'toc-menu'; // Update this to your menu name or slug
    $menu = wp_get_nav_menu_object($menu_name);

    if (!$menu) return $content;

    $menu_items = wp_get_nav_menu_items($menu->term_id);
    if (!$menu_items || !is_array($menu_items)) return $content;

    $ordered_ids = array();
    foreach ($menu_items as $item) {
        if ($item->object === 'page') {
            $ordered_ids[] = (int) $item->object_id;
        }
    }

    $current_id = get_the_ID();
    $current_index = array_search($current_id, $ordered_ids);
    if ($current_index === false) return $content;

    $prev_link = $next_link = '';

    if ($current_index > 0) {
        $prev_id = $ordered_ids[$current_index - 1];
        $prev_title = get_the_title($prev_id);
        $prev_link = '<a href="' . esc_url(get_permalink($prev_id)) . '" class="toc-nav-prev" aria-label="Go to previous page: ' . esc_attr($prev_title) . '">';
        $prev_link .= '&laquo; Previous<span class="screen-reader-text">: ' . esc_html($prev_title) . '</span></a>';
    }

    if ($current_index < count($ordered_ids) - 1) {
        $next_id = $ordered_ids[$current_index + 1];
        $next_title = get_the_title($next_id);
        $next_link = '<a href="' . esc_url(get_permalink($next_id)) . '" class="toc-nav-next" aria-label="Go to next page: ' . esc_attr($next_title) . '">';
        $next_link .= 'Next &raquo;<span class="screen-reader-text">: ' . esc_html($next_title) . '</span></a>';
    }

    $nav_html = '<nav class="toc-nav-wrapper" role="navigation" aria-label="Table of contents navigation" style="margin-top: 40px;">';
    $nav_html .= $prev_link . $next_link;
    $nav_html .= '</nav>';

    return $content . $nav_html;
}

add_filter('the_content', 'toc_nav_links_auto_append');
