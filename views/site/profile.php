<?php use yii\helpers\Url;
use yii\helpers\Html;
use app\components\SidebarWidget;
use app\components\CommentsWidget;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            
             <aside class="widget border pos-padding">
            <div class="col-lg-6 col-lg-offset-3 text-center">
            <img src = "<?= $user->getImage() ?>" >
             <h5>Ваше Фото</h5>
            </div>
             <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($imageUpload, 'image')->fileInput(['maxlength'=> true ])->label(false); ?>

              <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
              </div>
             <?php ActiveForm::end(); ?>
   			      </aside>
            <articles class = 'post'>
              <aside class = 'widget border pos-padding'>
                <ul>   <h3 class="widget-title text-uppercase text-center">Ваши статьи</h3>
                        <?php foreach($article as $articles) : ?> 
                            <li>
                                <a href="<?= Url::to(['site/single', 'id'=> $articles->id])?>"><?=$articles->title?></a>
                                <span class="post-count pull-right"><?= $articles->category->title ?>  | <?= $articles->date ?>  <a class="btn btn-danger btn-xs" href = "<?= URl::to(['site/delete', 'id' => $articles->id]); ?>">Удалить</a></span>

                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <br>
                         <p><a class="btn btn-success btn-lg" href = "<?= URl::to(['site/post']); ?>">Создать</a></p>
                        
              </aside>

              <aside class = 'widget border pos-padding'>
              <h3 class="widget-title text-uppercase text-center">Ваши коментарии</h3>
               <?php  if(!empty($comment)): ?>
                  <?php foreach($comment as $comments): ?>
                    <?php if(($comments->status == 1) ) : ?>
                      <div class="bottom-comment" style = "margin: 15px 0"><!--bottom comment-->

                        <div class="comment-img" style = "padding: 10px 15px 25px">
                          <div class = 'img-me'>
                            <?= Html::img($comments->user->getImage(),[ 'width' => '50' , 'class' => 'img-circle' ]) ?>
                            </div>
                        </div>

                        <div class="comment-text">
                        <a href="<?= Url::toRoute(['site/single' , 'id' => $comments->article->id]) ?>" class="replay btn pull-right"><?= $comments->article->title ?></a>
                        <a href = "<?= Url::toRoute(['site/comment-delete' , 'id' => $comments->id]) ?>" class = "btn btn-danger pull-right">Удалить</a>
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
              </aside>
   			   </articles>
   			    </div>

			<div class="col-md-4">
    			<div class="primary-sidebar">
        			<?= SidebarWidget::widget(['popular' => $popular, 'recent' => $recent, 'category' => $category])?>
    			</div>
			</div>
		</div>
	</div>
</div>
