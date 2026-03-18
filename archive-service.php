<?php
/**
 * Archive Service Page Template
/* The code `if ( ! defined( 'ABSPATH' ) ) { exit; }` is a security measure commonly used in WordPress
themes and plugins. */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

get_header(); // Load header template
use TailPress\ContentQuery;
?>
<div class="container mx-auto ">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
            <article itemscope itemtype="https://schema.org/WebPage">
                <header>
                    <div class="text-center max-w-4/5 mx-auto py-4 lg:py-8 mb-4">
                        <h1 class="text-3xl" itemprop="headline"><?php the_archive_title(); ?></h1>
                        <p class="text-sm opacity-60"><?php the_archive_description(); ?></p>
                    </div>
                </header>
                <section class="py-4 lg:py-8 mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4">
                            <h2 class="text-2xl font-semibold mb-4">FUN888 ในปี <?php echo date('Y'); ?> มีอะไรใหม่บ้าง
                            </h2>
                            <ul class="list-disc ml-5 space-y-2">
                                <li>ใบอนุญาตจาก PAGCOR ถูกต้องตามกฎหมาย</li>
                                <li>หน้า UX/UI ใหม่รองรับทั้งคอมพิวเตอร์และมือถือ</li>
                                <li>เพิ่มฟีเจอร์ใหม่ คาสิโนสด 4K & Fast Bet สำหรับกีฬา</li>
                                <li>สนับสนุนการใช้งานอย่างมีความรับผิดชอบ</li>
                                <li>ให้ข้อมูลครบถ้วน เข้าใจง่าย ใช้งานได้ทันที</li>
                                <li>ระบบยืนยันตัวตน คัดกรองเข้มงวด ผู้เล่นต้อง 18 ปี ขึ้นไป</li>
                                <li>ระบบรักษาความปลอดภัยที่ทันสมัย</li>
                                <li>มีทีมงานดูแลลูกค้าตลอด 24 ชั่วโมง</li>
                            </ul>
                        </div>
                        <div class="p-4 ">
                            <figure class="mt-4">
                                  <?php
                                  $attr = [ 'class' => 'rounded object-cover', 'alt' => 'เดิมพันออนไลน์ APP', 'title' => 'Fun88 Mobile Betting APP' ];
                                  echo wp_get_attachment_image(2510, 'full', false, $attr);  
                                  ?>
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
                        <p class="text-sm opacity-60">สนุกกับการเดิมพันกีฬาหลากหลายชนิด ไม่ว่าจะเป็นฟุตบอล บาสเกตบอล
                            เทนนิส หรืออีสปอร์ต Fun88 นำเสนอแพลตฟอร์มที่ใช้งานง่าย พร้อมราคาต่อรองแบบเรียลไทม์
                            รองรับทั้งพรีแมตช์และการแทงสด (Live)</p>
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
                            <h3 class="bg-info text-white p-4"><a
                                    href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a>
                            </h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>
                <section id="service-sport-info" class="bg-base-100 border-base-300 py-12 mb-12">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

                        <!-- คอลัมน์ที่ 1: สัมผัสบรรยากาศคาสิโนจริง -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🎥 <span class="ml-2">สัมผัสบรรยากาศคาสิโนจริง ผ่านการถ่ายทอดสดคุณภาพสูง</span>
                            </h3>
                            <p class="leading-relaxed">
                                การเล่น <strong class="text-sky-600">คาสิโนสด</strong> บน FUN88
                                ไม่ใช่แค่การคลิกเพื่อเดิมพัน แต่คือการยกบรรยากาศจาก <strong>คาสิโนระดับโลก</strong>
                                มาไว้ตรงหน้าคุณ ผ่านระบบถ่ายทอดสดความคมชัดระดับ Full HD ที่ให้คุณได้เล่นกับ
                                <strong>ดีลเลอร์สาวจริงในเวลาจริง</strong> พร้อมทั้งมีเสียงพูดคุย เสียงเปิดไพ่
                                และตารางสถิติแบบอินเตอร์แอคทีฟให้คุณวิเคราะห์ได้แบบสดๆ
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li>มีให้เลือกทั้งห้องเอเชีย & ยุโรป</li>
                                <li>รองรับภาษาไทย & อังกฤษ</li>
                                <li>ระบบไม่มีสะดุด รองรับทุกอุปกรณ์</li>
                                <li>มีห้อง VIP สำหรับสายทุนสูงโดยเฉพาะ</li>
                            </ul>
                            <p class="mt-4">
                                เหมือนนั่งอยู่โต๊ะจริง โดยไม่ต้องเดินทางไปคาสิโนต่างประเทศ!
                            </p>
                        </div>

                        <!-- คอลัมน์ที่ 2: เกมคาสิโนสดยอดนิยม -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🃏 <span class="ml-2">เกมยอดนิยมที่ให้บริการแบบสด ครบทุกประเภท</span>
                            </h3>
                            <p class="leading-relaxed">
                                ในโหมด <strong class="text-sky-600">Live Casino</strong> ของ FUN88
                                คุณสามารถเลือกเล่นเกมยอดฮิตได้ครบทุกประเภทจากค่ายดังอย่าง Evolution, Sexy Baccarat, WM
                                Casino, Pragmatic Play Live เป็นต้น โดยเกมที่เปิดให้เดิมพันแบบเรียลไทม์ ได้แก่:
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li><strong>บาคาร่า (Baccarat)</strong> – เลือกเดิมพันฝั่งเจ้ามือ/ผู้เล่น
                                    ลุ้นเปิดไพ่กันสดๆ</li>
                                <li><strong>เสือมังกร (Dragon Tiger)</strong> – เกมเร็วตัดสินในไพ่ใบเดียว</li>
                                <li><strong>รูเล็ต (Roulette)</strong> – วงล้อหมุนจริงพร้อมเสียงดึงดูดใจ</li>
                                <li><strong>ไฮโล (Sic Bo)</strong> – แทงสูงต่ำแบบเรียลไทม์ เห็นลูกเต๋าจริง</li>
                                <li><strong>แบล็กแจ็ค (Blackjack)</strong> – สายกลยุทธ์ไม่ควรพลาด!</li>
                            </ul>
                            <p class="mt-4">
                                ทุกเกมเดิมพันสดปลอดภัย ได้รับใบรับรองจากผู้ให้บริการระดับโลก
                            </p>
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
                        <p class="text-sm mb-4 opacity-60">สัมผัสบรรยากาศคาสิโนจริงผ่านระบบถ่ายทอดสดคุณภาพสูง
                            พบกับดีลเลอร์มืออาชีพ พร้อมเกมยอดนิยม เช่น บาคาร่า รูเล็ต เสือมังกร และแบล็กแจ็ก
                            รองรับทั้งมือใหม่และผู้เล่นมืออาชีพ</p>
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
                            <h3 class="bg-info text-white p-4"><a
                                    href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a>
                            </h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>
                <section id="service-casino-info" class="bg-base-100 border-base-300 py-12 mb-12">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

                        <!-- คอลัมน์ที่ 1: สัมผัสบรรยากาศคาสิโนจริง -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🎥 <span class="ml-2">สัมผัสบรรยากาศคาสิโนจริง ผ่านการถ่ายทอดสดคุณภาพสูง</span>
                            </h3>
                            <p class="leading-relaxed">
                                การเล่น <strong class="text-sky-600">คาสิโนสด</strong> บน FUN88
                                ไม่ใช่แค่การคลิกเพื่อเดิมพัน แต่คือการยกบรรยากาศจาก <strong>คาสิโนระดับโลก</strong>
                                มาไว้ตรงหน้าคุณ ผ่านระบบถ่ายทอดสดความคมชัดระดับ Full HD ที่ให้คุณได้เล่นกับ
                                <strong>ดีลเลอร์สาวจริงในเวลาจริง</strong> พร้อมทั้งมีเสียงพูดคุย เสียงเปิดไพ่
                                และตารางสถิติแบบอินเตอร์แอคทีฟให้คุณวิเคราะห์ได้แบบสดๆ
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li>มีให้เลือกทั้งห้องเอเชีย & ยุโรป</li>
                                <li>รองรับภาษาไทย & อังกฤษ</li>
                                <li>ระบบไม่มีสะดุด รองรับทุกอุปกรณ์</li>
                                <li>มีห้อง VIP สำหรับสายทุนสูงโดยเฉพาะ</li>
                            </ul>
                            <p class="mt-4">
                                เหมือนนั่งอยู่โต๊ะจริง โดยไม่ต้องเดินทางไปคาสิโนต่างประเทศ!
                            </p>
                        </div>

                        <!-- คอลัมน์ที่ 2: เกมคาสิโนสดยอดนิยม -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🃏 <span class="ml-2">เกมยอดนิยมที่ให้บริการแบบสด ครบทุกประเภท</span>
                            </h3>
                            <p class="leading-relaxed">
                                ในโหมด <strong class="text-sky-600">Live Casino</strong> ของ FUN88
                                คุณสามารถเลือกเล่นเกมยอดฮิตได้ครบทุกประเภทจากค่ายดังอย่าง Evolution, Sexy Baccarat, WM
                                Casino, Pragmatic Play Live เป็นต้น โดยเกมที่เปิดให้เดิมพันแบบเรียลไทม์ ได้แก่
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li><strong>บาคาร่า (Baccarat)</strong> – เลือกเดิมพันฝั่งเจ้ามือ/ผู้เล่น
                                    ลุ้นเปิดไพ่กันสดๆ</li>
                                <li><strong>เสือมังกร (Dragon Tiger)</strong> – เกมเร็วตัดสินในไพ่ใบเดียว</li>
                                <li><strong>รูเล็ต (Roulette)</strong> – วงล้อหมุนจริงพร้อมเสียงดึงดูดใจ</li>
                                <li><strong>ไฮโล (Sic Bo)</strong> – แทงสูงต่ำแบบเรียลไทม์ เห็นลูกเต๋าจริง</li>
                                <li><strong>แบล็กแจ็ค (Blackjack)</strong> – สายกลยุทธ์ไม่ควรพลาด!</li>
                            </ul>
                            <p class="mt-4">
                                ทุกเกมเดิมพันสดปลอดภัย ได้รับใบรับรองจากผู้ให้บริการระดับโลก
                            </p>
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
                        <p class="text-sm mb-4 opacity-60">รวมเกมสล็อตจากหลากหลายค่ายชื่อดัง
                            ทั้งแบบคลาสสิกและวิดีโอสล็อต พร้อมฟีเจอร์พิเศษ เช่น ฟรีสปิน แจ็คพอต และโบนัสเกม
                            เหมาะสำหรับผู้ที่มองหาความบันเทิงและธีมเกมที่หลากหลาย</p>
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
                            <a href="<?php the_permalink(); ?>">
                                <?php $image_val = get_post_meta(get_the_ID(), 'page_image', true); ?>
                                <?php if ($image_val) : ?>
                                <?php
                                    $attr = [ 'class' => 'object-cover', 'alt' => get_the_title(), 'title' => get_the_title() ];
                                    echo wp_get_attachment_image($image_val, 'full', false, $attr);
                                ?>
                                <?php else : ?>
                                <img class="object-cover" src="https://placehold.co/400x400?text=No+Image"
                                    alt="<?php echo esc_attr(get_the_title()); ?>"
                                    title="<?php echo esc_attr(get_the_title()); ?>">
                                <?php endif; ?>
                            </a>
                            <h3 class="bg-info text-white p-4"><a
                                    href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), 'page_title', true)); ?></a>
                            </h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>
                 <section id="service-slots-info" class="bg-base-100 border-base-300 py-12 mb-12">
                    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

                        <!-- คอลัมน์ที่ 1: สนุกกับสล็อตจากค่ายดังระดับโลก -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🎰 <span class="ml-2">สนุกกับสล็อตจากค่ายดังระดับโลก</span>
                            </h3>
                            <p class="leading-relaxed">
                                หากคุณเป็นสายปั่นสล็อตตัวจริง ห้ามพลาดกับ <strong class="text-sky-600">สล็อตออนไลน์
                                    FUN88</strong> ที่รวมเกมสล็อตมากกว่า 1,000 เกมจากค่ายชั้นนำอย่าง PG, JILI, Pragmatic
                                Play, Red Tiger และอีกมากมาย ซึ่งแต่ละเกมมาพร้อมฟีเจอร์เฉพาะ แจ็คพอตใหญ่
                                และโหมดฟรีสปินที่ให้รางวัลสูงสุดในคลิกเดียว
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li>รวมเกมยอดนิยม RTP สูงกว่า 96%</li>
                                <li>รองรับมือถือ เล่นลื่นไม่มีสะดุด</li>
                                <li>สามารถทดลองเล่นฟรีได้ทุกเกม</li>
                                <li>มีเกมใหม่อัปเดตทุกสัปดาห์</li>
                            </ul>
                            <p class="mt-4">
                                สายล่ารางวัล ห้ามพลาดโอกาสปั่นสล็อตลุ้นแจ็คพอตใหญ่ได้ทุกวัน!
                            </p>
                        </div>

                        <!-- คอลัมน์ที่ 2: ฟีเจอร์เด่นและโบนัสพิเศษสำหรับเกมสล็อต -->
                        <div>
                            <h3 class="text-2xl font-semibold mb-4 flex items-center">
                                🧨 <span class="ml-2">ฟีเจอร์เด่นและโบนัสพิเศษสำหรับเกมสล็อต</span>
                            </h3>
                            <p class="leading-relaxed">
                                FUN88 ไม่เพียงแค่มีเกมสล็อตให้เลือกมากมาย แต่ยังมาพร้อม <strong
                                    class="text-sky-600">ฟีเจอร์สุดล้ำ</strong> ที่เพิ่มโอกาสชนะ เช่น Bonus Buy,
                                Multiplier, Cascading Reels และระบบ Megaways รวมถึง <strong>โปรโมชั่นสล็อต</strong>
                                ที่ออกแบบมาเพื่อผู้เล่นโดยเฉพาะ:
                            </p>
                            <ul class="list-disc pl-6 mt-4 space-y-2">
                                <li>โบนัสฝากครั้งแรก 100% สำหรับสล็อต</li>
                                <li>คืนยอดเสียสล็อตรายวัน</li>
                                <li>ภารกิจหมุนสล็อตแลกรางวัล</li>
                                <li>แจกฟรีสปินทุกสัปดาห์</li>
                            </ul>
                            <p class="mt-4">
                                ทุกการหมุนมีโอกาสเป็นเงินสดจริง พร้อมสิทธิ์ลุ้นรางวัลใหญ่แบบไม่ต้องลุ้นหลายรอบ!
                            </p>
                        </div>

                    </div>
                </section>

            </article>
        </div>
    </div>
</div>
<?php get_footer(); ?>
