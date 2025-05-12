<?php

namespace TailPress;

use WP_Query;

class Bonuses
{
    public const SVG_PREV = ''; // เติม SVG ถ้ามี
    public const SVG_NEXT = '';

    public static function render(?WP_Query $query = null, array $args = []): void
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
            echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';
            while ($query->have_posts()) {
                $query->the_post();

                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://via.placeholder.com/1200x630';
                //$custom_field = get_field('custom_text_field'); // ACF field

                echo '<div class="bg-white rounded-2xl shadow-md p-4 text-center">';
                echo '<img src="' . esc_url($thumbnail) . '" alt="' . get_the_title() . '" class="w-full aspect-[1200/630] object-cover rounded-lg mb-4">';
                echo '<h3 class="font-bold text-lg mb-1">' . get_the_title() . '</h3>';

               

                echo '<a href="' . get_permalink() . '" class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-xl hover:bg-blue-600 transition">Read More</a>';
                echo '</div>';
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p class="text-center text-gray-500">ไม่พบข้อมูล</p>';
        }
    }
}
