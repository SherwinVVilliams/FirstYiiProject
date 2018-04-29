<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('tags', $selectedTags, $tagList, ['class' => 'form-control', 'multiple' => true]);
    //selectCategory - вибране значення 
    //categories - массив зі значеннями який служить елементами комбобокса
    ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Set Tag', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
