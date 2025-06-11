<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html data-theme="light" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('text-base bg-base-200 antialiased'); ?> >
    <?php wp_body_open(); ?>
    <div id="skip-link" class="skip-link screen-reader-text">
        <a href="#content" class="bg-sky-600 text-white px-4 py-2 rounded">Skip to content</a>
    </div>
<?php do_action('tailpress_site_before'); ?>

<?php $layout = get_theme_mod('layout', 'default'); ?>
<?php if ($layout === 'boxed'): ?>
    <div id="page" class="max-w-screen-2xl content-center mx-auto min-h-screen flex flex-col ">
<?php else: ?>
    <div id="page" class="min-h-screen flex flex-col">
<?php endif; ?>

    <?php do_action('tailpress_the_header'); ?>

    <header class="bg-sky-600 border-b border-sky-500">
        <div class="container mx-auto py-2 md:flex md:justify-between md:items-center">
            <div class="flex justify-between items-center">
                <div class="inline-flex items-center">
                    <?php if (has_custom_logo()): ?>
                            <?php
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                            ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" >
                                <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>"  class="logo w-[130px] h-auto" loading="lazy" />
                            </a>
                    <?php else: ?>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" class="!no-underline lowercase font-medium text-lg">
                                <?php bloginfo('name'); ?>
                            </a>
                            <?php if ($description = get_bloginfo('description')): ?>
                                <span class="text-sm font-light text-dark/80">|</span>
                                <span class="text-sm font-light text-dark/80"><?php echo esc_html($description); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                      <div class="flex-none ml-2.5">
                        <label class="swap swap-rotate">
                            <!-- this hidden checkbox controls the state -->
                            <input id="themeToggle" type="checkbox" class="theme-controller" value="dark" />

                            <!-- sun icon -->
                            <svg
                                class="swap-off fill-current size-6"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                            </svg>

                            <!-- moon icon -->
                            <svg
                                class="swap-on fill-current size-6"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                            </svg>
                            </label>
                </div> 
                </div>     
                <?php if (has_nav_menu('primary')): ?>
                    <div class="inline-flex md:hidden">
                        <a title="Register" href="<?php echo get_theme_mod('sidebar_banner_link');?>" class="btn btn-error rounded mx-4" rel="sponsored noopener nofollow sponsored">สมัครสมาชิก</a>
                        <button type="button" aria-label="Toggle navigation" id="primary-menu-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div id="primary-navigation" class="hidden md:flex md:bg-transparent gap-4 items-center border border-light md:border-none rounded-xl md:p-0 md:mt-0 mt-2">
                <nav itemtype="https://schema.org/SiteNavigationElement" itemscope >
                    <?php if (current_user_can('administrator') && !has_nav_menu('primary')): ?>
                        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm text-zinc-600"><?php esc_html_e('Edit Menus', 'tailpress'); ?></a>
                    <?php else: ?>
                        <?php
                        wp_nav_menu([
                            'container_id'    => 'primary-menu',
                            'container_class' => '',
                            'menu_class'      => 'md:flex md:mx-4 [&_a]:!no-underline text-white font-itim',
                            'theme_location'  => 'primary',
                            'li_class'        => 'md:mx-2 p-2',
                            'fallback_cb'     => false,
                        ]);
                        ?>
                    <?php endif; ?>
                </nav>
                <a title="Register" href="<?php echo get_theme_mod('sidebar_banner_link');?>" class="btn btn-error md:my-0 my-4 rounded w-full md:w-auto" rel="sponsored noopener nofollow sponsored">สมัครสมาชิก</a>
                    
            </div>
            <!-- theme customizer -->
        
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php if (is_front_page()): ?>
            
        <?php endif; ?>

        <main class="text-base-content transition-colors duration-500 bg-base-200">
           <!-- Breadcrumbs -->
           <?php if (!is_front_page()): ?>
                <?php do_action('tailpress_breadcrumbs_start'); ?>
                <?php if ( function_exists('rank_math_the_breadcrumbs') ) : ?>
                <div class="breadcrumbs border-b-1 border-zinc-200">
                    <div class="container mx-auto py-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <?php rank_math_the_breadcrumbs(); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<div class="breadcrumbs border-b-1 border-zinc-200"><div class="container mx-auto py-2 text-sm" id="breadcrumbs">','</div></div>' );
                }
                ?>
                <?php if ( function_exists('bcn_display') ) : ?>
                    <div class="breadcrumbs border-b-1 border-zinc-200">
                        <div class="container mx-auto py-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <?php bcn_display(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php endif; ?>
               
        <?php do_action('tailpress_content_start'); ?>
       

  