<div id="sidebar" class="w-full lg:w-1/4 shrink-0 space-y-6 sticky top-14 h-fit">
    <aside>

        <?php get_search_form(); ?>
        <?php theme_sidebar_banner_with_link(); ?>

        <?php
            wp_nav_menu([
                'container_id'    => 'sponsor-menu',
                'container_class' => '',
                'menu_class'      => 'flex flex-col gap-2 [&_a]:!no-underline text-light mb-4 font-itim',
                'theme_location'  => 'sponsor',
                'li_class'        => 'py-[.7rem] text-center bg-brand rounded',
                'fallback_cb'     => false,
            ]);
        ?>

        <?php if (is_active_sidebar('primary-sidebar')): ?>
        <div class="space-y-4">
            <?php dynamic_sidebar('primary-sidebar'); ?>
        </div>
        <?php endif; ?>
    </aside>
</div>