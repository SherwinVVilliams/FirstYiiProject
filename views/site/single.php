<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\components\SidebarWidget;
use app\components\CommentsWidget;
 ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="#"><<img  src="<?= $article->getImage() ?>" alt="" ></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::to(['site/category', 'id' => $article->category->id ] )?>"><?= $article->category->title ?></a></h6>

                            <h1 class="entry-title"><?= $article->title ?></h1>


                        </header>
                        <div class="entry-content">
                            <?= nl2br($article->content)  ?>
                        </div>
                        <br>
                        <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">By <a href="#"><?= app\models\User::returnUserName($article->user_id) ?></a>  on <?= $article->getDateFormate() ?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int)$article->viewed?>
                            </ul>
                        </div>
                    </div>
                </article>
               <!-- <div class="top-comment">top comment
                    <<img src="/web/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><top comment end
                <div class="row">blog next previous
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <<img src="/web/public/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <<img src="/web/public/images/blog-next.jpg" alt="">

                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>blog next previous end
                <div class="related-post-carousel">related post carousel
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-1.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-2.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-3.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-1.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>

                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-2.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>


                        <div class="single-item">
                            <a href="#">
                                <<img src="/web/public/images/related-post-3.jpg" alt="">

                                <p>Just Wondering at Beach</p>
                            </a>
                        </div>
                    </div>
                </div>related post carousel
                 end bottom comment-->
                <?=CommentsWidget::widget(['comment' => $comment , 'commentsPagination' => $commentsPagination, 'article_id' => $article->id]);?>
                 <?php if(!$user_is_Guest): ?>
                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>
                    <?php if(Yii::$app->session->getFlash('comment')): ?>
                        <div class = 'alert alert-success' role = 'alert'>
                            <?= Yii::$app->session->getFlash('comment'); ?>
                        </div>
                    <?endif; ?>
                <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => ['site/comment', 'id'=> $article->id],
                'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form' ]
                ]) ?>
                     <div class="form-group">

                        <div class="col-md-12">

               <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Ваш коментарий', 'style' => "margin-left:10px;
               width:90%", ])->label(false);?>
                        </div>
                    </div>
                        <button type="submit" class="btn send-btn">Post Comment</button>
                <?php \yii\widgets\ActiveForm::end() ?>
                </div><!--end leave comment-->
                <?php endif;?>
               
            </div>
          <div class="col-md-4">
                <div class="primary-sidebar">
                <?= SidebarWidget::widget(['popular' => $popular, 'recent' => $recent, 'category' => $category])?>
                </div>
            </div>
        </div>
    </div>
</div>