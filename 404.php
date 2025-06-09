<?php get_header(); ?>

<section class="min-h-screen flex items-center justify-center bg-base-200 px-6">
  <div class="text-center max-w-md">
    <h1 class="text-9xl font-bold text-primary">404</h1>
    <h2 class="text-3xl font-semibold mt-6 text-base-content">ไม่พบหน้านี้</h2>
    <p class="mt-2 text-base-content/70">
      ขออภัย ไม่พบหน้าที่คุณกำลังมองหา อาจถูกลบหรือย้ายที่ไปแล้ว
    </p>

    <div class="mt-6 space-x-4">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
        กลับหน้าหลัก
      </a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline btn-secondary">
        ติดต่อเรา
      </a>
    </div>

    <div class="mt-10">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.webp" alt="404 Not Found" class="w-full max-w-xs mx-auto" loading="lazy">
    </div>
  </div>
</section>

<?php get_footer(); ?>
