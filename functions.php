<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->menus(fn($manager) => $manager->add('sponsor', __( 'Sponsor Menu', 'tailpress')))
        ->menus(fn($manager) => $manager->add('footer', __( 'Footer Bar Menu', 'tailpress')))
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

/**
 * Register custom Gutenberg blocks.
 */
function fun888m_register_custom_blocks() {
  // Register the bonus-grid block
  register_block_type( get_template_directory() . '/blocks/bonus-grid' );

  // You can register other blocks here by adding more register_block_type() calls.
  // Example: register_block_type( get_template_directory() . '/blocks/another-block' );
}
add_action( 'init', 'fun888m_register_custom_blocks' );
add_filter('wp_handle_upload_prefilter', 'rename_uploaded_image');
add_filter('page_template', function ($template) {
        //global $post;
        //echo $post->post_name;
        //is slug
        // Check if the post slug is 'gambling'
        // Load the custom template for the gambling page
    if (is_page('gambling')) { 
        $template = get_template_directory() . '/template-parts/customs-page/page-gambling.php';
    }
    elseif (is_page('service')) {
        $template = get_template_directory() . '/template-parts/customs-page/page-service.php';
    }
  
    return $template;
});

/**
 * The function `rename_uploaded_image` renames an uploaded image file by generating a new unique name
 * based on the original file name and current time.
 * 
 * @param file The `rename_uploaded_image` function takes an array `` as a parameter. This array
 * typically contains information about the uploaded file, such as its name, type, size, etc.
 * 
 * @return The function `rename_uploaded_image` takes an uploaded file array as input, renames the file
 * by appending a 16-character MD5 hash of the file name and current time, and returns the modified
 * file array with the new name.
 */
function rename_uploaded_image($file) {
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $md5_name = substr(md5($file['name'] . time()), 0, 16); // Get first 16 chars
    $file['name'] = $md5_name . '.' . $ext;

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


function custom_archive_title($title) {
  if (is_category()) {
      $title = single_cat_title('', false); // Display category name without "Category: "
  } elseif (is_tag()) {
      $title = single_tag_title('', false); // Display tag name only
  }
  return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');

function create_service_page_type() {
  register_post_type('service', array(
      'labels' => array(
          'name'          => __('Service Pages', 'tailpress'),
          'singular_name' => __('Service Page', 'tailpress'),
      ),
      'public'            => true,
      'has_archive'       => false, // No archive page
      'hierarchical'      => true, // Behaves like a Page
      'rewrite'           => array('slug' => 'service'),
      'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
      'show_in_rest'      => true, // Enables Gutenberg block editor
  ));
}
add_action('init', 'create_service_page_type');


function create_bonuses_page_type() {
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

function register_faq_post_type() {
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

function register_reviews_post_type() {
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


function register_primary_sidebars() {
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
  
  

function register_footer_widgets() {
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
  function my_theme_customizer($wp_customize) {
    // Create a new section in the Customizer
    $wp_customize->add_section('theme_options', array(
        'title'    => __('Theme Options', 'mytheme'),
        'priority' => 30,
    ));

    // Add setting for sidebar visibility
    $wp_customize->add_setting('show_sidebar', array(
        'default'           => true, // Sidebar visible by default
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    // Add control (checkbox) for sidebar
    $wp_customize->add_control('show_sidebar_control', array(
        'label'    => __('Show Sidebar', 'mytheme'),
        'section'  => 'theme_options',
        'settings' => 'show_sidebar',
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
function theme_sidebar_banner_with_link() {
    $image_url = get_theme_mod('sidebar_banner_image');
    $link_url = get_theme_mod('sidebar_banner_link');
    $attachment_id = attachment_url_to_postid($image_url);
    $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
  
    if (!$alt_text) {
      $alt_text = get_the_title($attachment_id);
    }
  
    if ( $image_url ) {
      echo '<div class="image-banner">';
      if ( $link_url ) {
        echo '<a href="' . esc_url($link_url) . '" target="_blank" rel="nofollow noreferrer noopener sponsored">';
      }
      echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '" class="w-full h-auto object-cover mb-4" loading="lazy">';
      if ( $link_url ) {
        echo '</a>';
      }
      echo '</div>';
    }
  }
  

function custom_excerpt_override($text) {
    if (!empty($text)) {
        return $text; // Use existing excerpt if available
    }

    $content = get_the_content(); // Get full post content
    $content = wp_strip_all_tags($content); // Strip HTML tags
    return mb_substr($content, 0, 100) . '...'; // Thai-friendly trimming
}
add_filter('wp_trim_excerpt', 'custom_excerpt_override');


function custom_the_excerpt() {
  $content = get_the_content();
  return wp_trim_words(wp_strip_all_tags($content), 50, '...');
}


