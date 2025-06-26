<?php
/**
 * Front Page template
 *
 * @package TailPress
 *
 * Front Page Template - Tailwind CSS v4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }
use TailPress\ContentQuery;
$home_setting = get_option('home_page_setting', array());
$guide_page = isset($home_setting['jet_post']) ? $home_setting['jet_post'] : false;
$hero_short = isset($home_setting['hero_short_descriptions']) ? $home_setting['hero_short_descriptions'] : '';

$section_options = get_option('section_setting', array());
$services_section_title = isset($section_options['services_section_title']) ? $section_options['services_section_title'] : 'Our Services';
$services_section_description = isset($section_options['services_section_description']) ? $section_options['services_section_description'] : '';
$services_section_page = isset($section_options['services_section_page']) ? $section_options['services_section_page'] : '';
$aboutus_title = isset($section_options['aboutus_title']) ? $section_options['aboutus_title'] : '';
$aboutus_description = isset($section_options['aboutus_description']) ? $section_options['aboutus_description'] : '';
$aboutus_source_page = isset($section_options['aboutus_source_page']) ? $section_options['aboutus_source_page'] : '';

$call_to_action_title = isset($section_options['call_to_action_title']) ? $section_options['call_to_action_title'] : '';
$call_to_action_subtitle = isset($section_options['call_to_action_subtitle']) ? $section_options['call_to_action_subtitle'] : '';
$call_to_action_link = isset($section_options['call_to_action_link']) ? $section_options['call_to_action_link'] : '';
get_header(); // Load header template

?>

<div class="container mx-auto ">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
            <article itemscope itemtype="https://schema.org/WebPage">
                <!-- hero -->
                <header class="hero mb-8 py-4 lg:py-12">
                    <div class="hero-content flex flex-col lg:flex-row gap-4">
                        <div class="hero-text flex-1">
                            <h1 class="text-3xl font-bold mb-4">
                                <?php the_title() ?>
                            </h1>
                            <div class="mb-4"><?php echo $hero_short; ?></div>
                            <div class="mb-4"> <span class="text-info">
                                    <?php _e('อัปเดทล่าสุด วันที่') ?>
                                </span>: <time datetime="<?php echo get_the_modified_date('c'); ?>"
                                    itemprop="dateModified">
                                    <?php echo get_the_modified_date('j M Y'); ?>
                                </time></div>
                            <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                                <a href="<?php echo esc_url($home_setting['hero_link_1']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-primary">ทางเข้า PC</a>
                                <a href="<?php echo esc_url($home_setting['hero_link_2']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-primary">ทางเข้า Mobile</a>
                                <a href="<?php echo get_theme_mod('sidebar_banner_link');?>" target="_blank" rel="noopener noreferrer nofollow sponsored" class="btn btn-error">สมัครสมาชิก</a>
                            </div>
                        </div>
                        <div class="lg:w-1/2">
                            <?php if (has_post_thumbnail()): ?>
                                <figure class="mb-4">
                                            <?php the_post_thumbnail('full', [
                                                        'class' => 'rounded h-auto object-cover',
                                                        'itemprop' => 'image'
                                                        ]); ?>
                                </figure>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>
                <!-- recommend page -->
                <section class="recommend mb-4">
                    <div class="flex items-center">
                        <h2 class="shrink-0 text-2xl font-bold mb-4 pl-4 border-l-4 border-brand">
                            แนะนำการใช้งาน Fun88
                        </h2>
                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                    </div>
                    <?php  $query = ContentQuery::get_pages($guide_page,['orderby' => 'post__in']); ?>
                    <?php if ($query->have_posts()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="bg-info text-info-content rounded-lg shadow-md p-4 flex flex-col items-center text-center">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'h-auto object-cover', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                            <h2 class="text-2xl text-white font-bold mt-4">
                               <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <?php endif; ?>
                </section>
                 <!-- about us -->
                <section class="about-us mb-4 sm:py-8 md:py-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="lg:w-2/3">
                           <h3 class="text-2xl font-bold mb-4">ทางเข้า Fun88 เปลี่ยนแปลงบ่อย</h3>
                           <ul class="list">
                                <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">ทางเข้า FUN88TH</div>
                                        <span class="text-sm opacity-60">อัปเดทล่าสุด</span>
                                    </div>
                                    <a href="<?php echo esc_url($home_setting['hero_link_1']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                  <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">02</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">ทางเข้า Fun88asia1</div>
                                        <span class="text-sm opacity-60">อัปเดทล่าสุด</span>
                                    </div>
                                    <a href="<?php echo esc_url($home_setting['hero_link_2']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                  <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">03</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">99%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">ทางเข้า Fun88 Thai</div>
                                        <span class="text-sm opacity-60">สำรอง ลิงค์ล่าสุด</span>
                                    </div>
                                    <a href="<?php echo esc_url($home_setting['hero_link_3']) ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                </li>
                                  <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">04</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">ติดต่อเจ้าหน้าที่</div>
                                        <span class="text-sm opacity-60">แชทสด 24 ชม.</span>
                                    </div>
                                    <a href="/contact" target="_blank" rel="noopener" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-4">
                                <?php echo $aboutus_title ?>
                            </h2>
                            <div class="entry-content mb-4">
                                <?php echo $aboutus_description ?>
                            </div>
                           
                        </div>
                    </div>
                </section>
                <!--call to action -->
                <section class="call-action mb-4">
                    <div class="bg-primary text-primary-content p-12 rounded-lg shadow-md text-center">
                        <h2 class="text-2xl font-bold mb-4"><?php echo $call_to_action_title; ?></h2>
                        <p class="text-sm mb-4"><?php echo $call_to_action_subtitle; ?></p>
                        <a href="<?php echo $call_to_action_link; ?>" target="_blank" rel="noopener noreferrer nofollow" class="btn btn-success transition duration-300">รายละเอียดเพิ่มเติม</a>
                    </div>
                </section>
                <!-- Services Section -->
                <section class="services my-4 py-12">
                    <div class="flex justify-between items-center lg:text-center mb-4">
                        <h2 class="flex-grow lg:flex-auto text-2xl font-bold">
                            <?php echo $services_section_title ?>
                        </h2>
                        <a title="View All Service" href="/service"
                            class="text-sm text-gray-500 hover:text-gray-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="sub-description mb-4 lg:max-w-2/3 text-center mx-auto ">
                        <?php echo $services_section_description ?>
                    </div>
                    <?php  $query = ContentQuery::get_pages($services_section_page,['orderby' => 'post__in']); ?>
                    <?php if ($query->have_posts()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                       <div class="bg-base-100 border-base-300 p-4 flex flex-col items-center text-center">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'h-48 w-full object-cover', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                            <h2 class="text-xl font-bold my-4">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="text-sm opacity-60"> <?php echo jet_engine()->listings->data->get_meta( 'page_short_descriptions' ); ?></p>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <?php else: ?>
                    <div class="error-message text-center p-4 bg-red-100 text-red-700 rounded">
                        <p class="text-base-100">No services found</p>
                    </div>
                    <div role="alert" class="alert alert-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Not found!</span>
                    </div>
                    <?php endif; ?>
                </section> <!-- end services -->
                <div class="entry-content" itemprop="text">
                    <?php the_content(); ?>
                </div>
            </article>
            <!-- recent posts -->
            
            <!-- FAQ Section -->
            <section class="entry-faq mb-4" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="text-2xl font-bold mb-6">คำถามที่พบบ่อย</h2>
                <div class="space-y-4">
                    <div tabindex="0" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope
                        itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="collapse-title font-semibold">
                            <h3 itemprop="name" class="font-semibold text-lg">ทำไมต้องมีทางเข้าสำรอง Fun88?</h3>
                        </div>
                        <div class="collapse-content text-sm" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            <p itemprop="text" class=" mt-2">ทางเข้าสำรอง Fun88 คือทางเลือกสำคัญที่ช่วยให้ผู้เล่นสามารถเข้าใช้งานเว็บไซต์ได้อย่างต่อเนื่อง โดยไม่ติดปัญหาการบล็อกจากเครือข่าย หรือระบบล่มในบางช่วงเวลา ซึ่งการมีลิงก์สำรองไว้ใช้งาน จะช่วยให้ประสบการณ์เดิมพันของคุณไม่สะดุด และปลอดภัยยิ่งขึ้น
</p>
                        </div>
                    </div>
                    <div tabindex="1" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope
                        itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="collapse-title font-semibold">
                            <h3 itemprop="name" class="font-semibold text-lg">ทางเข้า Fun88 คืออะไร? ทำไมต้องมี</h3>
                        </div>
                        <div class="collapse-content text-sm" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            <p itemprop="text" class=" mt-2">“ทางเข้า Fun88” คือ ลิงก์หรือ URL ที่ใช้เข้าสู่หน้าเว็บไซต์ของ FUN88 โดยตรง ไม่ว่าจะเป็นเวอร์ชันมือถือหรือเดสก์ท็อป ซึ่งจะช่วยให้ผู้เล่นสามารถเข้าถึงบริการต่างๆ ได้อย่างรวดเร็ว ไม่ต้องค้นหาเองหลายขั้นตอน

อย่างไรก็ตาม ด้วยข้อจำกัดด้านกฎหมายหรือการเซ็นเซอร์เว็บไซต์ในบางประเทศ (เช่น ไทย) ลิงก์หลักของ Fun88 อาจถูกบล็อกชั่วคราว ซึ่งทำให้คุณไม่สามารถเข้าใช้งานได้ตามปกติ นั่นจึงเป็นที่มาของ “ทางเข้าสำรอง Fun88” ที่จะช่วยให้คุณสามารถเข้าเล่นได้ต่อเนื่องโดยไม่สะดุด</p>
                        </div>
                    </div>
                      <div tabindex="2" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope
                        itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="collapse-title font-semibold">
                            <h3 itemprop="name" class="font-semibold text-lg">ทำไมบางครั้ง Fun88 เข้าไม่ได้?</h3>
                        </div>
                        <div class="collapse-content text-sm" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            <p itemprop="text" class=" mt-2">หากคุณเคยประสบปัญหา เข้าเว็บไซต์ Fun88 ไม่ได้ หรือโหลดช้าเป็นบางช่วง อย่าเพิ่งตกใจ เพราะอาจไม่ได้เกิดจากปัญหาของระบบโดยตรง แต่อาจเกิดจากปัจจัยภายนอกหลายประการที่เกี่ยวข้องกับอุปกรณ์ของคุณ หรือเครือข่ายอินเทอร์เน็ตในประเทศไทยนั่นเอง</p>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- end flex-1 -->
        <!-- Sidebar -->

    </div><!-- end inside-container flex -->
</div> <!-- end container -->


<?php get_footer(); ?>