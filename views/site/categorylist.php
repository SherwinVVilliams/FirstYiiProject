<?php use yii\helpers\Url;
use yii\helpers\Html;
use app\components\SidebarWidget;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <category class="post">
             <aside class="widget border pos-padding">
                <h3 class="widget-title text-uppercase text-center">Categories</h3>
   				<ul>
        		<?php foreach($category as $categories) : ?> 
        			<li>
            			<a href="<?= Url::to(['site/category', 'id'=> $categories->id])?>"><?=$categories->title?></a>
            			<span class="post-count pull-right"><?= $categories->getArticle()->count()?></span>
            		</li>
        		<?php endforeach; ?>
   				</ul>
   			</aside>
   			</category>
   			</div>

			<div class="col-md-4">
    			<div class="primary-sidebar">
        			<?= SidebarWidget::widget(['popular' => $popular, 'recent' => $recent, 'category' => $category])?>
    			</div>
			</div>
		</div>
	</div>
</div>
