   <?php 
   use yii\helpers\Html;
   use yii\widgets\LinkPager;
   ?>
   <?php  if(!empty($comment)): ?>
        <?php foreach($comment as $comments): ?>
            <?php if(($comments->status == 1) ) : ?>
                <div class="bottom-comment" style = "margin: 15px 0"><!--bottom comment-->

                    <div class="comment-img" style = "padding: 10px 15px 25px">
                          <div class = 'image-circle'>
                            <?= Html::img($comments->user->getImage(),[ 'class' => 'img-circle' ,  'width' => '55' ]) ?>
                            </div>
                    </div>

                    <div class="comment-text">
                        <a href="#" class="replay btn pull-right"> Replay</a>
                        <h5><?= $comments->user->name; ?></h5>

                        <p class="comment-date">
                               <?= $comments->getDateFormate(); ?>
                        </p>

                        <p class="para"><?= nl2br($comments->text); ?></p>
                    </div>
                </div>
            <? endif;?>
        <?php endforeach; ?> 

    <? endif;?>
    <?= LinkPager::widget(['pagination' => $commentsPagination]) ?>
