<?php 
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\SidebarWidget;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="post post-list">
                  <?php foreach ($article as $articles) : ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?= Url::to(['site/single', 'id' => $articles->id]) ?>"><<?= Html::img( $articles->getImage(), ['class' => 'pull-left' , 'height' => 'inherit', ]) ?></a>

                                <a href="<?= Url::to(['site/single', 'id' => $articles->id]) ?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                  
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="<?=Url::to(['site/category' , 'id' => $articles->category->id ]) ?>"><?= $articles->category->title ?></a></h6>

                                    <h1 class="entry-title"><a href="<?= Url::to(['site/single', 'id' => $articles->id]) ?>"><?= $articles->title ?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <?= $articles->lengthDescription();?>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">By <?= app\models\User::returnUserName($articles->user_id) ?>   on  <?= $articles->getDateFormate() ?></span>
                                </div>
                            </div>
                        </div>   
                    </div>
                     <?php endforeach; ?>
                </article>
               <?php echo LinkPager::widget([
                'pagination' => $pagination,
                ]) ?>
            </div>
            <div class="col-md-4" >
                <div class="primary-sidebar">
                    
                  <?= SidebarWidget::widget(['popular' => $popular, 'recent' => $recent, 'category' => $categoryBar])?>
                   <!-- <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Follow@Instagram</h3>

                        <div class="instragram-follow">
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>
                            <a href="#">
                                <<img src="/web/public/images/ins-flow.jpg" alt="">
                            </a>

                        </div>

                    </aside>-->
                </div>
            </div>
        </div>
    </div>
</div>