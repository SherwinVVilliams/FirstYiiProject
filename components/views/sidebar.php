<?use yii\helpers\Url;
  use yii\helpers\Html; ?>
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?php foreach ($popular as $populars): ?>
                             <div class="popular-post">


                            <a href="<?= Url::to(['site/single', 'id' => $populars->id]) ?>" class="popular-img"><<img src="<?= $populars->getImage()?>" alt="">

                                <div class="p-overlay"></div>
                            </a>

                            <div class="p-content">
                                <a href="<?= Url::to(['site/single', 'id' => $populars->id]) ?>" class="text-uppercase"><?= $populars->title?></a>
                                <span class="p-date"><?= $populars->getDateFormate() ?></span>

                            </div>
                        </div>
                        <?php endforeach ?>
                       
                    </aside>
                    <aside class="widget pos-padding">
                     <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
                    <?php foreach($recent as $recents) : ?>


                        <div class="thumb-latest-posts">


                            <div class="media">
                                <div class="media-left">
                                    <a href="<?= Url::to(['site/single' , 'id' => $recents->id])?>" class="popular-img"><<img src="<?= $recents->getImage() ?>" alt="">

                                        <div class="p-overlay"></div>
                                    </a>
                                </div>
                                <div class="p-content">
                                    <a href="<?= Url::to(['site/single' , 'id' => $recents->id])?>" class="text-uppercase"><?= $recents->title ?></a>
                                    <span class="p-date"><?=$recents->getDateFormate()?></span>
                                </div>
                            </div>
                        </div>
                       <?php endforeach ?>
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                        <?php foreach($category as $categories) : ?> 
                            <li>
                                <a href="<?= Url::to(['site/category', 'id'=> $categories->id])?>"><?= $categories->title ?></a>
                                <span class="post-count pull-right"><?= $categories->getArticle()->count()?></span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </aside>