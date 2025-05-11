<?php
/**
 * Theme footer template.
 *
 * @package TailPress
 */
?>
  

    </main>

<?php do_action('tailpress_content_end'); ?>
</div>

<?php do_action('tailpress_content_after'); ?>

<footer  id="colophon" class="bg-gray-800 text-white" role="contentinfo">
        <div class="container mx-auto px-4 py-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php do_action('the_footer'); ?>
            <div class="flex flex-col gap-4">
                <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                            <p><?php echo esc_html(get_bloginfo('description')); ?></p>
                <?php endif; ?>
                <div class="icons-social flex gap-4 mb-4">
                    <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 1" />
                    <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 2" />    
                    <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 3" />
                </div>
            </div>
            <div class="flex flex-col gap-4">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            </div>
            <div>
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="flex flex-col gap-4">
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <div class="footer-links flex justify-center space-x-4">           
            <?php
                wp_nav_menu([
                    'container_id'    => 'footer-bar-menu',
                    'container_class' => '',
                    'menu_class'      => 'flex flex-wrap gap-2 justify-center [&_a]:!no-underline text-light mb-4',
                    'theme_location'  => 'footer',
                    'li_class'        => 'text-center',
                    'fallback_cb'     => false,
                ]);
            ?>
        </div>
        <div class="bg-gray-900 text-center py-4">
            <?php echo get_theme_mod('footer_text', ''); ?>
            <p class="text-sm">&copy; <?php echo esc_html(date_i18n('Y')); ?> - <?php bloginfo('name'); ?>. All rights reserved.</p>       
        </div>
    </footer>
    <?php wp_footer(); ?>
    </div>
</body>
</html>