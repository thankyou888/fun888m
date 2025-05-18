<?php get_header(); ?>


<div class="container my-8 mx-auto ">
      <div class="flex flex-col lg:flex-row min-h-screen gap-4">
          <div class="flex-1 ">
            <article itemscope itemtype="https://schema.org/WebPage" class="max-w-none">
            <?php if (has_post_thumbnail()): ?>
                      <div class="featured-image page-header-image-single mb-4">
                          <?php the_post_thumbnail('full', [
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
                        <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                        <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
              </header>

              <div class="entry-content" itemprop="text">
                <?php the_content(); ?>
                <?php do_action('page_after_content'); ?>
              </div>

            </article>
          </div>

            <!-- Sidebar -->
            <?php if ( get_theme_mod('show_sidebar', true) ) : ?>
              <?php get_template_part('template-parts/sidebar'); ?>
            <?php endif; ?>
        </div>
</div>

<?php get_footer(); ?>
