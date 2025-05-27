<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }

if ( isset( $args['data'] ) ) : 
     $related_query = $args['data']; 
?>

<div class="entry-related-posts">
    <div class="flex items-center">
        <h2 class="shrink-0 text-xl font-bold mb-4 pl-4 border-l-4 border-brand">เนื้อหาที่เกี่ยวข้อง</h2>
        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <article class="bg-white p-4 rounded-lg shadow-md mb-4">
            <div class="entry-image">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" itemprop="url">
                   <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'rounded-lg w-96 h-auto object-cover mb-4', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                </a>
                <?php endif; ?>
            </div>
            <header>
                <h3 class="entry-title text-lg font-semibold mb-2">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <div class="entry-meta flex gap-2">
                        <span class="text-white text-xs bg-sky-700 update-time px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                </div>
            </header>
        </article>
    <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>