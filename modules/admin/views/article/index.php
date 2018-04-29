<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            [
            'format' => 'html',
            'attribute' => 'content',
            'value' => function($data){
            $length = 500;
            if(strlen($data->content) > $length)
            {
                (int)$i = $length - 3;
                while(strlen($data->content) != $i)
                {
                    ++$i;
                    if($data->content[$i] == " ")
                    {
                        return substr($data->content, 0, $i)." ...";
                    }
                }
                return substr($data->content, 0, $length);
            }
            else{
                return $data->content;
            }
        }
            ],
            'date',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img($data->getImage(), ['width' => 100]);
                }
            ],//колбек функція в якій ми визиваємо наш метод вивода картінки 
            [
                'attribute' => 'status',
                'format' => 'html',
                'label' => 'status',
                'value' => function($data)
                {
                    if($data->status == 0)
                    {
                        return" <p><a class = 'btn btn-success' href = ".URl::to(['article/access', 'id' => $data->id]).">Allow</a></p>".
                        "<a class = 'btn btn-danger' href = ". URl::to(['article/delete', 'id' => $data->id]).">Delete</a>";
                    }
                    else
                    {
                        return "<p><a class = 'btn btn-warning' href = ".URl::to(['article/access', 'id' => $data->id]).">Disallow</a></p>".
                        "<a class = 'btn btn-danger' href = ". URl::to(['article/delete', 'id' => $data->id]).">Delete</a>";
                    }
                
                }
            ],
            //'image',
            //'viewed',
            //'user_id',
            //'status',
           'category_id',
            //'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
