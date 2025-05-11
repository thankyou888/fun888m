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

add_filter('wp_handle_upload_prefilter', 'rename_uploaded_image');

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

function custom_archive_title($title) {
  if (is_category()) {
      $title = single_cat_title('', false); // Display category name without "Category: "
  } elseif (is_tag()) {
      $title = single_tag_title('', false); // Display tag name only
  }
  return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');


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

  function customize_footer_register($wp_customize) {
    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer Settings', 'tailpress'),
        'priority' => 120,
    ));

    $wp_customize->add_setting('footer_text', array(
        'default' => 'Default Footer Text',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_text_control', array(
        'label' => __('Footer Text', 'tailpress'),
        'section' => 'footer_settings',
        'settings' => 'footer_text',
        'type' => 'text',
    ));
}
add_action('customize_register', 'customize_footer_register');

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
  
  // เพิ่ม field ลิงก์ใน Customizer
  function theme_customize_sidebar_banner($wp_customize) {

//Section
    $wp_customize->add_section(
        'Banner',
        array(
            'title' => __( 'Sponsor Banner Images', '_s' ),
            'priority' => 30,
            'description' => __( 'Enter the Sponsor Banner Images', '_s' )
        )
    );

    $wp_customize->add_setting('sidebar_banner_link', array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
    ));
  
    $wp_customize->add_control('sidebar_banner_link', array(
      'label'   => __('Sidebar Banner Link', 'tailpress'),
      'section' => 'Banner',
      'type'    => 'url',
    ));

    $wp_customize->add_setting('sidebar_banner_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
      ));
    
      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sidebar_banner_image', array(
        'label'    => __('Sidebar Banner Image', 'tailpress'),
        'section'  => 'Banner', // หรือ custom section
        'settings' => 'sidebar_banner_image',
      )));
  }
  add_action('customize_register', 'theme_customize_sidebar_banner');
  

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
  return wp_trim_words(wp_strip_all_tags($content), 120, '...');
}
