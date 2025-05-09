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
            <?php do_action('tailpress_footer'); ?>
            <div>
                <img class="logo mb-4" src="https://placehold.co/120x60" alt="Logo" />
                <p class="text-gray-400 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
               <div class="icons-social flex gap-4 mb-4">
                   <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 1" />
                   <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 2" />    
                <img class="w-8 h-8" src="https://placehold.co/32x32" alt="Icon 3" />
               </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Column 2</h3>
                <ul>
                    <li><a href="#" class="hover:underline">Link 1</a></li>
                    <li><a href="#" class="hover:underline">Link 2</a></li>
                    <li><a href="#" class="hover:underline">Link 3</a></li>
                    <li><a href="#" class="hover:underline">Link 4</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Column 3</h3>
                <ul>
                    <li><a href="#" class="hover:underline">Link 1</a></li>
                    <li><a href="#" class="hover:underline">Link 2</a></li>
                    <li><a href="#" class="hover:underline">Link 3</a></li>
                    <li><a href="#" class="hover:underline">Link 4</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Column 4</h3>
                <ul>
                    <li><a href="#" class="hover:underline">Link 1</a></li>
                    <li><a href="#" class="hover:underline">Link 2</a></li>
                    <li><a href="#" class="hover:underline">Link 3</a></li>
                    <li><a href="#" class="hover:underline">Link 4</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-links flex justify-center space-x-4">           
                <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white">Terms of Service</a>
                <a href="#" class="text-gray-400 hover:text-white">Contact Us</a>    
        </div>
        <div class="bg-gray-900 text-center py-4">
            <p class="text-sm">&copy; <?php echo esc_html(date_i18n('Y')); ?> - <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </div>
</body>
</html>