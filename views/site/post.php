<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
	<div class = 'container'>
	<?php if(Yii::$app->session->getFlash('uploadPost')): ?>
        <div class = 'alert alert-success' role = 'alert'>
            <?= Yii::$app->session->getFlash('uploadPost'); ?>
        </div>
    <?endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= Html::activeDropDownList($model, 'category',
      ArrayHelper::map($category, 'id', 'title')) ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength'=> true ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php \yii\web\View::registerJsFile('/web/ckeditor/ckeditor.js', ['position' => \yii\web\View::POS_HEAD, 'depends' => [app\assets\PublicAsset::className()]]) ?>
<script>
    $(document).ready(function() {
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor( editor );
    })
</script>
?>