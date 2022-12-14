<?php
/** @var WP_Comment $comment */
$comment_id = $comment->comment_ID;
$comment_title = get_comment_meta($comment_id, 'title', true);
$comment_content = $comment->comment_content;
$comment_rating = intval(get_comment_meta($comment_id, 'rating', true));
$comment_author = $comment->comment_author;
$comment_date = get_comment_date('j.m.Y');
?>
<article class="review-item" id="comment-<?php echo $comment_id; ?>">
    <h3 class="review-item__title"><?php echo $comment_title; ?></h3>
    <p class="review-item__rate d-flex align-items-center" aria-label="Рейтинг"><?php print_rating( $comment_rating ); ?></p>
    <p class="review-item__text"><?php echo $comment_content; ?></p>
    <div class="review-item__wrapper d-flex justify-content-between">
        <p class="review-item__name">
            <?php echo $comment_author; ?>
        </p>
        <p class="review-item__date" aria-label="Дата написання відгуку">
            <?php echo $comment_date; ?>
        </p>
    </div>
</article>