<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(!empty($comment)): ?>
        <table class = 'table'>
        <thead>
            <tr>
                <th>id</th>
                <th>text</th>
                <th>user</th>
                <th>article</th>
                <th>date</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($comment as $comments): ?>
            <tr>
                <td><?=$comments->id ?></td>
                <td><?=$comments->text ?></td>
                <td><?=$comments->user->name ?></td>
                <td><?=$comments->article->title ?></td>
                <td><?=$comments->date ?></td>
                <td>
                <?php if($comments->status == 0): ?>
                <a class = 'btn btn-success' href = "<?= URl::to(['comment/access', 'id' => $comments->id]); ?>">Allow</a>
                <?php else: ?>
                <a class = 'btn btn-warning' href = "<?= URl::to(['comment/access', 'id' => $comments->id]); ?>">Disallow</a>
                <?endif?>
                <a class = 'btn btn-danger' href = "<?= URl::to(['comment/delete', 'id' => $comments->id]); ?>">Delete</a>
                </td>
            <tr>
        <?php endforeach ?>
        </tbody>
        </table>
    <?php endif;?>
   
</div>
