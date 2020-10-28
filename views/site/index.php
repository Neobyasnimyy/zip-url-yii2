<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ShortUrls */
/* @var $form yii\widgets\ActiveForm */
/* @var $searchModel app\models\ShortUrlsSearch */
/* @var $dataProvider app\models\ShortUrlsSearch */

$this->title = 'Короткие ссылки';
?>

<?= $this->render('..\url\_form', [
    'model' => $model,
]) ?>

<?=
$this->render('..\url\index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]) ?>


