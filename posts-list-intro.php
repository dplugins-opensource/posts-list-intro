<?php
/*
Plugin Name: Posts list intro
Description: Adds custom content between the headline and posts table in the admin panel.
Version: 1.0
Author: Your Name
*/

add_action('admin_notices', 'custom_admin_notice');
add_action('admin_enqueue_scripts', 'my_plugin_admin_enqueue_styles');


function custom_admin_notice()
{
    global $pagenow;

    // Check if we are on the 'edit.php' page for posts
    if ($pagenow == 'edit.php' && get_current_screen()->post_type == 'post') {
        // Check if 'category_name' is not set to display the categories
        if (!isset($_GET['category_name'])) {
            $categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC'
            ));

            if (!empty($categories)) {
                echo '<div class="post-category-list">';
                echo '<h1>Select a category:</h1>';
                echo '<ul>';

                foreach ($categories as $category) {
                    $admin_filter_link = admin_url('edit.php?category_name=' . $category->slug);
                    echo '<li><h2><a href="' . esc_url($admin_filter_link) . '">' . esc_html($category->name) . '</a></h2></li>';
                }

                echo '</ul>';
                echo '</div>';
            }
        }
        // If 'category_name' is set, display the back button
        else {
            $all_posts_link = admin_url('edit.php');
            echo '<div class="back-to-all-posts">';
            echo '<a href="' . esc_url($all_posts_link) . '" class="" style="margin-top:1rem; display: inline-block">← Back to All Posts</a>';
            echo '</div>';
        }
    }
}


function my_plugin_admin_enqueue_styles()
{
    global $pagenow;

    // Check if we are on the 'edit.php' page and 'category_name' is not set
    if ($pagenow == 'edit.php' && !isset($_GET['category_name']) && get_current_screen()->post_type == 'post') {
        $css_url = plugins_url('custom-style.css', __FILE__);
        wp_enqueue_style('my-custom-admin-style', $css_url);
    }
}