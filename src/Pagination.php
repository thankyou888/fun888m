<?php

namespace TailPress;

use WP_Query;

class Pagination
{
    public const SVG_PREV = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
        <path fill-rule="evenodd" d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
    </svg>';

    public const SVG_NEXT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
        <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>';

    public static function render(?WP_Query $query = null): void
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;
        $original_query = null;

        if ($query) {
            $original_query = $wp_query;
            $wp_query = $query;
        }

        if ($wp_query->max_num_pages <= 1) {
            return;
        }

        $paged = max(1, absint($wp_query->get('paged', 1)));
        $max = (int) $wp_query->max_num_pages;
        $links = self::generate_pagination_links($paged, $max);

        echo '<nav aria-label="Page navigation"><ul class="mt-12 border-t border-light py-6 flex items-center justify-center gap-2">';

        self::render_previous_link($paged, $links);
        self::render_page_links($paged, $links);
        self::render_next_link($paged, $max, $links);

        echo '</ul></nav>';

        if ($original_query) {
            $wp_query = $original_query;
        }
    }

    public static function renderModern(?WP_Query $query = null, array $args = []): void
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;
        $original_query = null;

        if ($query) {
            $original_query = $wp_query;
            $wp_query = $query;
        }

        $total_pages = isset($wp_query->max_num_pages) ? (int) $wp_query->max_num_pages : 0;
        if ($total_pages <= 1) {
            if ($original_query) {
                $wp_query = $original_query;
            }
            return;
        }

        $current_page = max(
            1,
            (int) get_query_var('paged'),
            (int) get_query_var('page'),
            (int) $wp_query->get('paged')
        );

        $settings = wp_parse_args(
            $args,
            [
                'aria_label'   => 'Page navigation',
                'nav_class'    => 'mb-10 rounded-2xl bg-base-100 p-4 md:p-5 shadow-sm',
                'status_class' => 'mb-3 text-center text-sm opacity-70',
                'list_class'   => 'flex flex-wrap items-center justify-center gap-2',
                'item_class'   => '[&>a]:inline-flex [&>span]:inline-flex [&>a]:h-11 [&>span]:h-11 [&>a]:min-w-11 [&>span]:min-w-11 [&>a]:items-center [&>span]:items-center [&>a]:justify-center [&>span]:justify-center [&>a]:rounded-xl [&>span]:rounded-xl [&>a]:border [&>span]:border [&>a]:border-base-300 [&>span]:border-base-300 [&>a]:bg-base-100 [&>span]:bg-base-100 [&>a]:px-4 [&>span]:px-4 [&>a]:text-sm [&>span]:text-sm [&>a]:font-semibold [&>span]:font-semibold [&>a]:transition [&>span]:transition [&>a]:duration-200 [&>span]:duration-200 [&>a:hover]:-translate-y-0.5 [&>a:hover]:border-info [&>a:hover]:text-info [&>span.current]:border-info [&>span.current]:bg-info [&>span.current]:text-white [&>span.dots]:border-transparent [&>span.dots]:bg-transparent [&>span.dots]:px-2',
                'show_status'  => true,
                'page_label'   => 'Page',
                'of_label'     => 'of',
                'mid_size'     => 1,
                'end_size'     => 1,
                'prev_text'    => '&larr; <span class="hidden sm:inline">Previous</span>',
                'next_text'    => '<span class="hidden sm:inline">Next</span> &rarr;',
            ]
        );

        $page_links = paginate_links(
            [
                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'current'   => $current_page,
                'total'     => $total_pages,
                'mid_size'  => (int) $settings['mid_size'],
                'end_size'  => (int) $settings['end_size'],
                'prev_text' => $settings['prev_text'],
                'next_text' => $settings['next_text'],
                'type'      => 'array',
            ]
        );

        if (!empty($page_links)) {
            printf(
                '<nav class="%s" aria-label="%s">',
                esc_attr($settings['nav_class']),
                esc_attr($settings['aria_label'])
            );

            if (!empty($settings['show_status'])) {
                printf(
                    '<div class="%s">%s %s %s %s</div>',
                    esc_attr($settings['status_class']),
                    esc_html($settings['page_label']),
                    esc_html(number_format_i18n($current_page)),
                    esc_html($settings['of_label']),
                    esc_html(number_format_i18n($total_pages))
                );
            }

            printf('<ul class="%s">', esc_attr($settings['list_class']));
            foreach ($page_links as $page_link) {
                printf(
                    '<li class="%s">%s</li>',
                    esc_attr($settings['item_class']),
                    wp_kses_post($page_link)
                );
            }
            echo '</ul></nav>';
        }

        if ($original_query) {
            $wp_query = $original_query;
        }
    }

    private static function generate_pagination_links(int $paged, int $max): array
    {
        $links = [$paged];

        if ($paged >= 3) {
            $links[] = $paged - 2;
            $links[] = $paged - 1;
        }

        if ($paged + 2 <= $max) {
            $links[] = $paged + 1;
            $links[] = $paged + 2;
        }

        sort($links);
        return array_unique($links);
    }

    private static function render_previous_link(int $paged, array $links): void
    {
        if (in_array(1, $links)) {
            return;
        }

        if (get_previous_posts_link()) {
            printf(
                '<li><span class="page-link">%s</span></li>',
                get_previous_posts_link(
                    sprintf('<span aria-hidden="true">%s</span><span class="sr-only">Previous page</span>', self::SVG_PREV)
                )
            );
        }

        if (!in_array(2, $links)) {
            echo '<li class="page-item"></li>';
        }
    }

    private static function render_page_links(int $paged, array $links): void
    {
        foreach ($links as $link) {
            $class = $paged === $link ? 'text-dark' : 'text-dark/60';
            printf(
                '<li><a href="%s" class="%s px-4 mx-4">%s</a></li>',
                esc_url(get_pagenum_link($link)),
                esc_attr($class),
                esc_html($link)
            );
        }
    }

    private static function render_next_link(int $paged, int $max, array $links): void
    {
        if (get_next_posts_link()) {
            printf(
                '<li><span class="page-link">%s</span></li>',
                get_next_posts_link(
                    sprintf('<span aria-hidden="true">%s</span><span class="sr-only">Next page</span>', self::SVG_NEXT)
                )
            );
        }

        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                echo '<li class="page-item"></li>';
            }
        }
    }
}
