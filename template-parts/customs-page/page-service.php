<?php get_header(); 
use TailPress\ContentQuery
?>
<div class="container mx-auto ">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
           <article itemscope itemtype="https://schema.org/WebPage">
             <header>
               <div class="text-center max-w-4/5 mx-auto py-4 lg:py-8 mb-4">
                  <h1 class="text-3xl"><?php the_title(); ?></h1>
                  <p class="text-sm opacity-60">แหล่งรวมลิงก์และข้อมูลสำคัญสำหรับการเข้าถึงบริการของ Fun88 อย่างครบวงจร ไม่ว่าคุณจะสนใจเดิมพันกีฬา เล่นคาสิโนสด ปั่นสล็อต หรือแทงหวย ที่นี่เรารวมทุกหมวดหมู่ไว้ให้คุณเข้าถึงได้สะดวก รวดเร็ว และปลอดภัย</p>
                </div>
              </header>
              <section class="py-4 lg:py-8 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-4">FUN888 ในปี <?php echo date('Y'); ?> มีอะไรใหม่บ้าง</h2>
                    <ul class="list-disc ml-5 space-y-2">
                      <li>ใบอนุญาตจาก PAGCOR ถูกต้องตามกฎหมาย</li>
                      <li>หน้า UX/UI ใหม่รองรับทั้งคอมพิวเตอร์และมือถือ</li>
                      <li>เพิ่มฟีเจอร์ใหม่: คาสิโนสด 4K & Fast Bet สำหรับกีฬา</li>
                      <li>สนับสนุนการใช้งานอย่างมีความรับผิดชอบ</li>
                      <li>ให้ข้อมูลครบถ้วน เข้าใจง่าย ใช้งานได้ทันที</li>
                      <li>ระบบยืนยันตัวตน คัดกรองเข้มงวด ผู้เล่นต้อง 18 ปี ขึ้นไป</li>
                      <li>ระบบรักษาความปลอดภัยที่ทันสมัย</li>
                      <li>มีทีมงานดูแลลูกค้าตลอด 24 ชั่วโมง</li>
                    </ul>
                  </div>
                  <div class="p-4 ">
                    <figure class="mt-4">
                      <?php the_post_thumbnail('full', [
                      'class' => 'rounded object-cover',
                      'loading' => 'lazy',
                      'itemprop' => 'image'
                      ]); ?>
                    </figure>
                  </div>
                </div>
              </section>
              <section id="service-sport" class="bg-base-100 border-base-300 mb-12">
                <div class="text-center max-w-4/5 mx-auto p-4">
                   <?php 
                            $attr = [ 'class' => 'rounded object-cover', 'alt' => 'เดิมพันกีฬาออนไลน์', 'title' => 'เดิมพันกีฬาออนไลน์ FUN88' ];
                            echo wp_get_attachment_image(2474, 'full', false, $attr); ?>
                  <h2 class="text-2xl p-4">กีฬาออนไลน์ (Sports)</h2>
                  <p class="text-sm opacity-60">สนุกกับการเดิมพันกีฬาหลากหลายชนิด ไม่ว่าจะเป็นฟุตบอล บาสเกตบอล เทนนิส หรืออีสปอร์ต Fun88 นำเสนอแพลตฟอร์มที่ใช้งานง่าย พร้อมราคาต่อรองแบบเรียลไทม์ รองรับทั้งพรีแมตช์และการแทงสด (Live)</p>
                </div>
                <?php 
                   $query = ContentQuery::get_by_post_type('service', [
                      'posts_per_page' => 10,
                      'tax_query' => [
                        [
                          'taxonomy' => 'gambling',
                          'field' => 'slug',  
                          'terms' => 'sportsbook',
                        ],
                      ],
                      'orderby' => 'name',
                      'order' => 'ASC',
                    ]);
                  
                    //print_r($query);

                ?>
                <?php if ($query->have_posts()) : ?>
                  <div class="grid grid-cols-2 md:grid-cols-5 justify-center gap-4">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                      <div class="p-4 text-center">
                        <?php $image_val = get_post_meta(get_the_ID(), 'page_image', true);  ?>
                        <?php if ($image_val) : ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php 
                            $attr = [ 'class' => 'rounded object-cover', 'alt' => get_the_title(), 'title' =>  get_post_type().' '.get_the_title() ];
                            echo wp_get_attachment_image($image_val, 'full', false, $attr); ?>
                          </a>
                        <?php endif; ?>
                        <h3 class="bg-info text-white p-4"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a></h3>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
              </section>
              <section id="service-promotion-sport" class="bg-base-100 border-base-300 py-12 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-4">ข้อเสนอเด็ด FUN88 ปี <?php echo date('Y'); ?></h2>
                     <ul class="grid md:grid-cols-2 gap-6 list-none">
                      <li>🎁 โบนัสต้อนรับ 150% สูงสุด 3,000 บาท</li>
                      <li>🔁 คืนยอดเสียทุกสัปดาห์</li>
                      <li>👯‍♂️ ชวนเพื่อนรับทันที 1,500 บาท</li>
                      <li>🎲 ฟรีสปินรายวันสำหรับสมาชิกสล็อต</li>
                    </ul>
                  </div>
                  <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-4">Feature 2</h2>
                    <p class="text-sm opacity-60">Description of feature 2.</p>
                  </div>
                </div>
            </section>
            <section id="service-casino" class="bg-base-100 border-base-300 mb-12">
              <div class="text-center max-w-4/5 mx-auto">
                 <?php 
                      $attr = [ 'class' => 'rounded object-cover', 'alt' => 'คาสิโนออนไลน์', 'title' => 'คาสิโนออนไลน์ FUN88' ];
                      echo wp_get_attachment_image(2473, 'full', false, $attr); 
                  ?>
                <h2 class="text-2xl p-4">คาสิโนสด (Live Casino)</h2>
                <p class="text-sm mb-4 opacity-60">สัมผัสบรรยากาศคาสิโนจริงผ่านระบบถ่ายทอดสดคุณภาพสูง พบกับดีลเลอร์มืออาชีพ พร้อมเกมยอดนิยม เช่น บาคาร่า รูเล็ต เสือมังกร และแบล็กแจ็ก รองรับทั้งมือใหม่และผู้เล่นมืออาชีพ</p>
              </div>
               <?php 
                   $query = ContentQuery::get_by_post_type('service', [
                      'posts_per_page' => 10,
                      'tax_query' => [
                        [
                          'taxonomy' => 'gambling',
                          'field' => 'slug',  
                          'terms' => 'live-casino',
                        ],
                      ],
                      'orderby' => 'name',
                      'order' => 'ASC',
                    ]);
                 
                ?>
                <?php if ($query->have_posts()) : ?>
                  <div class="grid grid-cols-2 md:grid-cols-5 justify-center gap-4">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                      <div class="p-4 text-center">
                        <?php $image_val = get_post_meta(get_the_ID(), 'page_image', true);  ?>
                        <?php if ($image_val) : ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php 
                            $attr = [ 'class' => 'rounded object-cover', 'alt' => get_the_title(), 'title' =>  get_post_type().' '.get_the_title() ];
                            echo wp_get_attachment_image($image_val, 'full', false, $attr); ?>
                          </a>
                        <?php endif; ?>
                        <h3 class="bg-info text-white p-4"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a></h3>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </section>
            <section id="service-promotion-casino" class="bg-base-100 border-base-300 py-12 mb-12">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 border">
                  <h2 class="text-2xl font-semibold mb-4">ข้อเสนอเด็ดจาก FUN888 <?php echo date('Y'); ?></h2>
                </div>
              </div>
            </section>
            <section id="service-slot" class="bg-base-100 border-base-300 py-12 mb-12">
              <div class="text-center max-w-4/5 mx-auto">
                  <?php 
                      $attr = [ 'class' => 'rounded object-cover', 'alt' => 'สล็อตออนไลน์', 'title' => 'สล็อตออนไลน์ FUN88' ];
                      echo wp_get_attachment_image(2494, 'full', false, $attr); 
                  ?>
                <h2 class="text-2xl p-4">สล็อตออนไลน์ (Slots)</h2>
                <p class="text-sm mb-4 opacity-60">รวมเกมสล็อตจากหลากหลายค่ายชื่อดัง ทั้งแบบคลาสสิกและวิดีโอสล็อต พร้อมฟีเจอร์พิเศษ เช่น ฟรีสปิน แจ็คพอต และโบนัสเกม เหมาะสำหรับผู้ที่มองหาความบันเทิงและธีมเกมที่หลากหลาย</p>                 
              </div>
               <?php 
                   $query = ContentQuery::get_by_post_type('service', [
                      'posts_per_page' => 10,
                      'tax_query' => [
                        [
                          'taxonomy' => 'gambling',
                          'field' => 'slug',  
                          'terms' => 'online-slots',
                        ],
                      ],
                      'orderby' => 'name',
                      'order' => 'ASC',
                    ]);
                 
                ?>
                <?php if ($query->have_posts()) : ?>
                  <div class="grid grid-cols-2 md:grid-cols-5 justify-center gap-4">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                      <div class="p-4 text-center">
                        <?php $image_val = get_post_meta(get_the_ID(), 'page_image', true);  ?>
                        <?php if ($image_val) : ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php 
                            $attr = [ 'class' => 'object-cover', 'alt' => get_the_title(), 'title' => get_the_title() ];
                            echo wp_get_attachment_image($image_val, 'full', false, $attr); ?>
                          </a>
                        <?php endif; ?>
                        <h3 class="bg-info text-white p-4"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a></h3>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </section>
          </article>
      </div>
    </div>
</div>
<?php get_footer(); ?>
