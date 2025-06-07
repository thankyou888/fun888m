<?php
/**
 * Comments template.
 *
 * @package TailPress
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="my-10">
    <?php if (have_comments()) : ?>
        <h2 class="text-2xl font-semibold mb-4">
            <?php echo get_comments_number() . ' Comments'; ?>
        </h2>

        <ul class="space-y-6">
            <?php
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size'=> 40,
                'callback'   => function ($comment, $args, $depth) {
                    $GLOBALS['comment'] = $comment;
                    ?>
                    <li <?php comment_class('border-b pb-4'); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="flex items-start gap-4">
                            <?php echo get_avatar($comment, 40, '', '', ['class' => 'rounded-full']); ?>
                            <div>
                                <div class="font-semibold"><?php comment_author(); ?></div>
                                <div class="text-sm text-gray-500"><?php comment_date(); ?></div>
                                <div class="mt-2"><?php comment_text(); ?></div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            ));
            ?>
        </ul>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_submit' => 'bg-primary text-white px-4 py-2 rounded hover:bg-blue-700 transition',
        'comment_field' => '<textarea id="comment" name="comment" rows="4" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>',
        'class_form' => 'mt-8 space-y-4',
        'title_reply' => '<span class="text-xl font-semibold">Leave a Comment</span>',
    ));
    ?>
</div>

