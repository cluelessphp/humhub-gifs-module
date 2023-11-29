<?php

/* @var $this View */

use yii\helpers\Url;
use humhub\modules\ui\view\components\View;

?>

<?php if (!Yii::$app->user->isGuest): ?>
    <span class="gifLinkContainer" id="gifLinkContainer_<?= $id ?>">
        <a href="<?= Url::to(['/gifs/share', 'id' => $id]); ?>" data-target="#globalModal" class="showComments">GIFs </a>
    </span>
<?php endif; ?>

<script <?= \humhub\libs\Html::nonce() ?>>
$(document).on("click",'.showComments',function(e) {
	console.log('got here');
    e.preventDefault();
    /* currentCommentContainer is a global */
    //currentCommentContainer = $(this).closest('.media').find('.comment-container').slideDown();	
    currentCommentContainer = $(this).closest('.wall-entry-body').find('.comment-container').slideDown();
});
</script>
