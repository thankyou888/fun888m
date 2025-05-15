<?php

use TailPress\ContentQuery;

$post_type = $attributes['post_type'] ?? 'bonus';
$limit = $attributes['posts_per_page'] ?? 3;

$query = ContentQuery::get_by_post_type($post_type, [
    'posts_per_page' => $limit
]);

if ($query->have_posts()) :
    echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-6">';
    while ($query->have_posts()) :
        $query->the_post();

        $title = get_the_title();
        $desc = get_post_meta(get_the_ID(), 'bonus_description', true);
        $is_new = get_post_meta(get_the_ID(), 'is_new', true);
        $image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://via.placeholder.com/1200x630';
        $link = get_permalink();

        echo '<div class="bg-white rounded-2xl shadow p-4 text-center">';
        echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '" class="w-full aspect-[1200/630] object-cover rounded-lg mb-4">';
        echo '<h3 class="font-bold text-lg mb-1">' . esc_html($title);
        if ($is_new) {
            echo ' <span class="inline-block ml-2 text-xs bg-pink-700 text-white px-2 py-1 rounded">NEW</span>';
        }
        echo '</h3>';
        echo '<p class="text-gray-600 text-sm mb-4">' . esc_html($desc) . '</p>';
        echo '<a href="' . esc_url($link) . '" class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-xl hover:bg-blue-600 transition">Claim Now</a>';
        echo '</div>';

    endwhile;
    echo '</div>';
    wp_reset_postdata();
else :
    echo '<p class="text-gray-500 text-center">No bonus offers found.</p>';
endif;
