<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShortUrls */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="short-urls-form text-center ">

    <?php $form = ActiveForm::begin(['action' => '/', 'method' => 'post']); ?>

    <?= $form->field($model, 'long_url')
        ->textInput(['placeholder' => 'http:://yousite.com', 'maxlength' => true])
        ->label('Вставьте свою длинную ссылку') ?>

  <div class="form-group ">
      <?= Html::submitButton('Получить короткую ссылку', ['class' => 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>

