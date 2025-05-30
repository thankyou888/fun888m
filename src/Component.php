<?php

namespace TailPress;

use WP_Query;

class Component
{
    public const SVG_PREV = ''; // เติม SVG ถ้ามี
    public const SVG_NEXT = '';

    public static function render(?WP_Query $query = null, array $args = []): void
    {
        echo 'Not Found';
    }

    public static function create_feature(?WP_Query $query = null, array $args = []): void
    {
        if (!$query) {
            // รองรับ slug filter
            if (!empty($args['slug__in']) && is_array($args['slug__in'])) {
                $args['post_name__in'] = $args['slug__in'];
                unset($args['slug__in']);
            }

            $args = wp_parse_args($args, [
                'posts_per_page' => 3,
                'post_type' => 'page',
                'orderby' => 'post__in',
            ]);

            $query = new WP_Query($args);
        }

        if ($query->have_posts()) {
            echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">';
            while ($query->have_posts()) {
                $query->the_post();

                //$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://placehold.co/1200x630';
                //$custom_field = get_field('custom_text_field'); // ACF field

                echo '<div class="bg-info text-info-content p-4 items-center text-center">';
                //echo '<img src="' . esc_url($thumbnail) . '" alt="' . get_the_title() . '" class="w-full aspect-[1200/630] object-cover">';
                echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full aspect-[1200/630] object-cover rounded', 'loading' => 'lazy']);
                echo '<a href="'. get_permalink() .'"><h2 class="block text-xl font-bold mb-2 p-4 bg-sky-700 w-full">' . get_the_title() . '</h2></a>';

                echo '</div>';
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p class="text-center text-gray-500">ไม่พบข้อมูล</p>';
        }
    }

    public static function get_bonuses(?WP_Query $query = null, array $args = []): void
    {

        $args = wp_parse_args($args, [
            'posts_per_page' => 5,
            'post_type' => 'bonuses',
            'orderby' => 'post__in',
        ]);

        $query = new WP_Query($args);
        echo 'Not Found';
    }

    public static function get_postByCat(?WP_Query $query = null, array $args = []): void
    {

        $args = wp_parse_args($args, [
            'posts_per_page' => 5,
            'post_type' => 'bonuses',
            'orderby' => 'post__in',
        ]);

        $query = new WP_Query($args);
        echo 'Not Found';
    }
}
