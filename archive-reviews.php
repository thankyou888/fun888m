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
$faq_question  = 'รีวิวเหล่านี้เชื่อถือได้แค่ไหน?';
$faq_answer    = 'รีวิวของเรามาจากประสบการณ์การใช้งานจริงของทีมงานและ Feedback จากผู้เล่นในปี 2026 โดยเน้นข้อมูลที่เป็นกลางและอัปเดตตามสถานการณ์ปัจจุบันที่สุด';
$faq_question2  = 'มีการเปรียบเทียบแต่ละเกมให้ดูไหม?';
$faq_answer2    = 'มีครับ ในหน้ารีวิวเชิงลึกเราจะมี Matrix Table เปรียบเทียบจุดเด่น-จุดด้อย ของแต่ละเกม/บริการ เพื่อให้คุณตัดสินใจได้ง่ายขึ้น';

$faq_schema    = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [
        [
            '@type'          => 'Question',
            'name'           => $faq_question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq_answer,
            ],
        ],
        [
            '@type'          => 'Question',
            'name'           => $faq_question2,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq_answer2,
            ],
        ],
    ],
];
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

<div class="container my-8 mx-auto">
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
                              
                            </div>
                        </div>
                    </div>
                </header>

               

                <?php if ( have_posts() ) : ?>
                    <?php $is_featured = true; ?>
                    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
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
                                <section class="grid grid-cols-1 lg:grid-cols-2 rounded-3xl overflow-hidden bg-base-100 shadow-sm md:col-span-2 lg:col-span-3">
                                    <div class="bg-base-200">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php if ( $thumbnail_html ) : ?>
                                                <?php echo str_replace( 'w-full h-full object-cover', 'w-full aspect-[1200/630] object-cover', $thumbnail_html ); ?>
                                            <?php else : ?>
                                                <img class="w-full aspect-[1200/630] object-cover" src="https://placehold.co/1200x630" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php endif; ?>
                                        </a>
                                        <div class="entry-meta flex mt-4 gap-2 justify-center">
                                            <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                                            <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                                        </div>
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
                                        </div>
                                        <?php if ( $rating > 0 ) : ?>
                                            <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                                <meta itemprop="ratingValue" content="<?php echo esc_attr( $rating ); ?>">
                                                <meta itemprop="bestRating" content="5">
                                                <meta itemprop="worstRating" content="1">
                                            </div>
                                        <?php endif; ?>
                                        <div class="mt-6">
                                            <a class="btn btn-accent" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                อ่านรีวิวนี้
                                            </a>
                                        </div>
                                    </div>
                                </section>
                                <?php $is_featured = false; ?>
                            <?php else : ?>
                                <article class="group rounded-[8px] bg-base-100 shadow-sm overflow-hidden" itemscope itemtype="https://schema.org/Review">
                                    <div class="grid grid-cols-1">
                                        <div class="bg-base-200">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php if ( $thumbnail_html ) : ?>
                                                    <?php echo str_replace( 'w-full h-56 object-cover', 'w-full aspect-[1200/630] object-cover', $thumbnail_html ); ?>
                                                <?php else : ?>
                                                    <img class="w-full aspect-[1200/630] object-cover" src="https://placehold.co/1200x630" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                         <div class="entry-meta flex mb-4 gap-2">
                                            <span class="text-xs bg-info text-white px-2 py-2.5 hidden"><?php _e('Published') ?> : <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('j M Y'); ?></time></span>
                                            <span class="text-xs bg-info text-white px-2 py-2.5"><?php _e('Modified') ?> : <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date('j M Y'); ?></time></span>
                                        </div>
                                        <div class="p-5 lg:p-6">
                                           
                                            <div class="flex flex-wrap items-center gap-2 text-xs mb-3">
                                                
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
                                           <a class="btn btn-accent" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                อ่านรีวิวนี้
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </section>

                    <?php Pagination::renderModern(); ?>

                    <section class="mb-10 rounded-3xl bg-base-100 p-6 shadow-sm" itemscope itemtype="https://schema.org/FAQPage">
                        <div class="flex items-center gap-3 mb-5">
                            <h2 class="shrink-0 text-2xl font-bold">FAQ</h2>
                            <span class="h-px flex-1 bg-gradient-to-r from-base-300 to-transparent"></span>
                        </div>

                        <details class="group collapse collapse-plus rounded-2xl border border-base-300 bg-base-200" open itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <summary class="collapse-title flex items-center justify-between gap-4 text-lg font-semibold" itemprop="name">
                                <span><?php echo esc_html( $faq_question ); ?></span>
                            </summary>
                            <div class="collapse-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <div class="pt-0 text-sm leading-relaxed opacity-80" itemprop="text">
                                    <?php echo esc_html( $faq_answer ); ?>
                                </div>
                            </div>
                        </details>
                        <details class="group collapse collapse-plus rounded-2xl border border-base-300 bg-base-200 mt-4" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                            <summary class="collapse-title flex items-center justify-between gap-4 text-lg font-semibold" itemprop="name">
                                <span><?php echo esc_html( $faq_question2 ); ?></span>
                            </summary>
                            <div class="collapse-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                <div class="pt-0 text-sm leading-relaxed opacity-80" itemprop="text">
                                    <?php echo esc_html( $faq_answer2 ); ?>
                                </div>
                            </div>
                        </details>

                        <script type="application/ld+json">
                            <?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
                        </script>
                    </section>

                <?php else : ?>
                    <section class="rounded-3xl bg-base-100 p-8 text-center mb-10">
                        <h2 class="text-2xl font-bold mb-3">ยังไม่มีรีวิวในตอนนี้</h2>
                        <p class="opacity-70">เมื่อมีรีวิวใหม่ ระบบจะแสดงรายการในหน้านี้โดยอัตโนมัติ</p>
                    </section>
                <?php endif; ?>

                <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-10">
                    <div class="rounded-3xl bg-base-100 p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">เกณฑ์การคัดเลือกเกม</h2>
                        <p class="leading-relaxed opacity-80 mb-4">
                            เรารวบรวมเฉพาะเกมที่มีค่า RTP สูงและได้รับการรับรองมาตรฐานสากล เพื่อความโปร่งใสในทุกการเดิมพัน
                        </p>
                        <ul class="space-y-2 text-sm opacity-80">
                            <li>💡ตรวจสอบโปรโมชั่นที่เหมาะกับประเภทเกมที่เลือก</li>
                            <li>💡ศึกษาเงื่อนไขการทำเทิร์นโอเวอร์ในแต่ละรีวิวเพื่อประโยชน์สูงสุด</li>
                            <li>💡ระบบรองรับการใช้งานผ่าน Browser โดยไม่ต้องโหลดแอป</li>
                        </ul>
                    </div>
                    <div class="rounded-3xl bg-base-100 p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-4">ข้อมูลสำคัญประกอบการตัดสินใจ</h2>
                        <p class="leading-relaxed opacity-80">
                            โข้อมูลสำคัญประกอบการตัดสินใจ:
เราให้ข้อมูลแบบตรงไปตรงมา ทั้งข้อดีและข้อที่ควรระวัง เพื่อให้คุณวางแผนการเล่นได้อย่างมั่นใจและมีประสิทธิภาพ
                        </p>
                        <ul class="space-y-2 text-sm opacity-80">
                            <li>💡อัปเดตรีวิวเกมใหม่ล่าสุดรายสัปดาห์</li>
                        </ul>
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
                                <article class="rounded-xl bg-base-100 overflow-hidden shadow-sm">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $game_thumbnail = get_the_post_thumbnail(
                                            get_the_ID(),
                                            'medium_large',
                                            [
                                                'class'   => 'w-full h-44 object-left-top object-cover',
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
                                <article class="rounded-xl bg-base-100 p-4 text-center shadow-sm">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php
                                        $page_image = get_post_meta( get_the_ID(), 'page_image', true );
                                        if ( $page_image ) {
                                            echo wp_get_attachment_image(
                                                $page_image,
                                                'medium',
                                                false,
                                                [
                                                    'class' => 'mx-auto object-cover rounded-xl',
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

            </article>
        </div>

        <?php get_template_part( 'template-parts/sidebar' ); ?>
    </div>
</div>

<?php get_footer(); ?>
