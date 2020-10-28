<?php

namespace app\controllers;

use app\models\ShortUrls;
use app\models\ShortUrlsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage and create short url
     *
     *
     */
    public function actionIndex()
    {
        $model = new ShortUrls();
        $searchModel = new ShortUrlsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setAttribute('short_code', $model->genShortCode());
            if ($model->save()) {
                Yii::$app->session->setFlash(
                    'success',
                    'Создана сссылка ' . Html::a($model->getShortUrl(), $model->getShortUrl()) . ' !');
                return $this->redirect(['/']);
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    'Ошибка записи!');
            }
        }

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
