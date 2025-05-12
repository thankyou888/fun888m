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
                                <h1 class="text-3xl font-bold mb-4">Welcome to Our Website</h1>
                                <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <a href="#" class="btn btn-primary text-white bg-blue-600 rounded px-4 py-2">Get Started</a>
                                <a href="#" class="btn btn-primary text-white bg-blue-600 rounded px-4 py-2">Get Started</a>
                                <a href="#" class="btn btn-error text-white rounded px-4 py-2">Get Started</a>
                            </div>
                            <div class="hero-image  w-full lg:w-1/2">
                                <img src="https://placehold.co/600x400" alt="Hero Image" class="rounded-lg w-full h-auto object-cover" loading="lazy"> 
                            
                            </div>
                        </div>
                </section>
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
                <section class="call-to-action flex flex-col lg:flex-row bg-sky-700 text-white text-center items-center p-4 mb-4">
                    <div class="lg:flex-1"><h2 class="text-2xl font-bold mb-4">สมัครใหม่รับโบนัส 120%</h2></div>
                    <div class="lg:flex-2"><p class="mb-4">สมัครสมาชิกใหม่ รับโบนัสเพิ่ม 100% สำหรับเดิมพันสล็อตทุกค่าย รับสุงสุด 8,000 บาท ทำเทิร์นโอเวอร์ 18 เท่า เพื่อถอน</p></div> 
                    <div class="lg:flex-1"><a href="#" class="btn btn-success hover:bg-primary rounded px-4 py-2">สมัครรับโบนัส ทันที!!</a></div>
                </section>
                <!-- Services Live Casino -->
                 <section class="services my-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Our Services</h2>
                        <a title="View All " href="#" class="text-sm text-gray-500 hover:text-gray-700 transition duration-300" itemprop="url">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 inline-block text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="sub-description mb-4">
                        <p class="text-gray-700">หน้าหลัก > ข่าวสาร Fun88 > สมัครคาสิโนออนไลน์ Fun88 ทดลองเล่นฟรี 300 บาท
สมัครคาสิโนออนไลน์ Fun88 ทดลองเล่นฟรี 300 บาท
by fun788club
Fun88 แนะนำเพื่อนที่สนใจมาเป็นสมาชิกใหม่กับเราวันนี้ สมัครคาสิโนออนไลน์ ทดลองเล่นฟรีทันที คาสิโนสดจากเว็บของเราเป็นบ่อนที่เปิดขึ้นมาให้ผู้เล่นสามารถที่จะเล่นได้ผ่านทางอินเทอร์เน็ตโดยที่ผู้เล่นไม่จำเป็นจะต้องเดินทางไปถึงที่บ่อนโดยตรงเพื่อเล่นเกมส์ต่างๆในบ่อน เพราะเกมส์คาสิโนออนไลน์เกิดขึ้นมาในยุคที่มีความเร็วของอินเทอร์เน็ตซึ่งส่งผลต่อการส่งถ่ายข้อมูลต่างๆที่รวดเร็วขึ้น ที่สำคัญคือ บัญชีธนาคารของผู้เล่นสามารถที่จะถูกผูกเข้ากับระบบเพื่อทำให้ผู้เล่น สามารถที่จะเล่นเกมส์ผ่านทางออนไลน์อีกทั้งยังสามารถที่จะจ่าย/รับเงินได้ ผ่านทางบัญชีของผู้เล่นโดยตรง</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <div class="bg-white p-4 rounded-lg shadow-md items-center text-center">
                            <img src="https://placehold.co/1200x630" alt="Service 1" class="rounded-lg w-full h-auto object-cover mb-4">
                            <h2 class="text-xl font-bold mb-2 ">Live Casino</h2>
                            <p class="text-gray-700 mb-4">Experience the thrill of live casino games with our expert dealers Experience the thrill of live casino games with our expert dealers.</p>
                            <a href="#" class="btn btn-primary">Play Now</a>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md items-center text-center">
                            <img src="https://placehold.co/1200x630" alt="Service 2" class="rounded-lg w-full h-auto object-cover mb-4">
                            <h2 class="text-xl font-bold mb-2 ">Sports Betting</h2>
                            <p class="text-gray-700 mb-4">Bet on your favorite sports and enjoy exciting odds Experience the thrill of live casino games with our expert dealers.</p>
                            <a href="#" class="btn btn-primary">Bet Now</a>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md items-center text-center">
                            <img src="https://placehold.co/1200x630" alt="Service 3" class="rounded-lg w-full h-auto object-cover mb-4">
                            <h2 class="text-xl font-bold mb-2 ">Online Slots</h2>
                            <p class="text-gray-700 mb-4">Spin the reels and win big with our online slot games Experience the thrill of live casino games with our expert dealers.</p>
                            <a href="#" class="btn btn-primary">Play Slots</a>
                        </div>
                    </div>
                </section>
                <!-- about us -->
                <section class="about-us mb-4">
                    <div class="flex flex-col lg:flex-row gap-4 ">
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
            <section class="the_contnet">
                <?php the_content(); ?>
            </section>
        </div><!-- end flex-1 -->
          <!-- Sidebar -->
      
    </div><!-- end inside-container flex -->
</div> <!-- end container -->    


<?php get_footer(); ?> 