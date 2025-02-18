<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package simbiotica
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if (have_comments()) : ?>
    <div class="my-8 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow">
        <h2 class="text-xl font-bold">
            <?php comments_number('Нет комментариев', '1 комментарий', '% комментариев'); ?>
        </h2>

        <ul class="mt-4 space-y-4">
            <?php
            wp_list_comments([
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback'   => function ($comment, $args, $depth) { ?>
                    <li <?php comment_class('p-4 bg-white dark:bg-gray-700 mb-5 rounded-lg shadow-sm'); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="flex items-center space-x-4">
                            <?php echo get_avatar($comment, 50, '', '', ['class' => 'rounded-full']); ?>
                            <div>
                                <p class="font-semibold"><?php comment_author(); ?></p>
                                <p class="text-sm"><?php comment_date(); ?></p>
                            </div>
                        </div>
                        <div class="mt-2"><?php comment_text(); ?></div>
                        <?php comment_reply_link(['depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<div class="mt-2">', 'after' => '</div>', 'reply_text' => 'Ответить']); ?>
                    </li>
                <?php }
            ]); ?>
        </ul>
    </div>
<?php endif; ?>

<?php comment_form([
    'class_form' => 'max-w-3xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-lg shadow',
    'class_submit' => 'mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700',
    'comment_field' => '<textarea id="comment" name="comment" rows="4" class="w-full p-3 border rounded focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white" placeholder="Напишите комментарий..."></textarea>',
]); ?>

