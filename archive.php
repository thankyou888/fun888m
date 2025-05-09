<?php
/**
 * Archive Page Template
/* The code `if ( ! defined( 'ABSPATH' ) ) { exit; }` is a security measure commonly used in WordPress
themes and plugins. */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
get_header(); // Load header template
?>
<div class="container my-8 mx-auto bg-gray-100">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
            <h1 class="entry-title"><?php the_archive_title(); ?></h1>
             <!-- Breadcrumbs -->
            <?php if ( function_exists('rank_math_the_breadcrumbs') ) : ?>
              <div class="mb-4 text-sm text-gray-500" itemscope itemtype="https://schema.org/BreadcrumbList">
                <?php rank_math_the_breadcrumbs(); ?>
              </div>
            <?php endif; ?>
            <?php if ( have_posts() ) : ?>
              <?php $first = true; ?>
            <!-- Content Archive First Post-->
            <?php while ( have_posts() ) : the_post(); ?>
            <?php if ( $first ) : $first = false; ?>
            <article class="flex flex-col bg-white p-4 rounded-lg shadow-md mb-4" itemscope itemtype="https://schema.org/Article">          
                <div class="entry-image ">
                  <a href="<?php the_permalink(); ?>" itemprop="url">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'object-cover rounded-lg', 'loading' => 'lazy']); ?>
                  </a>
                </div>
                <header>
                    <h3 class="entry-title" itemprop="headline">
                      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </h3>
                  </h3>
                    <div class="entry-meta flex mb-4 gap-2">
                     <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                     <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
                    <div class="entry-excerpt">
                      <p class="text-gray-600 text-sm mb-4"><?php echo custom_the_excerpt(); ?></p>
                    </div>
                </header>
            </article>
            <?php else : ?>
            <!-- Content Archive Second Post-->
            <article class="bg-white p-4 rounded-lg shadow-md mb-4 flex flex-col md:flex-row gap-4" itemscope itemtype="https://schema.org/Article">
                <div class="entry-image w-full md:w-2/5">
                  <a href="<?php the_permalink(); ?>" itemprop="url">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'object-cover rounded-lg', 'loading' => 'lazy']); ?>
                  </a>
                </div>
                <header class="flex-1">
                    <h3 class="entry-title" itemprop="headline">
                      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </h3>
                    <div class="entry-meta flex mb-4 gap-2">
                     <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                     <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
                    <div class="entry-excerpt">
                      <p class="text-gray-600 text-sm mb-4"><?php echo custom_the_excerpt(); ?></p>
                    </div>
                </header>
            </article>
            <?php endif; ?>
            <?php endwhile; ?>
         <?php else : ?>
            <p class="text-gray-600">No posts found.</p>
            <?php endif; ?>
            <!-- Pagination -->
            <div class="flex justify-center mt-8">
              <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                <?php
                $pagination_args = array(
                  'mid_size'  => 2,
                  'prev_text' => '<span class="px-4 py-2 bg-gray-200 text-gray-700 rounded-l-md hover:bg-gray-300">Previous</span>',
                  'next_text' => '<span class="px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md hover:bg-gray-300">Next</span>',
                  'before_page_number' => '<span class="px-4 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300">',
                  'after_page_number'  => '</span>',
                );
                echo paginate_links( $pagination_args );
                ?>
              </nav>
            </div>
        </div>
        <?php get_template_part('template-parts/sidebar'); ?>
</div>
<?php get_footer(); ?>
