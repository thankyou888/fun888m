<?php
/**
 * Reviews Single post template file.
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
        <!-- กำหนด Schema ให้เป็น Review และปรับ Class -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-base-100 border-base-300 mb-8'); ?> itemscope itemtype="https://schema.org/Review">
            
            <?php if (has_post_thumbnail()): ?>
                <div class="featured-image page-header-image-single mb-4">
                    <?php the_post_thumbnail('large', [
                        'class' => 'rounded-xl w-full h-auto object-cover shadow-md',
                        'loading' => 'lazy',
                        'itemprop' => 'image'
                    ]); ?>
                </div>
            <?php endif; ?>
            
            <header>
                <!-- Title -->               
                <h1 class="entry-title" itemprop="name">
                    <?php the_title(); ?>
                </h1>

                <!-- Game Info Header (shown only when RTP meta exists) -->
                    <?php
                        $rtp = get_post_meta(get_the_ID(), 'rtp', true);
                        $raw_rating = get_post_meta(get_the_ID(), 'star_rating', true);
                        $rating = ($raw_rating !== '') ? intval($raw_rating) : 0;
                        $volatility = get_post_meta(get_the_ID(), 'volatility', true);
                        $show_block = !empty($rtp) && $rating > 0 && !empty($volatility);
                    ?>

                    <?php if ($show_block) : ?>
                    <div class="game-info bg-warning border-base-300 p-4 rounded-md shadow-sm mb-4">
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div class="text-black font-itim">
                                            <span>RTP: </span>
                                            <span class="text-sm text-gray-700"><?php echo esc_html($rtp); ?>%</span>
                                            <div class="inline-block align-middle">
                                               <span>ความนิยม:</span>
                                               <span class="text-sm text-gray-700"><?php echo esc_html($rating); ?>/5</span>
                                               <span class="rating inline-flex items-center" aria-hidden="true">
                                                <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rating) {
                                                            echo '<input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked disabled />';
                                                        } else {
                                                            echo '<input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" disabled />';
                                                        }
                                                    }
                                                ?>
                                               </span>
                                            </div>
                                            
                                    </div>
                                    <div class="text-black text-xs font-itim">
                                            <span>Volatility (ความผันผวน): </span>
                                            <span class="text-sm text-gray-700"><?php echo esc_html( $volatility ); ?></span>
                                    </div>
                            </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($rating > 0) : ?>
                        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating" style="<?php echo $show_block ? '' : 'display:none'; ?>">
                            <meta itemprop="ratingValue" content="<?php echo esc_attr($rating); ?>" />
                            <meta itemprop="bestRating" content="5" />
                            <meta itemprop="worstRating" content="1" />
                        </div>
                    <?php endif; ?>
                
                <!-- Meta Info (ผู้รีวิวและวันที่) -->
                <div class="entry-meta flex mb-4 gap-2">
                    <span class="text-xs bg-info text-white px-2 py-2.5 flex items-center gap-1 rounded-full" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        <span itemprop="name"><?php the_author(); ?></span>
                    </span>
                    <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                    <span class="text-xs bg-info text-white px-2 py-2.5 hidden md:inline-block"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                </div>
            </header>

            <!-- Content Body -->
            <div class="entry-content leading-relaxed sm:text-sm" itemprop="reviewBody">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <?php if (has_tag()): ?>
            <footer class="mt-8 border-t border-gray-200 pt-6">
                <div class="entry-tags">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700">คำที่เกี่ยวข้อง</h2>
                    <div class="flex flex-wrap gap-2 ">
                        <?php the_tags('<span class="inline-block bg-sky-100 text-sky-800 px-3 py-1 text-sm rounded hover:bg-sky-200 transition">','</span><span class="inline-block bg-sky-100 text-sky-800 px-3 py-1 text-sm rounded hover:bg-sky-200 transition">','</span>'); ?>
                    </div>
                </div>
            </footer>
            <?php endif; ?>
        </article>
      
        <!-- Related Posts (นำมาจากหมวดหมู่หรือ Tag ที่เกี่ยวข้องกัน) -->
        <?php
        $args = ContentQuery::get_related_taxonomie(get_post_type());
        if (!empty($args)) {
            $related_query = new WP_Query($args);
            if ( $related_query->have_posts() ) : ?>
            <?php get_template_part('template-parts/related-post',null, array('data' => $related_query)); ?>
            <?php endif; wp_reset_postdata(); 
        } ?>
    </div>

    <!-- Load Sidebar -->
    <?php get_template_part('template-parts/sidebar'); ?>

</div>


<style>
  .rating > input:checked ~ svg {
    stroke: #fbbd23;
  }

</style>