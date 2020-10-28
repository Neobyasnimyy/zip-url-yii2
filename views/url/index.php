<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShortUrlsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="short-urls-index">

    <h4>Последнии публичные ссылки</h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => "{items}",
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false,
                'contentOptions' => [
                    'style' => 'width:30px;'
                ]
            ],
            [
                'attribute' => 'long_url',
                'label' => 'ОРИГИНАЛЬНЫЙ УРЛ',
                'content'=>function($data){
                    return Html::a($data->long_url, $data->long_url);
                }
            ],
            'time_create',
            'counter',
            [
                'attribute' => 'short_code',
                'label' => 'КОРОТКАЯ ССЫЛКА',
                'content'=>function($data){
                    return Html::a($data->getShortUrl(), $data->getShortUrl());
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' =>
                    [
                        'update'=>function($url,$model,$key)
                        {
                            return Html::a( "Edit" , Url::toRoute(['/question/update', 'id' => $model->id]) ,['class' => 'btn btn-md btn-success','data-pjax'=>0,]); //use Url::to() in order to change $url
                        },
                        'delete'=>function($url,$model,$key)
                        {
                            return Html::a( '<span class="glyphicon glyphicon-trash"></span>' , Url::toRoute(['/url/delete', 'id' => $model->id]), [
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this Questionvv?',
                                    'method' => 'post',
                                ],
                                'data-pjax'=>0,
                            ] );
                        }
                    ],
//                'urlCreator' => function ($action, $model, $key, $index) {
//                    return Url::to(['url/'.$action, 'id' => $model->id]);
//                }
            ],
        ],
    ]); ?>


</div>
