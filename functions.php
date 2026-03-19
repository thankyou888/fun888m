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


/**
 * Registers Yoast SEO meta fields to be available in the WordPress REST API.
 *
 * This function ensures that specific Yoast SEO metadata is exposed via the REST API,
 * allowing external applications or headless WordPress setups to access SEO-related data.
 *
 * @return void
 */
function tailpress_rest_post_id($post): int {
    if (is_array($post)) {
        if (isset($post['id'])) {
            return (int) $post['id'];
        }
        if (isset($post['ID'])) {
            return (int) $post['ID'];
        }
    }

    if (is_object($post)) {
        if (isset($post->id)) {
            return (int) $post->id;
        }
        if (isset($post->ID)) {
            return (int) $post->ID;
        }
    }

    return 0;
}

function register_yoast_meta_in_rest() {

    // ดึง Post Types ทั้งหมดที่เปิดใช้งานใน REST API ออกมา รวมถึง Page, Post, Bonuses, FAQ, Reviews, ฯลฯ
    $post_types = get_post_types(array('show_in_rest' => true), 'names');

    foreach ($post_types as $post_type) {
        register_rest_field($post_type, 'yoast_wpseo_title', array(
            'get_callback'    => function($post) {
                $post_id = tailpress_rest_post_id($post);
                return $post_id ? get_post_meta($post_id, '_yoast_wpseo_title', true) : '';
            },
            'update_callback' => function($value, $post) {
                update_post_meta($post->ID, '_yoast_wpseo_title', sanitize_text_field($value));
            },
            'schema' => array(
                'type'        => 'string',
                'description' => 'Meta title for Yoast SEO',
            ),
        ));

        register_rest_field($post_type, 'yoast_wpseo_metadesc', array(
            'get_callback'    => function($post) {
                $post_id = tailpress_rest_post_id($post);
                return $post_id ? get_post_meta($post_id, '_yoast_wpseo_metadesc', true) : '';
            },
            'update_callback' => function($value, $post) {
                update_post_meta($post->ID, '_yoast_wpseo_metadesc', sanitize_text_field($value));
            },
            'schema' => array(
                'type'        => 'string',
                'description' => 'Meta description for Yoast SEO',
            ),
        ));

        register_rest_field($post_type, 'yoast_wpseo_focuskw', array(
            'get_callback'    => function($post) {
                $post_id = tailpress_rest_post_id($post);
                return $post_id ? get_post_meta($post_id, '_yoast_wpseo_focuskw', true) : '';
            },
            'update_callback' => function($value, $post) {
                update_post_meta($post->ID, '_yoast_wpseo_focuskw', sanitize_text_field($value));
            },
            'schema' => array(
                'type'        => 'string',
                'description' => 'Meta keywords for Yoast SEO',
            ),
        ));

        // Register custom fields only for 'reviews' post type
        if ($post_type === 'reviews') {
            register_rest_field('reviews', 'rtp', [
                'get_callback'    => function ($post) {
                    $post_id = tailpress_rest_post_id($post);
                    return $post_id ? get_post_meta($post_id, 'rtp', true) : '';
                },
                'update_callback' => function ($value, $post) {
                    update_post_meta($post->ID, 'rtp', sanitize_text_field($value));
                },
                'schema'          => [
                    'type'        => 'string',
                    'description' => 'RTP for the game review.',
                ],
            ]);

            register_rest_field('reviews', 'volatility', [
                'get_callback'    => function ($post) {
                    $post_id = tailpress_rest_post_id($post);
                    return $post_id ? get_post_meta($post_id, 'volatility', true) : '';
                },
                'update_callback' => function ($value, $post) {
                    update_post_meta($post->ID, 'volatility', sanitize_text_field($value));
                },
                'schema'          => [
                    'type'        => 'string',
                    'description' => 'Volatility for the game review.',
                ],
            ]);

            register_rest_field('reviews', 'star_rating', [
                'get_callback'    => function ($post) {
                    $post_id = tailpress_rest_post_id($post);
                    return $post_id ? (int) get_post_meta($post_id, 'star_rating', true) : 0;
                },
                'update_callback' => function ($value, $post) {
                    update_post_meta($post->ID, 'star_rating', intval($value));
                },
                'schema'          => [
                    'type'        => 'integer',
                    'description' => 'Star rating for the game review.',
                ],
            ]);
        }
    }

}
add_action('rest_api_init', 'register_yoast_meta_in_rest');


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
  // Check if the current action is 'upload-theme'.
  // This indicates a theme is being uploaded via the WordPress admin interface.
  // In this context, $file is the theme's ZIP package.
  if (isset($_POST['action']) && $_POST['action'] !== 'upload-theme') {
    // Bypass the renaming logic for theme ZIP uploads
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    // Generate a 16-character cryptographically secure random hexadecimal string for the filename prefix.
    $unique_prefix = bin2hex(random_bytes(8));
    // Get the current theme's directory name
    $theme_name = wp_get_theme()->get_stylesheet();
    $file['name'] = $theme_name . '-' . $unique_prefix . '.' . $ext;
  }

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
         $title = 'สล็อตเว็บตรง';
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
    'has_archive'       => true, // Enables an archive page at /games/
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
    'has_archive'       => true, // Enables an archive page at /bonuses/
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
    'has_archive' => true,
    'rewrite' => ['slug' => 'faq'],
    'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
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
    'has_archive' => true,
    'rewrite' => ['slug' => 'reviews'],
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
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

/**
 * Adds a meta box to the 'reviews' post type editor screen.
 * This meta box will contain custom fields for review details.
 */
function add_review_details_meta_box() {
    add_meta_box(
        'review_details_meta_box',      // ID of the meta box
        'รายละเอียดรีวิวเกม (Game Review Details)', // Title of the meta box
        'render_review_details_meta_box', // Callback function to render the fields
        'reviews',                      // Post type
        'normal',                       // Context (where it appears: 'normal', 'side', 'advanced')
        'high'                          // Priority ('high', 'core', 'default', 'low')
    );
}
add_action('add_meta_boxes', 'add_review_details_meta_box');

/**
 * Renders the content of the 'Review Details' meta box.
 *
 * @param WP_Post $post The post object.
 */
function render_review_details_meta_box($post) {
    // Add a nonce field for security
    wp_nonce_field('review_details_save_meta_box_data', 'review_details_meta_box_nonce');

    // Get existing values from the database
    $rtp = get_post_meta($post->ID, 'rtp', true);
    $volatility = get_post_meta($post->ID, 'volatility', true);
    $star_rating = get_post_meta($post->ID, 'star_rating', true);

    // HTML for the fields
    echo '<p>';
    echo '<label for="rtp_field" style="font-weight: bold;">RTP (%):</label><br>';
    echo '<input type="text" id="rtp_field" name="rtp_field" value="' . esc_attr($rtp) . '" size="25" placeholder="เช่น 96.5" />';
    echo '</p>';

    echo '<p>';
    echo '<label for="volatility_field" style="font-weight: bold;">Volatility (ความผันผวน):</label><br>';
    echo '<input type="text" id="volatility_field" name="volatility_field" value="' . esc_attr($volatility) . '" size="25" placeholder="เช่น ต่ำ, ปานกลาง, สูง" />';
    echo '</p>';

    echo '<p>';
    echo '<label for="star_rating_field" style="font-weight: bold;">Star Rating (1-5):</label><br>';
    echo '<input type="number" id="star_rating_field" name="star_rating_field" value="' . esc_attr($star_rating) . '" min="1" max="5" step="1" />';
    echo '</p>';
}

/**
 * Saves the custom meta data when the post is saved.
 *
 * @param int $post_id The ID of the post being saved.
 */
function save_review_details_meta_box_data($post_id) {
    // Security checks
    if (!isset($_POST['review_details_meta_box_nonce']) || !wp_verify_nonce($_POST['review_details_meta_box_nonce'], 'review_details_save_meta_box_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the data
    update_post_meta($post_id, 'rtp', isset($_POST['rtp_field']) ? sanitize_text_field($_POST['rtp_field']) : '');
    update_post_meta($post_id, 'volatility', isset($_POST['volatility_field']) ? sanitize_text_field($_POST['volatility_field']) : '');
    update_post_meta($post_id, 'star_rating', isset($_POST['star_rating_field']) ? intval($_POST['star_rating_field']) : '');
}
add_action('save_post', 'save_review_details_meta_box_data');
