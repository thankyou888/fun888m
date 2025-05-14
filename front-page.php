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
$all_options = get_option('home-page-setting', array());
$value = isset($all_options['jet_post']) ? $all_options['jet_post'] : false;

$section_options = get_option('section_setting', array());
$services_section_title = isset($section_options['services_section_title']) ? $section_options['services_section_title'] : 'Our Services';
$services_section_description = isset($section_options['services_section_description']) ? $section_options['services_section_description'] : '';
$services_section_page = isset($section_options['services_section_page']) ? $section_options['services_section_page'] : '';
get_header(); // Load header template

?>

<div class="container mx-auto ">
      <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1 ">
            <article itemscope itemtype="https://schema.org/WebPage" class="max-w-none">
                    <!-- hero -->
                <section class="hero mb-8">
                        <div class="hero-content flex flex-col lg:flex-row gap-4">
                            <div class="hero-text flex-1">
                                <h1 class="text-3xl font-bold mb-4" ><?php the_title() ?></h1>
                                <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <p class="font-bold"> <span class="text-info"><?php _e('อัพเดทล่าสุด วันที่') ?> </span>: <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></p>
                                <a href="#" class="btn btn-primary">Get Started</a>
                                <a href="#" class="btn btn-primary ">Get Started</a>
                                <a href="#" class="btn btn-error">สมัครสมาชิก</a>
                            </div>
                            <div class="hero-image lg:w-1/2">
                                <img src="https://placehold.co/600x400" alt="Hero Image" class="rounded-lg w-full h-auto object-cover" loading="lazy"> 
                            </div>
                        </div>
                </section>
    <div>
        <?php
        
          
           echo '<pre>';
            print_r($value);
            echo '</pre>';
        ?>
    </div>

                <!-- recommend page -->
                <section class="recommend mb-4">
                        <div class="flex items-center">
                            <h2 class="shrink-0 text-2xl font-bold mb-4 pl-4 border-l-4 border-brand">เริ่มต้นใช้งานง่ายไม่ซับซ้อน</h2>
                            <span class="h-px flex-1 bg-gradient-to-l from-transparent to-gray-300"></span>
                        </div>
                        <?php TailPress\Component::create_feature(null, [
                            'slug__in' => ['fun88-casino','สมัครสมาชิก-fun88']
                        ]); ?>
                </section>
                <!--call to action -->
                <section class="call-to-action flex flex-col lg:flex-row bg-secondary text-white text-center items-center py-12 md:py-24 mb-4">
                    <div class="lg:flex-1"><h2 class="text-2xl font-bold">สมัครใหม่รับโบนัส 120%</h2></div>
                    <div class="lg:flex-2"><p>สมัครสมาชิกใหม่ รับโบนัสเพิ่ม 100% สำหรับเดิมพันสล็อตทุกค่าย รับสุงสุด 8,000 บาท ทำเทิร์นโอเวอร์ 18 เท่า เพื่อถอน</p></div> 
                    <div class="lg:flex-1"><a href="#" class="btn btn-success">สมัครรับโบนัส ทันที!!</a></div>
                </section>
                 <!--call to action -->
                 <section class="call-action mb-4"">
                    <div class="bg-blue-500 text-white p-12 rounded-lg shadow-md text-center">
                        <h2 class="text-2xl font-bold mb-4">สมัครใหม่รับโบนัส 120%!</h2>
                        <p class="text-sm mb-4">สมัครสมาชิกใหม่ รับโบนัสเพิ่ม 100% สำหรับเดิมพันสล็อตทุกค่าย รับสุงสุด 8,000 บาท ทำเทิร์นโอเวอร์ 18 เท่า เพื่อถอน</p>
                        <a href="#" class="btn btn-success transition">สมัครรับโบนัส ทันที!!</a>
                    </div>
                </section>
                <!-- Services Live Casino -->
                 <section class="services my-4 bg-white p-4 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold"><?php echo $services_section_title ?></h2>
                        <a title="View All " href="#" class="text-sm text-gray-500 hover:text-gray-700 transition duration-300" itemprop="url">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="sub-description mb-4">
                                <?php echo $services_section_description ?>
                    </div>
                    <?php  $query = ContentQuery::get_pages($services_section_page,['orderby' => 'post__in']); ?>
                    <?php if ($query->have_posts()): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="bg-white items-center text-center border border-gray-200">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'h-46 object-cover mb-4', 'loading' => 'lazy' , 'itemprop' => 'image']); ?>
                                <h2 class="text-xl font-bold mb-2 "><?php the_title(); ?></h2>
                                <p class="text-gray-700 mb-4">Experience the thrill of live casino games with our expert dealers Experience the thrill of live casino games with our expert dealers.</p>
                                <a href="#" class="btn btn-primary">Play Now</a>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                        <?php else: ?>
                            <div class="error-message text-center p-4 bg-red-100 text-red-700 rounded-lg">
                                <p class="text-gray-600">No services found</p>  
                            </div>
                                <div role="alert" class="alert alert-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>Not found!</span>
                                </div>
                            <?php endif; ?>
                </section> <!-- end services -->
                <!-- about us -->
                <section class="about-us mb-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="about-image w-full lg:w-1/2">
                            <img src="https://placehold.co/600x400" alt="About Us" class="rounded-lg w-full h-auto object-cover" loading="lazy"> 
                        </div>
                        <div class="about-text items-center flex-1 content-center">
                            <h2 class="text-3xl font-bold mb-4">About Us</h2>
                            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="#" class="btn btn-primary text-white rounded px-4 py-2">Learn More</a>
                        </div>
                    </div>
                </section>
                <!-- Latest bonus post list  -->
                <section class="latest-bonus mb-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Latest Bonus Offers</h2>
                        <a title="View All " href="#" class="text-sm text-gray-500 hover:text-gray-700 transition duration-300" itemprop="url">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <div class="bg-white p-4 rounded-lg shadow-md items-center text-center">
                            <img src="https://placehold.co/1200x630" alt="Bonus Post 1" class="rounded-lg w-96 h-auto object-cover mb-4">
                            <h2 class="text-xl font-bold mb-2 ">Bonus Offer 1 <div class="badge badge-secondary">NEW</div></h2>
                            <p class="text-gray-700 mb-4">Get a 100% bonus on your first deposit!</p>
                            <a href="#" class="btn btn-primary">Claim Now</a>
                        </div>
                    </div>
                </section>
            </article>
            <!-- FAQ Section -->
            <section class="entry-faq mb-4" itemscope itemtype="https://schema.org/FAQPage">
                <h2 class="text-2xl font-bold mb-6">คำถามที่พบบ่อย</h2>
                <div class="space-y-4">
                    <div tabindex="0" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <div class="collapse-title font-semibold"><h3 itemprop="name" class="font-semibold text-lg">เราสมัครสมาชิกยังไง?</h3></div>
                            <div  class="collapse-content text-sm" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <p itemprop="text" class="text-gray-700 mt-2">เพียงคลิกที่ปุ่ม “สมัครเลย” ด้านบน แล้วกรอกข้อมูลของคุณ</p>
                            </div>
                    </div>
                    <div tabindex="1" class="collapse collapse-plus bg-base-100 border-base-300 border" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <div class="collapse-title font-semibold"><h3 itemprop="name" class="font-semibold text-lg">เราสมัครสมาชิกยังไง?</h3></div>
                            <div  class="collapse-content text-sm" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <p itemprop="text" class="text-gray-700 mt-2">เพียงคลิกที่ปุ่ม “สมัครเลย” ด้านบน แล้วกรอกข้อมูลของคุณ</p>
                            </div>
                    </div>
                </div>
            </section>
            <section class="entry-bonuses mb-4">
                <h2 class="text-2xl font-bold mb-6">โบนัสและโปรโมชั่น</h2>
                <?php TailPress\Component::create_feature(null, [
                    'slug__in' => ['fun88-casino','สมัครสมาชิก-fun88']
                ]); ?>
            </section>
            <section class="entry-content">
                <?php the_content(); ?>
            </section>
        </div><!-- end flex-1 -->
          <!-- Sidebar -->
      
    </div><!-- end inside-container flex -->
</div> <!-- end container -->    


<?php get_footer(); ?> 