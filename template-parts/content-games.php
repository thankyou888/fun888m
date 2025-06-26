<?php
/**
 * Games Single post template file.
 *
 * @package TailPress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }
use TailPress\ContentQuery;
?>

<div class="flex flex-col lg:flex-row min-h-screen gap-4">
    <div class="flex-1">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/CreativeWork" >
            <?php if (has_post_thumbnail()): ?>
                <div class="featured-image page-header-image-single mb-4">
                    <?php the_post_thumbnail('large', [
                    'class' => 'rounded w-full h-auto object-cover',
                    'loading' => 'lazy',
                    'itemprop' => 'image'
                    ]); ?>
                </div>
            <?php endif; ?>
            <header>
                <!-- Title -->
                <h1 class="entry-title text-2xl font-bold mb-4" itemprop="headline"><?php the_title(); ?></h1>
                 <!-- Meta Info -->
                <div class="entry-meta flex mb-4 gap-2">
                    <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                    <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                </div>
            </header>
            <!-- Content Body -->
            <div class="entry-content" itemprop="text">
                <?php the_content(); ?>
            </div>
            <!-- Tags -->
            <?php if (has_tag()): ?>
            <footer>
                <div class="entry-tags">
                    <h2 class="text-xl font-semibold mb-4">คำที่เกี่ยวข้อง</h2>
                    <div class="flex flex-wrap gap-2">
                        <?php the_tags('<span class="inline-block bg-info px-3 py-1 text-sm">','</span><span class="inline-block bg-info px-3 py-1 text-sm">','</span>'); ?>
                    </div>
                </div>
            </footer>
            <?php endif; ?>
        </article>
      
        
        <!-- Related Posts by Tag or Category -->
        <?php
        $args = ContentQuery::get_related_taxonomie(get_post_type());
        $related_query = new WP_Query($args);
        if ( $related_query->have_posts() ) : ?>
        <?php get_template_part('template-parts/related-post',null, array('data' => $related_query)); ?>
        <?php endif; wp_reset_postdata(); ?>
    </div>

    <?php get_template_part('template-parts/sidebar'); ?>

</div>