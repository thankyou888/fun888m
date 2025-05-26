<?php get_header(); 
use TailPress\ContentQuery
?>
<div class="container mx-auto ">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
           <article itemscope itemtype="https://schema.org/WebPage">
             <header class="bg-white py-12">
               <div class="text-center py-14 mb-4">
                  <h1 class="text-3xl"><?php the_title(); ?></h1>
                  <p class="text-sm"> ยกระดับประสบการณ์พนันออนไลน์ของคุณกับ FUN88 แพลตฟอร์มที่รวมทุกการเดิมพันในที่เดียว พร้อมฟีเจอร์สุดล้ำและโปรโมชั่นจัดเต็มตลอดปี 2025</p>
             </header>
              <section class="py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-4 border">
                    <h2 class="text-2xl font-semibold mb-4">FUN88 ในปี <?php echo date('Y'); ?></h2>
                    <ul class="list-disc text-gray-700 ml-5 space-y-2">
                      <li>ใบอนุญาตจาก PAGCOR ถูกต้องตามกฎหมาย</li>
                      <li>ระบบฝาก-ถอนอัตโนมัติภายใน 1 นาที</li>
                      <li>รองรับทั้งคอมพิวเตอร์และมือถือ</li>
                      <li>โบนัสต้อนรับและโปรโมชั่นอัปเดตทุกเดือน</li>
                      <li>เพิ่มฟีเจอร์ใหม่: คาสิโนสด 4K & Fast Bet สำหรับกีฬา</li>
                    </ul>
                  </div>
                  <div class="p-4 border">
                    <img src="https://placehold.co/600x400" alt="หน้าแดชบอร์ด FUN88 ปี 2025" class="rounded-xl shadow-md w-full h-auto" /> 
                  </div>
                </div>
              </section>
              <section id="service-sport" class="bg-white py-12">
                <div class="text-center max-w-4/5 mx-auto">
                  <img src="https://cache.ltt55.com/uploads/Sports_c0fc34e799.avif?imwidth=1200" alt="เดิมพันกีฬาออนไลน์ FUN88 2025" class="rounded-xl shadow-md w-full h-auto mt-6" />
                  <h2 class="text-2xl">⚽ เดิมพันกีฬาออนไลน์ ค่าน้ำดีที่สุด</h2>
                  <p class="text-gray-600 mb-4">เดิมพันกีฬาออนไลน์ กลายเป็นหนึ่งในรูปแบบความบันเทิงที่ทั้งสนุกและสร้างรายได้ได้จริง โดยเฉพาะเมื่อคุณเลือกเดิมพันกับแพลตฟอร์มที่เชื่อถือได้อย่าง FUN88 ที่รวมการแข่งขันจากทั่วโลกไว้ให้คุณในที่เดียว ไม่ว่าจะเป็นฟุตบอล บาสเก็ตบอล เทนนิส มวย หรือแม้กระทั่งอีสปอร์ต</p>
                  <ul class="list-none space-y-2 text-gray-700">
                    <li>🎯 แทงบอลสดเรียลไทม์พร้อมสถิติประกอบ</li>
                    <li>💸 ค่าน้ำสูงกว่าคู่แข่ง</li>
                    <li>📲 เดิมพันด่วนผ่านมือถือ รองรับ 100%</li>
                  </ul>
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
                      <div class="p-4">
                        <?php $meta_value = get_post_meta(get_the_ID(), 'image_banner', true);  ?>
                        <?php if ($meta_value) : ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php 
                            $attr = [ 'class' => 'rounded w-50 h-50 object-cover', 'alt' => get_the_title(), 'title' =>  get_post_type().' '.get_the_title() ];
                            echo wp_get_attachment_image($meta_value, 'full', false, $attr); ?>
                          </a>
                        <?php endif; ?>
                        <h3 class="text-lg font-semibold p-4 bg-brand text-white"><?php the_title(); ?></h3>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
              </section>
              <section id="service-promotion-sport" class="py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-4 border">
                    <h2 class="text-2xl font-semibold mb-4">ข้อเสนอเด็ด FUN88 ปี <?php echo date('Y'); ?></h2>
                     <ul class="grid md:grid-cols-2 gap-6 text-gray-700 list-none">
                      <li>🎁 โบนัสต้อนรับ 150% สูงสุด 3,000 บาท</li>
                      <li>🔁 คืนยอดเสียทุกสัปดาห์</li>
                      <li>👯‍♂️ ชวนเพื่อนรับทันที 1,500 บาท</li>
                      <li>🎲 ฟรีสปินรายวันสำหรับสมาชิกสล็อต</li>
                    </ul>
                  </div>
                  <div class="p-4 border">
                    <h2 class="text-2xl font-semibold mb-4">Feature 2</h2>
                    <p class="text-sm">Description of feature 2.</p>
                  </div>
                </div>
            </section>
            <section id="service-casino" class="bg-white py-12">
              <div class="text-center max-w-4/5 mx-auto">
                <img src="https://cache.ltt55.com/uploads/Casino_6d22c94a19.avif?imwidth=1200" alt="คาสิโนสด FUN88 2025" class="rounded-xl shadow-md w-full h-auto mt-6" />
                <h2 class="text-2xl">คาสิโนออนไลน์</h2>
                <p class="text-gray-700 mb-3">หากคุณกำลังมองหา คาสิโนออนไลน์ ที่ให้มากกว่าความบันเทิง FUN88 คือคำตอบที่ใช่ในปี 2025! ที่นี่คุณจะได้สัมผัสกับประสบการณ์คาสิโนสดส่งตรงจากสตูดิโอระดับโลก ภาพคมชัดระดับ 4K ดีลเลอร์มืออาชีพ และโต๊ะเกมหลากหลายให้เลือก ทั้งบาคาร่า เสือมังกร รูเล็ต และซิกโบ</p>
                <ul class="list-none ml-5 text-gray-700 space-y-2">
                  <li>บาคาร่าสด เสือมังกร รูเล็ต และซิกโบ</li>
                  <li>ห้อง VIP สำหรับผู้เล่นระดับสูง</li>
                  <li>รองรับทุกอุปกรณ์ ใช้งานลื่นไหล</li>
                </ul>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-5 justify-center gap-4">
                  <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="ตลาดเดิมพันที่หลากหลาย" />
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">BTI</h3>
                  </div>
                  <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="สถิติและข้อมูลเชิงลึก"  />   
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">CMD</h3>
                  </div>
                  <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">SABA</h3>
                  </div>
                  <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">SBOBET</h3>
                  </div>
                    <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">SBOBET</h3>
                  </div>
                  <div class="p-4">
                    <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                    <h3 class="text-lg font-semibold p-4 bg-brand text-white">SBOBET</h3>
                  </div>
                </div>
            </section>
            <section id="service-promotion-casino" class="py-12">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 border">
                  <h2 class="text-2xl font-semibold mb-4">ข้อเสนอเด็ด FUN88 ปี <?php echo date('Y'); ?></h2>
                  <ul class="grid md:grid-cols-2 gap-6 text-gray-700 list-none">
                    <li>🎁 โบนัสต้อนรับ 150% สูงสุด 3,000 บาท</li>
                    <li>🔁 คืนยอดเสียทุกสัปดาห์</li>
                    <li>👯‍♂️ ชวนเพื่อนรับทันที 1,500 บาท</li>
                    <li>🎲 ฟรีสปินรายวันสำหรับสมาชิกสล็อต</li>
                  </ul>
                </div>
              </div>
            </section>
            <section id="service-slot" class="bg-white py-12">
              <div class="text-center max-w-4/5 mx-auto">
                <img src="https://cache.ltt55.com/uploads/Slot_2c8f0b1a3d.avif?imwidth=1200" alt="สล็อตออนไลน์ FUN88 2025" class="rounded-xl shadow-md w-full h-auto mt-6" />
                <h2 class="text-2xl">สล็อตออนไลน์</h2>
                <p class="text-gray-700 mb-3">หากคุณเป็นแฟนของสล็อตออนไลน์ FUN88 คือสวรรค์ของคุณ! ด้วยเกมสล็อตจากค่ายชั้นนำกว่า 20 ค่าย รวมถึง PG Soft, Microgaming, และ Playtech คุณจะได้พบกับเกมที่มีกราฟิกสวยงาม ฟีเจอร์โบนัสมากมาย และแจ็คพอตที่รอคุณอยู่</p>  
                <ul class="list-none ml-5 text-gray-700 space-y-2">
                  <li>เกมสล็อต 3D กราฟิกสวยงาม</li>
                  <li>แจ็คพอตแตกง่าย โบนัสเพียบ</li>
                  <li>รองรับทุกอุปกรณ์ ใช้งานลื่นไหล</li>
                </ul>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-5 justify-center gap-4">
                <div class="p-4">
                  <img src="https://placehold.co/600x400" alt="ตลาดเดิมพันที่หลากหลาย" />
                  <h3 class="text-lg font-semibold p-4 bg-brand text-white">BTI</h3>
                </div>
                <div class="p-4">
                  <img src="https://placehold.co/600x400" alt="สถิติและข้อมูลเชิงลึก"  />   
                  <h3 class="text-lg font-semibold p-4 bg-brand text-white">CMD</h3>
                </div>
                <div class="p-4">
                  <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                  <h3 class="text-lg font-semibold p-4 bg-brand text-white">SABA</h3>
                </div>
                <div class="p-4">
                  <img src="https://placehold.co/600x400" alt="แทงบอลสดเรียลไทม์"  />
                  <h3 class="text-lg font-semibold p-4 bg-brand text-white">SBOBET</h3>
                </div>
              </div>
            </section>
          </article>
      </div>
    </div>
</div>
<?php get_footer(); ?>
