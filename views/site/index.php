<?php 
use yii\widgets\LinkPager;//віджет для пагінації 
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\SidebarWidget;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <? foreach ($article as $articles): ?>
                <article class="post">
                    <div class="post-thumb">
                        <a href="<?= Url::toRoute(['site/single', 'id' => $articles->id]) ?>"><<img  src="<?= $articles->getImage(); ?>" alt=""></a>

                        <a href="<?= Url::to(['site/single', 'id' => $articles->id]) ?>" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">View Post</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::to(['site/category' , 'id' => $articles->category->id]) ?>"><?= $articles->category->title?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::to(['site/single' , 'id' => $articles->id]) ?>"><?=$articles->title?></a></h1>


                        </header>
                        <div class="entry-content">
                            <p><?= nl2br($articles->description); ?>
                            </p>

                            <div class="btn-continue-reading text-center text-uppercase">
                                <a href="<?= Url::to(['site/single' , 'id' => $articles->id]) ?>" class="more-link">Continue Reading</a>
                            </div>
                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">By <?= app\models\User::returnUserName($articles->user_id) ?>  on  <?= $articles->getDateFormate() ?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int)$articles->viewed?>
                            </ul>
                        </div>
                    </div>
                </article>
            <? endforeach; ?>
            <?php 
            echo LinkPager::widget([
                'pagination' => $pagination,
                ])
            ?>
            </div>
            <div class="col-md-4" >
                <div class="primary-sidebar">
                    
                    <?= SidebarWidget::widget(['popular' => $popular, 'recent' => $recent, 'category' => $category])?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
<!--footer start-->