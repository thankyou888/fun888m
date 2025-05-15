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
<body <?php body_class('bg-white text-zinc-900 antialiased'); ?> >
    <?php wp_body_open(); ?>
    <div id="skip-link" class="skip-link screen-reader-text">
        <a href="#content" class="bg-sky-600 text-white px-4 py-2 rounded">Skip to content</a>
    </div>
<?php do_action('tailpress_site_before'); ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('tailpress_the_header'); ?>

    <header class="bg-sky-600">
        <div class="container mx-auto py-2 md:flex md:justify-between md:items-center">
            <div class="flex justify-between items-center">
                <div>
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline lowercase font-medium text-lg">
                                <?php bloginfo('name'); ?>
                            </a>
                            <?php if ($description = get_bloginfo('description')): ?>
                                <span class="text-sm font-light text-dark/80">|</span>
                                <span class="text-sm font-light text-dark/80"><?php echo esc_html($description); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (has_nav_menu('primary')): ?>
                    <div class="md:hidden">
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
                            'menu_class'      => 'md:flex md:-mx-4 [&_a]:!no-underline text-white font-kanit',
                            'theme_location'  => 'primary',
                            'li_class'        => 'md:mx-2 p-2',
                            'fallback_cb'     => false,
                        ]);
                        ?>
                    <?php endif; ?>
                </nav>
                <a class="btn btn-accent text-light md:my-0 my-4 rounded w-full md:w-auto">Register</a>
                <label class="flex cursor-pointer gap-2">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <circle cx="12" cy="12" r="5" />
    <path
      d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
  </svg>
  <input type="checkbox" value="synthwave" class="toggle theme-controller" />
  <svg
    xmlns="http://www.w3.org/2000/svg"
    width="20"
    height="20"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
  </svg>
</label>
            </div>
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php if (is_front_page()): ?>
            
        <?php endif; ?>

        <main class="bg-gray-100">
           <!-- Breadcrumbs -->
           <?php if (!is_front_page()): ?>
                <?php if ( function_exists('rank_math_the_breadcrumbs') ) : ?>
                <div class="breadcrumbs border-b-1 border-zinc-200">
                    <div class="container mx-auto py-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <?php rank_math_the_breadcrumbs(); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ( function_exists('bcn_display') ) : ?>
                    <div class="breadcrumbs border-b-1 border-zinc-200">
                        <div class="container mx-auto py-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <?php bcn_display(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
            <?php endif; ?>
               
        <?php do_action('tailpress_content_start'); ?>
       