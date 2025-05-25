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
                    <h1 class="entry-title text-3xl font-bold mb-4" itemprop="headline"><?php the_title(); ?>XXX</h1>
                    <!-- Meta Info -->
                    <div class="entry-meta flex mb-4 gap-2">
                        <span class="hidden text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                        <span class="text-white text-xs bg-sky-700 px-2 py-2.5"><?php _e('อัปเดท ล่าสุด') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                    </div>
              </header>

              <div class="entry-content" itemprop="text">
                <?php the_content(); ?>
                <?php do_action('page_after_content'); ?>
                <!-- content -->
                 <section class="bg-white py-12 px-4 md:px-16 lg:px-32">
  <div class="max-w-6xl mx-auto text-center">
    <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-6">
      พนันออนไลน์ 2025 กับ FUN88 ครบทุกความมันส์ กีฬา คาสิโน สล็อต หวย ในที่เดียว!
    </h1>
    <p class="text-gray-600 text-lg">
      ยกระดับประสบการณ์พนันออนไลน์ของคุณกับ FUN88 แพลตฟอร์มที่รวมทุกการเดิมพันในที่เดียว พร้อมฟีเจอร์สุดล้ำและโปรโมชั่นจัดเต็มตลอดปี 2025
    </p>
  </div>
</section>

<section class="bg-gray-50 py-12">
  <div class="max-w-6xl mx-auto px-4 md:px-0 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
    <div>
      <h2 class="text-2xl font-semibold text-blue-700 mb-4">✅ ทำไมต้องเลือก FUN88 ในปี 2025?</h2>
      <ul class="list-disc text-gray-700 ml-5 space-y-2">
        <li>ใบอนุญาตจาก PAGCOR ถูกต้องตามกฎหมาย</li>
        <li>ระบบฝาก-ถอนอัตโนมัติภายใน 1 นาที</li>
        <li>รองรับทั้งคอมพิวเตอร์และมือถือ</li>
        <li>โบนัสต้อนรับและโปรโมชั่นอัปเดตทุกเดือน</li>
        <li>เพิ่มฟีเจอร์ใหม่: คาสิโนสด 4K & Fast Bet สำหรับกีฬา</li>
      </ul>
    </div>
    <div>
      <img src="https://placehold.co/600x400" alt="หน้าแดชบอร์ด FUN88 ปี 2025" class="rounded-xl shadow-md" />
    </div>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">⚽ เดิมพันกีฬาออนไลน์ ค่าน้ำดีที่สุด</h2>
    <p class="text-gray-600 mb-4">ทุกแมตช์ที่คุณรัก ทั้งบอลลีกใหญ่ บอลไทย เทนนิส บาสเก็ตบอล หรืออีสปอร์ต – ครบหมดในที่เดียว</p>
    <ul class="list-none space-y-2 text-gray-700">
      <li>🎯 แทงบอลสดเรียลไทม์พร้อมสถิติประกอบ</li>
      <li>💸 ค่าน้ำสูงกว่าคู่แข่ง</li>
      <li>📲 เดิมพันด่วนผ่านมือถือ รองรับ 100%</li>
    </ul>
    <img src="https://placehold.co/1200x630" alt="เดิมพันกีฬากับ FUN88" class="mx-auto mt-6 rounded-lg shadow" />
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto px-4 md:px-0">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
      <div>
        <img src="https://placehold.co/600x400" alt="คาสิโนสด FUN88 2025" class="rounded-xl shadow-md" />
      </div>
      <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🎲 คาสิโนสด 4K สัมผัสประสบการณ์ลาสเวกัส</h2>
        <p class="text-gray-700 mb-3">พบกับดีลเลอร์สาวสวย ถ่ายทอดสดจากสตูดิโอระดับโลก ตลอด 24 ชั่วโมง พร้อมฟีเจอร์ใหม่ “Lucky Studio” ให้คุณเลือกโต๊ะและดีลเลอร์ได้เอง</p>
        <ul class="list-disc ml-5 text-gray-700 space-y-2">
          <li>บาคาร่าสด เสือมังกร รูเล็ต และซิกโบ</li>
          <li>ห้อง VIP สำหรับผู้เล่นระดับสูง</li>
          <li>รองรับทุกอุปกรณ์ ใช้งานลื่นไหล</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🎰 สล็อตออนไลน์ 3D แตกง่าย กำไรเร็ว</h2>
    <p class="text-gray-700 mb-6">คัดเฉพาะเกมแตกง่ายจากค่ายดัง PG, JILI, Pragmatic Play และอีกกว่า 1,000 เกม</p>
    <ul class="text-gray-700 space-y-2 list-none">
      <li>🔥 RTP สูงกว่า 96% พร้อมโบนัสแตกไว</li>
      <li>🎮 ระบบทดลองเล่นฟรี ไม่ต้องฝาก</li>
      <li>📆 อัปเดตเกมใหม่ทุกเดือน เช่น Crypto Quest, Ancient Samurai X</li>
    </ul>
    <img src="https://placehold.co/600x400" alt="สล็อตออนไลน์ FUN88 ปี 2025" class="mt-6 mx-auto rounded-lg shadow" />
  </div>
</section>

<section class="py-16 bg-gray-100">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📅 หวยออนไลน์ ครบทุกประเภท ไม่มีเลขอั้น</h2>
    <p class="text-gray-700 mb-4">เล่นหวยไทย ลาว ฮานอย หุ้น แบบไม่มีขั้นต่ำ พร้อมผลประกาศเรียลไทม์ จ่ายสูงสุดบาทละ 900</p>
    <ul class="text-gray-700 space-y-2 list-none">
      <li>📌 เลือกเลขได้เอง ไม่ล็อกเลข</li>
      <li>🕒 ระบบแจ้งเตือนก่อนหวยออก</li>
      <li>🔐 ปลอดภัย จ่ายจริง ถอนได้ทันที</li>
    </ul>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-2xl font-bold text-blue-800 mb-6">💎 โปรโมชั่น FUN88 ปี 2025</h2>
    <p class="text-gray-700 mb-4">รวมข้อเสนอสุดพิเศษเฉพาะสมาชิก FUN88 ที่คุณไม่ควรพลาด!</p>
    <ul class="grid md:grid-cols-2 gap-6 text-gray-700 list-none">
      <li>🎁 โบนัสต้อนรับ 150% สูงสุด 3,000 บาท</li>
      <li>🔁 คืนยอดเสียทุกสัปดาห์</li>
      <li>👯‍♂️ ชวนเพื่อนรับทันที 1,500 บาท</li>
      <li>🎲 ฟรีสปินรายวันสำหรับสมาชิกสล็อต</li>
    </ul>
  </div>
</section>

<section class="py-16 bg-blue-50">
  <div class="max-w-4xl mx-auto text-center px-4">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">🚀 เริ่มต้นเดิมพันกับ FUN88 ง่ายๆ ใน 3 ขั้นตอน</h2>
    <ol class="list-decimal list-inside text-gray-700 space-y-2 text-left max-w-xl mx-auto">
      <li>สมัครสมาชิกฟรีผ่าน <a href="#" class="text-blue-600 underline">หน้าเว็บไซต์</a></li>
      <li>ฝากเงินขั้นต่ำ 100 บาท</li>
      <li>เลือกเกมที่ต้องการ แล้วเริ่มลุ้นได้ทันที!</li>
    </ol>
  </div>
</section>
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
