<div id="sidebar" class="w-full lg:w-1/4 shrink-0 space-y-6 sticky top-14 h-fit">
    <aside>

        <?php get_search_form(); ?>
        <?php theme_sidebar_banner_with_link(); ?>


        <ul class="space-y-2 menu">
            <li><a href="#" class=" hover:underline">Link 1</a></li>
            <li><a href="#" class=" hover:underline">Link 2</a></li>
            <li><a href="#" class=" hover:underline">Link 3</a></li>
            <li><a href="#" class=" hover:underline">Link 4</a></li>
        </ul>
        <?php if (is_active_sidebar('primary-sidebar')): ?>
        <div class="space-y-4">
            <?php dynamic_sidebar('primary-sidebar'); ?>
        </div>
        <?php endif; ?>
    </aside>
</div>