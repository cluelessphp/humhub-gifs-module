<?php
/* @var $this humhub\components\View */

use yii\helpers\Url;
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <span class="gifLinkContainer" id="gifLinkContainer_<?= $id ?>">
        <a href="<?=Url::to(['/gifs/share', 'id' => $id]); ?>" data-target="#globalModal" class="showComments">
            GIFS
        </a>
    </span>
<?php endif; ?>
<script>
$(document).on("click",'.showComments',function(e) {
	console.log('got here');
    e.preventDefault();
    /* currentCommentContainer is a global */
    currentCommentContainer = $(this).closest('.media').find('.comment-container').slideDown();	
});
</script>

