<?php
/**
 * Archive Page Template - Tailwind CSS v4.0 + Flex Layout + SEO + Core Web Vitals + Grid/List Layout Toggle
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }
get_header(); // Load header template

?>

<div class="container my-8 mx-auto bg-gray-100">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
          <!--recent post list y -->
          <h1 class="text-2xl font-bold mb-4" itemprop="headline">เนื้อหาล่าสุด</h1>
    
          <?php if (have_posts()): ?>
              <?php $first = true; $index = 0; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              <?php while (have_posts()): the_post(); ?>
                 <?php if ( $first ) : $first = false; ?>
                <article class="md:col-span-3 bg-white p-4 rounded-lg shadow-md" itemscope itemtype="https://schema.org/CreativeWork">
                    <div class="entry-image relative">
                        <a href="<?php the_permalink(); ?>" >
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full h-auto object-cover rounded', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                        </a>
                        <?php $catagory = get_the_category(get_the_ID()); ?>
                        <div class="badge rounded-none badge-accent top-[-0.7rem] left-[-0.7rem] absolute py-4 text-xs">
                            <a href="<?php echo esc_url(get_category_link($catagory[0]->term_id)); ?>"><?php echo esc_html($catagory[0]->name); ?></a>
                            
                        </div>
                    </div>
                    <header>
                      <h3 class="entry-title text-lg font-bold mb-4" itemprop="headline">
                        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                      </h3>
                      <div class="entry-meta flex mb-4 gap-2">
                      <span class=" text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                      <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                      </div>
                    </header>
                </article> 
                  <?php else : ?>
                    <article  id="post-<?php the_ID() ?>" <?php post_class('bg-white p-4 rounded-lg shadow-md') ?> itemscope itemtype="https://schema.org/CreativeWork">
                      <div class="entry-image relative mb-4">
                          <a href="<?php the_permalink(); ?>">
                              <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-full h-auto object-cover rounded', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                          </a>
                          <?php $catagory = get_the_category(get_the_ID()); ?>
                          <div class="badge rounded-none badge-accent top-[-0.7rem] left-[-0.7rem] absolute text-xs">
                              <a href="<?php echo esc_url(get_category_link($catagory[0]->term_id)); ?>"><?php echo esc_html($catagory[0]->name); ?></a>
                              
                          </div>
                      </div>
                      <header>
                        <h3 class="entry-title text-lg font-bold mb-4" itemprop="headline" >
                          <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                        </h3>
                        <div class="entry-meta flex mb-4 gap-2">
                          <span class=" text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                          <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                        </div>
                      </header>
                   </article> 

                  <?php endif; ?>
              <?php endwhile; ?>           
            </div>
            <?php else: ?>
            <div class="bg-white p-4 rounded shadow-md">
                <p class="text-gray-600">ไม่มีเนื้อหาใหม่</p>  
            </div>
            <?php endif; ?>
            <?php 
                $posts_per_page = get_option('posts_per_page');
                // ดึง ID ของ Recent Posts
                $categories = get_categories();
                $recent_posts = get_posts(['posts_per_page' => $posts_per_page]);
                $exclude_ids = wp_list_pluck($recent_posts, 'ID');

            ?>
             
            <?php 
              foreach ($categories as $category) :
                $query = new WP_Query([
                    'cat' => $category->term_id,
                    'posts_per_page' => 3,
                    'post__not_in' => $exclude_ids,
                ]);
            
            ?>
            <!-- Section Posts By catagory  -->
             <?php if ($query->have_posts()): ?>
                <section class="post-cat mt-4 bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                      
                        <h2 class="shrink-0 text-xl font-bold mb-4 pl-4 border-l-4 border-brand" itemprop="name"><?php echo esc_html($category->name); ?></a> (<?php echo esc_html($category->count); ?>)</h2>
                        
                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                        
                        <a title="View All <?php echo esc_html($category->name); ?>" href="<?php echo get_category_link($category->term_id); ?> " class="text-sm text-gray-500 hover:text-gray-700 transition duration-300" itemprop="url">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
            
                    </div> 
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                          <article itemscope itemtype="https://schema.org/CreativeWork">
                              <div class="entry-image relative mb-4">
                                <a href="<?php the_permalink(); ?>">
                                  <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'object-cover', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                                </a>
                              </div>
                              <header>
                                  <h3 class="entry-title text-lg font-bold mb-4" itemprop="headline"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a> </h3>
                                  <div class="entry-meta flex mb-4 gap-2">
                                    <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                                    <span class=" text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                                  </div>
                              </header>
                          </article>
                        <?php endwhile; ?>
                    </div>
                </section>  
              <?php endif; ?>
          <?php  
            wp_reset_postdata(); // Reset post data after custom query
            endforeach; 
          ?>

        </div>
        <?php get_template_part('template-parts/sidebar'); ?>
    </div>
</div>

<?php get_footer(); // Load footer template ?>