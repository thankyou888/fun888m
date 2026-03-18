<?php
/**
 * Archive Reviews Page Template
 *
 * @package TailPress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); // Load header template

use TailPress\ContentQuery;
use TailPress\Pagination;

global $wp_query;
$review_count  = isset( $wp_query->found_posts ) ? (int) $wp_query->found_posts : 0;
$current_year  = gmdate( 'Y' );
$service_query = ContentQuery::get_by_post_type(
    'service',
    [
        'posts_per_page' => 5,
        'orderby'        => 'name',
        'order'          => 'ASC',
    ]
);
$games_query   = ContentQuery::get_by_post_type(
    'games',
    [
        'posts_per_page' => 4,
    ]
);
?>

<div class="container mx-auto">
    <div class="flex flex-col lg:flex-row min-h-screen gap-4">
        <div class="flex-1">
            <article itemscope itemtype="https://schema.org/CollectionPage">
                <header class="relative overflow-hidden rounded-3xl bg-neutral text-neutral-content mb-8">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.45),_transparent_32%),linear-gradient(135deg,_rgba(255,255,255,0.1),_transparent_55%)]"></div>
                    <div class="relative px-6 py-10 lg:px-10 lg:py-14">
                        <div class="max-w-4xl">
                            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-1 text-sm tracking-wide uppercase">
                                Reviews Hub
                            </span>
                            <h1 class="mt-4 text-3xl lg:text-5xl font-bold leading-tight" itemprop="headline">
                                <?php echo esc_html( post_type_archive_title( '', false ) ); ?>
                            </h1>
                            <p class="mt-4 text-base lg:text-lg text-white/80 max-w-3xl" itemprop="description">
                                รวมหน้ารีวิวเกมและบริการที่เน้นข้อมูลอ่านง่าย ทันสมัย และสแกนรายละเอียดสำคัญได้เร็ว
                                ทั้งภาพรวมการใช้งาน จุดเด่น ข้อควรรู้ และข้อมูลประกอบการตัดสินใจในปี
                                <?php echo esc_html( $current_year ); ?>.
                            </p>
                            <div class="mt-6 flex flex-wrap gap-3 text-sm">
                                <span class="rounded-full bg-white text-neutral px-4 py-2 font-semibold">
                                    รีวิวทั้งหมด <?php echo esc_html( number_format_i18n( $review_count ) ); ?> รายการ
                                </span>
                                <span class="rounded-full border border-white/30 px-4 py-2">
                                    อัปเดตตามโพสต์ล่าสุดในระบบ
                                </span>
                                <span class="rounded-full border border-white/30 px-4 py-2">
                                    โฟกัสที่ UX และ SEO-friendly content
                                </span>
                            </div>
                        </div>
                    </div>
                </header>

                <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-10">
                    <div class="lg:col-span-2 bg-base-100 rounded-3xl p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">หน้ารวมรีวิวที่อ่านง่ายและช่วยค้นหาข้อมูลได้ไว</h2>
                        <p class="leading-relaxed opacity-80 mb-4">
                            หน้านี้รวบรวมรีวิวที่คัดหัวข้อสำคัญไว้ชัดเจน เช่น ภาพรวมเกม จุดเด่น ความน่าเล่น
                            ค่า RTP, ระดับความผันผวน และคะแนนรีวิว เพื่อให้ผู้ใช้สแกนข้อมูลได้เร็วขึ้นทั้งบนมือถือและเดสก์ท็อป
                            ขณะเดียวกันยังช่วยให้โครงสร้างเนื้อหาดีต่อการทำ SEO ด้วย heading ที่ชัดเจน
                            internal links และข้อความสรุปที่ตอบ intent ของผู้ค้นหา.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                            <div class="rounded-2xl bg-base-200 p-4">
                                <strong class="block mb-1">อ่านจบเร็ว</strong>
                                สรุปประเด็นสำคัญของแต่ละรีวิวในรูปแบบที่กวาดตาแล้วเข้าใจได้ทันที
                            </div>
                            <div class="rounded-2xl bg-base-200 p-4">
                                <strong class="block mb-1">ข้อมูลประกอบการเลือก</strong>
                                ใช้ meta อย่างคะแนนดาว, RTP และ volatility มาช่วยให้ข้อมูลมีน้ำหนักมากขึ้น
                            </div>
                            <div class="rounded-2xl bg-base-200 p-4">
                                <strong class="block mb-1">เชื่อมต่อหน้าที่เกี่ยวข้อง</strong>
                                ลิงก์ต่อไปยังเกมและบริการอื่น ๆ เพื่อให้ผู้ใช้ไปต่อได้ง่าย
                            </div>
                        </div>
                    </div>
                    <div class="bg-base-100 rounded-3xl p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">ควรดูอะไรในรีวิว</h2>
                        <ul class="space-y-3 text-sm opacity-80">
                            <li>คะแนนรีวิวช่วยให้เห็นภาพรวมแบบรวดเร็ว</li>
                            <li>RTP เหมาะสำหรับดูแนวโน้มการคืนทุนของเกม</li>
                            <li>Volatility ช่วยประเมินสไตล์การเล่นที่เหมาะกับตัวเอง</li>
                            <li>ภาพหน้าปกและคำอธิบายสั้นช่วยคัดโพสต์ที่ตรงความสนใจได้ไวขึ้น</li>
                            <li>วันอัปเดตช่วยให้เห็นความใหม่ของข้อมูลในหน้ารีวิว</li>
                        </ul>
                    </div>
                </section>

                <?php if ( have_posts() ) : ?>
                    <?php $is_featured = true; ?>
                    <section class="space-y-6 mb-10">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            $short_description = ContentQuery::jet( 'review_short_descriptions', get_the_ID() );
                            $summary           = $short_description ? $short_description : get_the_excerpt();
                            $rtp               = get_post_meta( get_the_ID(), 'rtp', true );
                            $volatility        = get_post_meta( get_the_ID(), 'volatility', true );
                            $rating            = (int) get_post_meta( get_the_ID(), 'star_rating', true );
                            $thumbnail_html    = get_the_post_thumbnail(
                                get_the_ID(),
                                'large',
                                [
                                    'class'    => $is_featured ? 'w-full h-full object-cover' : 'w-full h-56 object-cover',
                                    'loading'  => 'lazy',
                                    'itemprop' => 'image',
                                ]
                            );
                            ?>

                            <?php if ( $is_featured ) : ?>
                                <section class="grid grid-cols-1 lg:grid-cols-2 rounded-3xl overflow-hidden bg-base-100 shadow-sm">
                                    <div class="bg-base-200">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php if ( $thumbnail_html ) : ?>
                                                <?php echo str_replace( 'w-full h-full object-cover', 'w-full aspect-[1200/630] object-cover', $thumbnail_html ); ?>
                                            <?php else : ?>
                                                <img class="w-full aspect-[1200/630] object-cover" src="https://placehold.co/1200x630" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="p-6 lg:p-8 flex flex-col justify-center" itemscope itemtype="https://schema.org/Review">
                                        <span class="inline-flex w-fit rounded-full bg-info text-white px-3 py-1 text-xs font-semibold uppercase">
                                            Featured Review
                                        </span>
                                        <h2 class="text-2xl lg:text-4xl font-bold mt-4" itemprop="name">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <p class="mt-4 opacity-80 leading-relaxed" itemprop="reviewBody">
                                            <?php echo esc_html( wp_strip_all_tags( $summary ) ); ?>
                                        </p>
                                        <div class="mt-5 flex flex-wrap gap-2 text-sm">
                                            <?php if ( $rating > 0 ) : ?>
                                                <span class="rounded-full bg-warning px-4 py-2 text-black font-semibold">
                                                    คะแนน <?php echo esc_html( $rating ); ?>/5
                                                </span>
                                            <?php endif; ?>
                                            <?php if ( $rtp ) : ?>
                                                <span class="rounded-full bg-base-200 px-4 py-2">RTP <?php echo esc_html( $rtp ); ?>%</span>
                                            <?php endif; ?>
                                            <?php if ( $volatility ) : ?>
                                                <span class="rounded-full bg-base-200 px-4 py-2">Volatility <?php echo esc_html( $volatility ); ?></span>
                                            <?php endif; ?>
                                            <span class="rounded-full bg-base-200 px-4 py-2">
                                                อัปเดต <?php echo esc_html( get_the_modified_date( 'j M Y' ) ); ?>
                                            </span>
                                        </div>
                                        <?php if ( $rating > 0 ) : ?>
                                            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                                <meta itemprop="ratingValue" content="<?php echo esc_attr( $rating ); ?>">
                                                <meta itemprop="bestRating" content="5">
                                                <meta itemprop="worstRating" content="1">
                                            </div>
                                        <?php endif; ?>
                                        <div class="mt-6">
                                            <a class="btn btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                อ่านรีวิวนี้
                                            </a>
                                        </div>
                                    </div>
                                </section>
                                <?php $is_featured = false; ?>
                            <?php else : ?>
                                <article class="group rounded-3xl bg-base-100 shadow-sm overflow-hidden" itemscope itemtype="https://schema.org/Review">
                                    <div class="grid grid-cols-1 md:grid-cols-[280px,1fr]">
                                        <div class="bg-base-200">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php if ( $thumbnail_html ) : ?>
                                                    <?php echo str_replace( 'w-full h-56 object-cover', 'w-full aspect-[1200/630] object-cover', $thumbnail_html ); ?>
                                                <?php else : ?>
                                                    <img class="w-full aspect-[1200/630] object-cover" src="https://placehold.co/1200x630" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="p-5 lg:p-6">
                                            <div class="flex flex-wrap items-center gap-2 text-xs mb-3">
                                                <span class="rounded-full bg-base-200 px-3 py-1"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></span>
                                                <span class="rounded-full bg-base-200 px-3 py-1"><?php echo esc_html( get_the_modified_date( 'j M Y' ) ); ?></span>
                                                <?php if ( $rating > 0 ) : ?>
                                                    <span class="rounded-full bg-warning px-3 py-1 text-black font-semibold">
                                                        <?php echo esc_html( $rating ); ?>/5
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <h2 class="text-xl lg:text-2xl font-bold mb-3" itemprop="name">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <p class="opacity-75 leading-relaxed mb-4" itemprop="reviewBody">
                                                <?php echo esc_html( wp_strip_all_tags( $summary ) ); ?>
                                            </p>
                                            <div class="flex flex-wrap gap-2 text-sm mb-4">
                                                <?php if ( $rtp ) : ?>
                                                    <span class="rounded-full border border-base-300 px-3 py-1">RTP <?php echo esc_html( $rtp ); ?>%</span>
                                                <?php endif; ?>
                                                <?php if ( $volatility ) : ?>
                                                    <span class="rounded-full border border-base-300 px-3 py-1">Volatility <?php echo esc_html( $volatility ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ( $rating > 0 ) : ?>
                                                <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                                    <meta itemprop="ratingValue" content="<?php echo esc_attr( $rating ); ?>">
                                                    <meta itemprop="bestRating" content="5">
                                                    <meta itemprop="worstRating" content="1">
                                                </div>
                                            <?php endif; ?>
                                            <a class="inline-flex items-center font-semibold text-info group-hover:translate-x-1 transition-transform" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                อ่านต่อ
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </section>
                <?php else : ?>
                    <section class="rounded-3xl bg-base-100 p-8 text-center mb-10">
                        <h2 class="text-2xl font-bold mb-3">ยังไม่มีรีวิวในตอนนี้</h2>
                        <p class="opacity-70">เมื่อมีรีวิวใหม่ ระบบจะแสดงรายการในหน้านี้โดยอัตโนมัติ</p>
                    </section>
                <?php endif; ?>

                <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-10">
                    <div class="rounded-3xl bg-base-100 p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">แนวทางอ่านรีวิวให้ได้ประโยชน์</h2>
                        <p class="leading-relaxed opacity-80 mb-4">
                            หากต้องการเลือกอ่านรีวิวให้ตรงเป้าหมาย แนะนำให้เริ่มจากหัวข้อสรุปสั้น ภาพหน้าปก
                            และคะแนนรีวิวก่อน จากนั้นค่อยลงลึกไปยังค่าทางเทคนิคอย่าง RTP หรือ volatility
                            เพื่อดูว่าเกมนั้นเหมาะกับสไตล์การเล่นแบบไหน.
                        </p>
                        <ul class="space-y-2 text-sm opacity-80">
                            <li>ดูคะแนนรีวิวเพื่อคัด shortlist อย่างรวดเร็ว</li>
                            <li>อ่านคำอธิบายสั้นเพื่อดูว่าเนื้อหาเน้นเรื่องไหน</li>
                            <li>เช็กวันแก้ไขล่าสุดเมื่อต้องการข้อมูลที่ใหม่ขึ้น</li>
                            <li>เปิดอ่านหน้าที่เกี่ยวข้องเพื่อเปรียบเทียบหลายตัวเลือก</li>
                        </ul>
                    </div>
                    <div class="rounded-3xl bg-base-100 p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">เหตุผลที่หน้ารีวิวนี้ดีต่อ SEO</h2>
                        <p class="leading-relaxed opacity-80">
                            โครงสร้างหน้านี้ใช้ heading ชัดเจน, summary ที่สแกนง่าย, schema ประเภทรีวิว,
                            วันอัปเดตที่อ่านได้, internal links ไปยังหน้าที่เกี่ยวข้อง และ pagination สำหรับลิสต์จำนวนมาก
                            ซึ่งช่วยให้ทั้งผู้ใช้และ search engine เข้าใจเนื้อหาได้ดีขึ้น.
                        </p>
                    </div>
                </section>

                <?php if ( $games_query->have_posts() ) : ?>
                    <section class="mb-10">
                        <div class="flex items-center gap-3 mb-4">
                            <h2 class="shrink-0 text-2xl font-bold">เกมที่เกี่ยวข้อง</h2>
                            <span class="h-px flex-1 bg-gradient-to-r from-base-300 to-transparent"></span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                            <?php while ( $games_query->have_posts() ) : $games_query->the_post(); ?>
                                <article class="rounded-3xl bg-base-100 overflow-hidden shadow-sm">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $game_thumbnail = get_the_post_thumbnail(
                                            get_the_ID(),
                                            'medium_large',
                                            [
                                                'class'   => 'w-full h-44 object-cover',
                                                'loading' => 'lazy',
                                            ]
                                        );
                                        ?>
                                        <?php if ( $game_thumbnail ) : ?>
                                            <?php echo $game_thumbnail; ?>
                                        <?php else : ?>
                                            <img class="w-full h-44 object-cover" src="https://placehold.co/800x500" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                        <?php endif; ?>
                                    </a>
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </section>
                <?php endif; ?>

                <?php if ( $service_query->have_posts() ) : ?>
                    <section class="mb-10">
                        <div class="flex items-center gap-3 mb-4">
                            <h2 class="shrink-0 text-2xl font-bold">บริการและหน้าที่เกี่ยวข้อง</h2>
                            <span class="h-px flex-1 bg-gradient-to-r from-base-300 to-transparent"></span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
                            <?php while ( $service_query->have_posts() ) : $service_query->the_post(); ?>
                                <article class="rounded-3xl bg-base-100 p-4 text-center shadow-sm">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $page_image = get_post_meta( get_the_ID(), 'page_image', true );
                                        if ( $page_image ) {
                                            echo wp_get_attachment_image(
                                                $page_image,
                                                'medium',
                                                false,
                                                [
                                                    'class' => 'mx-auto object-cover rounded-2xl',
                                                    'alt'   => get_the_title(),
                                                    'title' => get_the_title(),
                                                ]
                                            );
                                        } else {
                                            ?>
                                            <img class="mx-auto object-cover rounded-2xl" src="https://placehold.co/400x400" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <h3 class="mt-3 font-semibold">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php echo esc_html( get_post_meta( get_the_ID(), 'page_title', true ) ?: get_the_title() ); ?>
                                        </a>
                                    </h3>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </section>
                <?php endif; ?>

                <?php Pagination::render(); ?>
            </article>
        </div>

        <?php get_template_part( 'template-parts/sidebar' ); ?>
    </div>
</div>

<?php get_footer(); ?>
