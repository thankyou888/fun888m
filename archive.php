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
<div class="container my-8 mx-auto">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
          <?php if ( is_category() ) : ?>
            <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php echo _e('หมวดหมู่'); ?> : <span class="text-accent"><?php single_cat_title(); ?></span></h1>
          <?php elseif ( is_tag() ) : ?>
            <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php echo _e('แท็ก'); ?> : <span class="text-accent"><?php single_tag_title(); ?></span></h1>
          <?php elseif ( is_author() ) : ?>
            <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php echo _e('เขียนโดย'); ?> : <span class="text-accent"><?php the_author(); ?></span></h1>    
          <?php elseif ( is_date() ) : ?>
            <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php echo _e('คลังรายปี'); ?> : <span class="text-accent"><?php the_time('F Y'); ?></span></h1>
          <?php else : ?>
            <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php echo _e('Archive'); ?> : <span class="text-accent"><?php the_archive_title(); ?></span></h1>
          <?php endif; ?>
            <?php if ( have_posts() ) : ?>
              <?php $first = true; ?>
            <!-- Content Archive First Post-->
            <?php while ( have_posts() ) : the_post(); ?>
            <?php if ( $first ) : $first = false; ?>
            <article id="post-<?php the_ID() ?>" class="flex flex-col bg-base-100 border-base-300 p-4 mb-8" itemscope itemtype="https://schema.org/Article">          
                <div class="entry-image relative mb-4">
                  <a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full object-cover', 'loading' => 'lazy']); ?>
                  </a>
                </div>
                <header>
                 <h3 class="entry-title text-xl font-bold mb-4" itemprop="headline">
                      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </h3>
                  </h3>
                    <div class="entry-meta flex mb-4 gap-2">
                     <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                     <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
                    <div class="entry-excerpt" itemprop="text">
                      <p class="text-sm opacity-60 mb-4"><?php echo custom_the_excerpt(); ?></p>
                    </div>
                </header>
            </article>
            <?php else : ?>
            <!-- Content Archive Second Post-->
            <article id="post-<?php the_ID() ?>" class="bg-base-100 border-base-300 p-4 mb-8 flex flex-col md:flex-row gap-4" itemscope itemtype="https://schema.org/Article">
                <div class="entry-image w-full md:w-2/5">
                  <a href="<?php the_permalink(); ?>" >
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'object-cover', 'loading' => 'lazy']); ?>
                  </a>
                </div>
                <header class="flex-1">
                    <h3 class="entry-title text-xl font-bold mb-4" itemprop="headline">
                      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </h3>
                    <div class="entry-meta flex mb-4 gap-2">
                     <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                     <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
                    <div class="entry-excerpt itemprop="text">
                      <p class="text-sm mb-4 opacity-60"><?php echo custom_the_excerpt(); ?></p>
                    </div>
                </header>
            </article>
            <?php endif; ?>
            <?php endwhile; ?>
         <?php else : ?>
            <p class="text-sm opacity-60">No posts found.</p>
            <?php endif; ?>
            <!-- Pagination -->
            <div class="flex justify-center mt-8">
              <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                <?php
                $pagination_args = array(
                  'mid_size'  => 2,
                  'prev_text' => '<span class="px-4 py-2 text-sm rounded-l-md ">Previous</span>',
                  'next_text' => '<span class="px-4 py-2 text-sm rounded-r-md">Next</span>',
                  'before_page_number' => '<span class="px-4 py-2 text-sm ">',
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
