<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShortUrls */

$this->title = 'Create Short Urls';
$this->params['breadcrumbs'][] = ['label' => 'Short Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="short-urls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
