<?php get_header(); ?>

<div class="bg-white py-10">
  <div class="container mx-auto flex flex-col lg:flex-row gap-8">
    <!-- Main Content -->
    <div class="flex-1">
      <article itemscope itemtype="https://schema.org/WebPage" class="prose prose-lg max-w-none">
        <?php if ( has_post_thumbnail() ) : ?>
          <figure class="mb-6">
            <?php the_post_thumbnail('large', [
              'class' => 'rounded-lg w-full h-auto object-cover',
              'loading' => 'lazy'
            ]); ?>
          </figure>
        <?php endif; ?>

        <?php if ( function_exists('rank_math_the_breadcrumbs') ) : ?>
          <div class="breadcrumbs">
            <div class="mb-4 text-sm text-gray-500" itemscope itemtype="https://schema.org/BreadcrumbList">
              <?php rank_math_the_breadcrumbs(); ?>
            </div>
          </div>
        <?php endif; ?>

        <h1 class="entry-title text-3xl font-bold" itemprop="headline"><?php the_title(); ?></h1>

        <div class="inline-block my-4 text-sm text-gray-500">
        <span class="entry-date"> <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"></time>
        เผยแพร่เมื่อ <?php echo get_the_date('j M Y'); ?></span> 
          <span class="entry-date">
            <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified">
              อัปเดตล่าสุด <?php echo get_the_modified_date('j M Y'); ?>
            </time>
          </span>
        </div>

        <div class="entry-content" itemprop="text">
          <?php the_content(); ?>
        </div>

      </article>
    </div>

    <!-- Sidebar -->
    <?php if ( get_theme_mod('show_sidebar', true) ) : ?>
      <?php get_template_part( 'template-parts/sidebar' ); ?>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
