<?php

namespace TailPress;

use WP_Query;

class ContentQuery
{
    public static function get_by_category($category, $args = []): WP_Query
    {
        return new WP_Query(wp_parse_args($args, [
            'post_type' => 'post',
            'posts_per_page' => 6,
            'category_name' => is_numeric($category) ? '' : $category,
            'cat' => is_numeric($category) ? $category : '',
        ]));
    }

    public static function get_by_tag($tag, $args = []): WP_Query
    {
        return new WP_Query(wp_parse_args($args, [
            'post_type' => 'post',
            'posts_per_page' => 6,
            'tag' => is_numeric($tag) ? '' : $tag,
            'tag_id' => is_numeric($tag) ? $tag : '',
        ]));
    }

    public static function get_pages(array $slugs_or_ids, $args = []): WP_Query
    {
        $is_numeric = is_numeric($slugs_or_ids[0] ?? '');

        return new WP_Query(wp_parse_args($args, [
            'post_type' => 'page',
            $is_numeric ? 'post__in' : 'post_name__in' => $slugs_or_ids,
            'orderby' => 'post__in',
            'posts_per_page' => count($slugs_or_ids),
        ]));
    }

    public static function get_by_post_type(string $post_type, array $args = []): WP_Query
    {
        return new WP_Query(wp_parse_args($args, [
            'post_type' => $post_type,
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
        ]));
    }

    public static function get_from_jet(array $map = [], $context_id = null): WP_Query
    {
        $args = [];

        foreach ($map as $meta_key => $query_key) {
            $value = $context_id ? get_post_meta($context_id, $meta_key, true) : get_option($meta_key);
            if ($value) {
                $args[$query_key] = $value;
            }
        }

        $post_type = $args['post_type'] ?? 'post';
        unset($args['post_type']);

        return self::get_by_post_type($post_type, $args);
    }


    public static function get_from_acf(array $map = [], $acf_context = null): WP_Query
    {
        $args = [];

        foreach ($map as $acf_key => $query_key) {
            $value = get_field($acf_key, $acf_context);
            if ($value) {
                $args[$query_key] = $value;
            }
        }

        $post_type = $args['post_type'] ?? 'post';
        unset($args['post_type']);

        return self::get_by_post_type($post_type, $args);
    }


    public static function acf($field_name, $post_id = null)
    {
        return function_exists('get_field') ? get_field($field_name, $post_id) : null;
    }
}
