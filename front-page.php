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
                                <a href="#" class="btn btn-primary">ทางเข้า PC</a>
                                <a href="#" class="btn btn-primary">ทางเข้า Mobile</a>
                                <a href="#" class="btn btn-error">สมัครสมาชิก</a>
                            </div>
                        </div>
                        <div class="lg:w-1/2">
                            <?php if (has_post_thumbnail()): ?>
                            <div class="hero-image mb-4">
                                <?php the_post_thumbnail('full', [
                                            'class' => 'rounded h-auto object-cover',
                                            'loading' => 'lazy',
                                            'itemprop' => 'image'
                                            ]); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>
                <div>
                <!-- recommend page -->
                <section class="recommend mb-4">
                    <div class="flex items-center">
                        <h2 class="shrink-0 text-2xl font-bold mb-4 pl-4 border-l-4 border-brand">
                            <?php _e('Getting started') ?>
                        </h2>
                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                    </div>
                    <?php  $query = ContentQuery::get_pages($guide_page,['orderby' => 'post__in']); ?>
                    <?php if ($query->have_posts()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="bg-brand rounded-lg shadow-md p-4 flex flex-col items-center text-center">
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
                <section class="about-us mb-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:py-12 md:py-24">
                        <div class="lg:w-2/3">
                           <h3 class="text-2xl font-bold mb-4">ทางเข้า <?php echo bloginfo('name'); ?> สำรอง</h3>
                           <ul class="list">
                                <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">ทางเข้า FUN88TH</div>
                                    </div>
                                    <a href="#" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                  <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">02</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">Dio Lupa</div>
                                    </div>
                                    <a href="#" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                  <li class="list-row">
                                    <div class="text-4xl font-thin opacity-30 tabular-nums">03</div>
                                    <div class="radial-progress" style="--value:100; --size:3rem;" aria-valuenow="100" role="progressbar">100%</div>
                                    <div class="list-col-grow">
                                        <div class="text-lg font-semibold font-itim">Dio Lupa</div>
                                    </div>
                                    <a href="#" class="btn btn-square btn-primary">
                                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-4">
                                <?php echo $aboutus_title ?>
                            </h2>
                            <div class="text-gray-700 mb-4">
                                <?php echo $aboutus_description ?>
                                 <a href="<?php echo $aboutus_source_page ?>" title="<?php echo $aboutus_title ?>"
                                class="btn btn-primary">อ่านต่อ</a>
                            </div>
                           
                        </div>
                    </div>
                </section>
                <!-- end about us -->
                
                <!--call to action -->
                <section
                    class="call-to-action flex flex-col lg:flex-row bg-secondary text-white text-center items-center gap-4  py-12 md:py-24 mb-4">
                    <div class="lg:flex-1">
                        <h2 class="text-2xl font-bold">สมัครใหม่รับโบนัส 120%</h2>
                    </div>
                    <div class="lg:flex-2">
                        <p>สมัครสมาชิกใหม่ รับโบนัสเพิ่ม 100% สำหรับเดิมพันสล็อตทุกค่าย รับสุงสุด 8,000 บาท
                            ทำเทิร์นโอเวอร์ 18 เท่า เพื่อถอน</p>
                    </div>
                    <div class="lg:flex-1"><a href="#" class="btn btn-success">สมัครรับโบนัส ทันที!!</a></div>
                </section>
                <!--call to action -->
                <section class="call-action mb-4">
                    <div class="bg-blue-500 text-white p-12 rounded-lg shadow-md text-center">
                        <h2 class="text-2xl font-bold mb-4">สมัครใหม่รับโบนัส 120%!</h2>
                        <p class="text-sm mb-4">สมัครสมาชิกใหม่ รับโบนัสเพิ่ม 100% สำหรับเดิมพันสล็อตทุกค่าย รับสุงสุด
                            8,000 บาท ทำเทิร์นโอเวอร์ 18 เท่า เพื่อถอน</p>
                        <a href="#" class="btn btn-success transition">สมัครรับโบนัส ทันที!!</a>
                    </div>
                </section>
                <!-- Services Live Casino -->
                <section class="services my-4 py-12">
                    <div class="flex justify-between items-center lg:text-center mb-4">
                        <h2 class="flex-grow lg:flex-auto text-2xl font-bold">
                            <?php echo $services_section_title ?>
                        </h2>
                        <a title="View All" href="#"
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
                       <div class="bg-white p-4 flex flex-col items-center text-center border border-gray-200">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'h-48 w-full object-cover', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                            <h2 class="text-xl font-bold mt-4">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-gray-700 mb-4"><?php the_excerpt(); ?></div>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <?php else: ?>
                    <div class="error-message text-center p-4 bg-red-100 text-red-700 rounded-lg">
                        <p class="text-gray-600">No services found</p>
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
             
                <!-- Latest bonus post list  -->
                <section class="latest-bonus mb-4 py-12">
                    <div class="flex justify-between items-center">
                        <h2 class="shrink-0 text-2xl font-bold mb-4 pl-4 border-l-4 border-brand">Latest Bonus Offers</h2>
                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                        <a title="View All " href="#"
                            class="text-sm text-gray-500 hover:text-gray-700 transition duration-300" itemprop="url">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
                    </div>
                    <?php  $query = ContentQuery::get_by_post_type('bonuses'); ?>
                    <?php if ($query->have_posts()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                       <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                            <div class="entry-image relative mb-4">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'rounded w-full h-auto object-cover', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                                <div class="absolute top-0 left-0 p-2">
                                     <div class="badge badge-secondary">NEW</div>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold mb-4">
                                <?php the_title(); ?>
                            </h2>
                            <p class="text-gray-700 mb-4">
                                <span class="text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                </span>: <time datetime="<?php echo get_the_modified_date('c'); ?>"
                                    itemprop="dateModified">
                                    <?php echo get_the_modified_date('j M Y'); ?>
                                </time>
                            </p>
                            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"
                                class="btn btn-primary">รายละเอียดเพิ่มเติม</a>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <?php endif; ?>
                </section>
            </article>
            <!-- FAQ Section -->
            <section class="entry-faq mb-4" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="text-2xl font-bold mb-6">คำถามที่พบบ่อย</h2>
                <div class="space-y-4">
                    <div tabindex="0" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope
                        itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="collapse-title font-semibold">
                            <h3 itemprop="name" class="font-semibold text-lg">เราสมัครสมาชิกยังไง?</h3>
                        </div>
                        <div class="collapse-content text-sm" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            <p itemprop="text" class="text-gray-700 mt-2">เพียงคลิกที่ปุ่ม “สมัครเลย” ด้านบน
                                แล้วกรอกข้อมูลของคุณ</p>
                        </div>
                    </div>
                    <div tabindex="1" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope
                        itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <div class="collapse-title font-semibold">
                            <h3 itemprop="name" class="font-semibold text-lg">เราสมัครสมาชิกยังไง?</h3>
                        </div>
                        <div class="collapse-content text-sm" itemscope itemprop="acceptedAnswer"
                            itemtype="https://schema.org/Answer">
                            <p itemprop="text" class="text-gray-700 mt-2">เพียงคลิกที่ปุ่ม “สมัครเลย” ด้านบน
                                แล้วกรอกข้อมูลของคุณ</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="entry-bonuses mb-4">

                <div class="flex items-center">
                    <span class="h-px flex-1 bg-gradient-to-r from-transparent to-gray-300"></span>
                    <h2 class="shrink-0 text-2xl font-bold mb-4 px-4">โบนัสและโปรโมชั่น</h2>
                    <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                </div>
                <?php TailPress\Component::create_feature(null, [
                    'slug__in' => ['fun88-casino','สมัครสมาชิก-fun88']
                ]); ?>
            </section>
            <section class="entry-content">
                <?php the_content(); ?>
            </section>
            <?php get_template_part('template-parts/content','games'); ?>
        </div><!-- end flex-1 -->
        <!-- Sidebar -->

    </div><!-- end inside-container flex -->
</div> <!-- end container -->


<?php get_footer(); ?>