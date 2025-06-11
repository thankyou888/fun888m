<?php

if (is_file(__DIR__ . '/vendor/autoload_packages.php')) {
  require_once __DIR__ . '/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
  return TailPress\Framework\Theme::instance()
    ->assets(
      fn($manager) => $manager
        ->withCompiler(
          new TailPress\Framework\Assets\ViteCompiler,
          fn($compiler) => $compiler
            ->registerAsset('resources/css/app.css')
            ->registerAsset('resources/js/app.js')
            ->registerAsset('resources/js/theme-switcher.js')
            ->editorStyleFile('resources/css/editor-style.css')
        )
        ->enqueueAssets()
    )
    ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
    ->menus(fn($manager) => $manager->add('primary', __('Primary Menu', 'tailpress')))
    ->menus(fn($manager) => $manager->add('sponsor', __('Sponsor Menu', 'tailpress')))
    ->menus(fn($manager) => $manager->add('footer', __('Footer Bar Menu', 'tailpress')))
    ->themeSupport(fn($manager) => $manager->add([
      'title-tag',
      'custom-logo',
      'post-thumbnails',
      'align-wide',
      'wp-block-styles',
      'responsive-embeds',
      'html5' => [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      ]
    ]));
}

tailpress();

add_action('init', function () {
  error_log('TMPDIR: ' . sys_get_temp_dir());
});

add_filter('wp_handle_upload_prefilter', 'rename_uploaded_image');
add_filter('page_template', function ($template) {
  //global $post;
  //echo $post->post_name;
  //is slug
  // Check if the post slug is 'gambling'
  // Load the custom template for the gambling page
  if (is_page('gambling')) {
    $template = get_template_directory() . '/template-parts/customs-page/page-gambling.php';
  } elseif (is_page('service')) {
    $template = get_template_directory() . '/template-parts/customs-page/page-service.php';
  }

  return $template;
});

function rename_uploaded_image($file)
{
  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
  // Generate a 16-character cryptographically secure random hexadecimal string for the filename prefix.
  $unique_prefix = bin2hex(random_bytes(8));
  // Get the current theme's directory name
  $theme_name = wp_get_theme()->get_stylesheet();
  $file['name'] = $theme_name . '-' . $unique_prefix . '.' . $ext;

  return $file;
}


add_filter('previous_post_link', function ($output) {

  $html = '<div class="p-2 w-full">';
  $html .= $output . '</div>';
  $output = $html;
  return $output;
});

add_filter('next_post_link', function ($output) {

  $html = '<div class="p-2 w-full">';
  $html .= $output . '</div>';
  $output = $html;
  return $output;
});

/**
 * Custom archive title override for specific post types or taxonomies
 */
function custom_archive_title($title)
{
  
  if ( is_post_type_archive( 'service' ) ) {
        $title = 'บริการเดิมพันออนไลน์';
    } elseif ( is_post_type_archive( 'games' ) ) {
         $title = 'เกมออนไลน์';
    } elseif ( is_category( 'news' ) ) {
        $title = 'ข่าวสารล่าสุด';
    } elseif ( is_tag( 'promotion' ) ) {
        $title = 'โปรโมชั่น';
    } 

  return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');

/**
 * Custom archive description override for specific post types or taxonomies
 */
add_filter( 'get_the_archive_description', 'custom_archive_description_filter' );
function custom_archive_description_filter( $description ) {
    if ( is_post_type_archive( 'service' ) ) {
        $description = 'แหล่งรวมลิงก์และข้อมูลสำคัญสำหรับการเข้าถึงบริการของ Fun88 อย่างครบวงจร ไม่ว่าคุณจะสนใจเดิมพันกีฬา เล่นคาสิโนสด ปั่นสล็อต หรือแทงหวย ที่นี่เรารวมทุกหมวดหมู่ไว้ให้คุณเข้าถึงได้สะดวก รวดเร็ว และปลอดภัย';
    } elseif ( is_category( 'news' ) ) {
        $description = 'ติดตามข่าวสารล่าสุดและกิจกรรมของเรา';
    } elseif ( is_tag( 'promotion' ) ) {
        $description = 'รวมโปรโมชั่นและข้อเสนอพิเศษเฉพาะช่วงนี้';
    }
    return $description;
}

// Register Custom Taxonomy
/*
function register_custom_taxonomy() {
    $gambling_labels = array(
        'name' => 'Gambling Categories',
        'singular_name' => 'Gambling Category',
        'menu_name' => 'Gambling Categories',
        'all_items' => 'All Gambling Categories',
    );
    $casino_labels = array(
        'name' => 'Casino Providers',
        'singular_name' => 'Casino Provider',
        'menu_name' => 'Casino Providers',
        'all_items' => 'All Casino Providers',
    );

    $gambling_args = array(
        'labels' => $gambling_labels,
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true, // For block editor
        'rewrite' => array('slug' => 'gambling'),
    );

    $casino_args = array(
        'labels' => $casino_labels,
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true, // For block editor
        'rewrite' => array('slug' => 'casino'),
    );

    register_taxonomy('gambling_category', array('service'), $gambling_args);
    register_taxonomy('casino_providers', array('service'), $casino_args);
 
}
add_action('init', 'register_custom_taxonomy');
*/




function create_service_page_type()
{
  register_post_type('service', array(
    'labels' => array(
      'name'          => __('บริการของเรา', 'tailpress'),
      'singular_name' => __('Service Page', 'tailpress'),
    ),
    'public'            => true,
    'has_archive'       => true, // Enables an archive page at /service/
    'hierarchical'      => true, // Behaves like a Page
    'rewrite'           => array('slug' => 'service'),
    'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
    'show_in_rest'      => true, // Enables Gutenberg block editor
    //'taxonomies'        => array('gambling'), // Associate with 'gambling' taxonomy (ensure 'gambling' taxonomy is registered)
  ));
}
add_action('init', 'create_service_page_type');

function create_games_page_type()
{
  register_post_type('games', array(
    'labels' => array(
      'name'          => __('เกมส์ของเรา', 'tailpress'),
      'singular_name' => __('Games Page', 'tailpress'),
    ),
    'public'            => true,
    'has_archive'       => true, // No archive page
    'hierarchical'      => true, // Behaves like a Page
    'rewrite'           => array('slug' => 'games'),
    'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
    'show_in_rest'      => true, // Enables Gutenberg block editor
  ));
}
add_action('init', 'create_games_page_type');


function create_bonuses_page_type()
{
  register_post_type('bonuses', array(
    'labels' => array(
      'name'          => __('Bonuses Pages', 'tailpress'),
      'singular_name' => __('Bonuses Page', 'tailpress'),
    ),
    'public'            => true,
    'has_archive'       => false, // No archive page
    'hierarchical'      => true, // Behaves like a Page
    'rewrite'           => array('slug' => 'bonuses'),
    'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
    'show_in_rest'      => true, // Enables Gutenberg block editor
  ));
}
add_action('init', 'create_bonuses_page_type');

function register_faq_post_type()
{
  register_post_type('faq', [
    'labels' => [
      'name' => 'FAQs',
      'singular_name' => 'FAQ',
      'add_new_item' => 'Add New FAQ',
      'edit_item' => 'Edit FAQ',
    ],
    'public' => true,
    'has_archive' => false,
    'rewrite' => ['slug' => 'faq'],
    'supports' => ['title', 'editor'],
    'show_in_rest' => true, // Enables Gutenberg
  ]);
}
add_action('init', 'register_faq_post_type');

function register_reviews_post_type()
{
  register_post_type('reviews', [
    'labels' => [
      'name' => 'Reviews',
      'singular_name' => 'Review',
      'add_new_item' => 'Add New Review',
      'edit_item' => 'Edit Review',
    ],
    'public' => true,
    'has_archive' => false,
    'rewrite' => ['slug' => 'reviews'],
    'supports' => ['title', 'editor'],
    'show_in_rest' => true, // Enables Gutenberg
  ]);
}
add_action('init', 'register_reviews_post_type');


function register_primary_sidebars()
{
  register_sidebar(array(
    'name'          => 'Primary Sidebar',
    'id'            => 'primary-sidebar',
    'description'   => 'Sidebar for the primary widget area',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="font-bold text-lg mb-2">',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'register_primary_sidebars');



function register_footer_widgets()
{
  register_sidebar(array(
    'name'          => 'Footer Column 1',
    'id'            => 'footer-1',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
  ));
  register_sidebar(array(
    'name'          => 'Footer Column 2',
    'id'            => 'footer-2',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
  ));
  register_sidebar(array(
    'name'          => 'Footer Column 3',
    'id'            => 'footer-3',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget'  => '</div>',
  ));
}
add_action('widgets_init', 'register_footer_widgets');


/* The `function my_theme_customizer()` is a WordPress function that is used to add
  custom options to the theme customizer. Inside this function, various settings and controls are
  added to allow users to customize certain aspects of the theme such as sidebar visibility, footer
  text, sidebar banner link, and sidebar banner image. */
function my_theme_customizer($wp_customize)
{
  // Create a new section in the Customizer
  $wp_customize->add_section('theme_options', array(
    'title'    => __('Theme Options', 'mytheme'),
    'priority' => 30,
  ));

  // Add setting for sidebar visibility
  $wp_customize->add_setting('archives_show_sidebar', array(
    'default'           => false, // Sidebar non-visible by default
    'sanitize_callback' => 'wp_validate_boolean',
  ));

  // Add control (checkbox) for sidebar
  $wp_customize->add_control('archives_show_sidebar_control', array(
    'label'    => __('Archives Show Sidebar', 'mytheme'),
    'section'  => 'theme_options',
    'settings' => 'archives_show_sidebar',
    'type'     => 'checkbox',
  ));

  $wp_customize->add_setting('footer_text', array(
    'default' => 'Default Footer Text',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('footer_text_control', array(
    'label' => __('Footer Text', 'tailpress'),
    'section' => 'theme_options',
    'settings' => 'footer_text',
    'type' => 'text',
  ));

  $wp_customize->add_setting('sidebar_banner_link', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control('sidebar_banner_link', array(
    'label'   => __('Sidebar Banner Link', 'tailpress'),
    'section' => 'theme_options',
    'type'    => 'url',
  ));

  $wp_customize->add_setting('sidebar_banner_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidebar_banner_image', array(
    'label'    => __('Sidebar Banner Image', 'tailpress'),
    'section'  => 'theme_options', // หรือ custom section
    'settings' => 'sidebar_banner_image',
  )));

  $wp_customize->add_setting('Affiliate ID', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('affiliate_id', array(
    'label'   => __('Affiliate ID', 'tailpress'),
    'section' => 'theme_options',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('Affiliate Parameter', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw'
  ));
  $wp_customize->add_control('affiliate_parameter', array(
    'label'   => __('Affiliate Parameter', 'tailpress'),
    'section' => 'theme_options',
    'type'    => 'text',
  ));
}
add_action('customize_register', 'my_theme_customizer');


// เพิ่ม rel attribute และ alt จาก Media Library ให้ลิงก์ของรูปแบนเนอร์จาก Customize
function theme_sidebar_banner_with_link()
{
  $image_url = get_theme_mod('sidebar_banner_image');
  $link_url = get_theme_mod('sidebar_banner_link');
  $attachment_id = attachment_url_to_postid($image_url);
  $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

  if (!$alt_text) {
    $alt_text = get_the_title($attachment_id);
  }

  if ($image_url) {
    echo '<div class="image-banner">';
    if ($link_url) {
      echo '<a href="' . esc_url($link_url) . '" target="_blank" rel="nofollow noreferrer noopener sponsored">';
    }
    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '" class="w-full h-auto object-cover mb-4" loading="lazy">';
    if ($link_url) {
      echo '</a>';
    }
    echo '</div>';
  }
}


function custom_excerpt_override($excerpt)
{
  return custom_the_excerpt(150);
}

function custom_the_excerpt($limit = 80)
{
    $content = strip_tags(get_the_content());
    $content = str_replace(["\r", "\n", "\t"], ' ', $content);
    $content = mb_substr($content, 0, $limit, 'UTF-8');

    // Prevent word break
    if (mb_strlen(strip_tags(get_the_content()), 'UTF-8') > $limit) {
        $content .= '...';
    }

    return $content;;
}
add_filter( 'get_the_excerpt', 'custom_excerpt_override' );

function display_current_year()
{
  return date('Y'); // Fetches the current year dynamically
}
add_shortcode('year', 'display_current_year');
