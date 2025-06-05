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
<div class="disclaimer">
  <h2 class="text-base font-semibold mb-2">ข้อจำกัดความรับผิดชอบ (Disclaimer)</h2>
  <p>
    เว็บไซต์นี้ให้ข้อมูลเกี่ยวกับแบรนด์และบริการของเว็บพนันออนไลน์เท่านั้น ไม่มีการรับเดิมพันโดยตรง ผู้ใช้งานควรมีอายุ 18 ปีขึ้นไป และควรเดิมพันอย่างมีความรับผิดชอบ ทางเราจะไม่รับผิดชอบต่อความเสียหายใด ๆ ที่เกิดจากการใช้งานข้อมูลบนเว็บไซต์นี้ เว็บไซต์นี้จัดทำขึ้นเพื่อวัตถุประสงค์ในการให้ข้อมูลเท่านั้น การพนันออนไลน์เป็นสิ่งผิดกฎหมายในประเทศไทย โปรดศึกษาและปฏิบัติตามกฎหมายในพื้นที่ของคุณอย่างเคร่งครัด การเข้าร่วมกิจกรรมการพนันมีความเสี่ยงสูง ผู้ใช้ควรพิจารณาด้วยความรับผิดชอบ"
  </p>
</div>
<footer  id="colophon" class="bg-gray-800 text-white border-t border-sky-500" role="contentinfo">
        <div class="container mx-auto px-4 py-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php do_action('the_footer'); ?>
            <div class="flex flex-col gap-4">
                <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                            <p><?php echo esc_html(get_bloginfo('description')); ?></p>
                <?php endif; ?>
                <div class="icons-social flex gap-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-[32px]" viewBox="0 0 48 48">
                        <path fill="#FF3D00" d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z"></path><path fill="#FFF" d="M20 31L20 17 32 24z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-[32px]" viewBox="0 0 48 48">
                        <linearGradient id="Ld6sqrtcxMyckEl6xeDdMa_uLWV5A9vXIPu_gr1" x1="9.993" x2="40.615" y1="9.993" y2="40.615" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#2aa4f4"></stop><stop offset="1" stop-color="#007ad9"></stop></linearGradient><path fill="url(#Ld6sqrtcxMyckEl6xeDdMa_uLWV5A9vXIPu_gr1)" d="M24,4C12.954,4,4,12.954,4,24s8.954,20,20,20s20-8.954,20-20S35.046,4,24,4z"></path><path fill="#fff" d="M26.707,29.301h5.176l0.813-5.258h-5.989v-2.874c0-2.184,0.714-4.121,2.757-4.121h3.283V12.46 c-0.577-0.078-1.797-0.248-4.102-0.248c-4.814,0-7.636,2.542-7.636,8.334v3.498H16.06v5.258h4.948v14.452 C21.988,43.9,22.981,44,24,44c0.921,0,1.82-0.084,2.707-0.204V29.301z"></path>
                    </svg>
                   <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-[32px]"  viewBox="0 0 48 48">
                    <linearGradient id="U8Yg0Q5gzpRbQDBSnSCfPa_yoQabS8l0qpr_gr1" x1="4.338" x2="38.984" y1="-10.056" y2="49.954" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4b4b4b"></stop><stop offset=".247" stop-color="#3e3e3e"></stop><stop offset=".686" stop-color="#2b2b2b"></stop><stop offset="1" stop-color="#252525"></stop></linearGradient><path fill="url(#U8Yg0Q5gzpRbQDBSnSCfPa_yoQabS8l0qpr_gr1)" d="M38,42H10c-2.209,0-4-1.791-4-4V10c0-2.209,1.791-4,4-4h28c2.209,0,4,1.791,4,4v28	C42,40.209,40.209,42,38,42z"></path><path fill="#fff" d="M34.257,34h-6.437L13.829,14h6.437L34.257,34z M28.587,32.304h2.563L19.499,15.696h-2.563 L28.587,32.304z"></path><polygon fill="#fff" points="15.866,34 23.069,25.656 22.127,24.407 13.823,34"></polygon><polygon fill="#fff" points="24.45,21.721 25.355,23.01 33.136,14 31.136,14"></polygon>
                   </svg>
                   <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-[32px]"  viewBox="0 0 48 48">
                    <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fd5"></stop><stop offset=".328" stop-color="#ff543f"></stop><stop offset=".348" stop-color="#fc5245"></stop><stop offset=".504" stop-color="#e64771"></stop><stop offset=".643" stop-color="#d53e91"></stop><stop offset=".761" stop-color="#cc39a4"></stop><stop offset=".841" stop-color="#c837ab"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4168c9"></stop><stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"></path><circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle><path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"></path>
                   </svg>
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
                    'li_class'        => 'text-center text-sm',
                    'fallback_cb'     => false,
                ]);
            ?>
        </div>
        <div class="bg-gray-900 text-center border-t border-sky-500 py-4">
            <?php echo get_theme_mod('footer_text', ''); ?>
            <p class="text-sm">&copy; <?php echo esc_html(date_i18n('Y')); ?> - <?php bloginfo('name'); ?>. All rights reserved.</p>       
        </div>
    </footer>
    <?php wp_footer(); ?>
    </div>
</body>
</html>