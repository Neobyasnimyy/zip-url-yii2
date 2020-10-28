<?php

namespace app\controllers;

use Yii;
use app\models\ShortUrls;
use app\models\ShortUrlsSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UrlController implements the CRUD actions for ShortUrls model.
 */
class UrlController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


//    /**
//     * Creates a new ShortUrls model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new ShortUrls();
//
//        if ($model->load(Yii::$app->request->post() && $model->validate())) {
//            $model->setAttribute('short_code', $model->genShortCode());
//            if ($model->save()) {
//                Yii::$app->session->setFlash(
//                    'success',
//                    'Создана сссылка ' . Html::a($model->getShortUrl(), $model->getShortUrl()) . ' !');
//            } else {
//                Yii::$app->session->setFlash(
//                    'danger',
//                    'Ошибка записи!');
//            }
//
//            return $this->redirect(['/']);
//        }
//        return $this->redirect(['/']);
//    }


    /**
     * Deletes an existing ShortUrls model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $findModel = ShortUrls::findOne($id) ?? null;
        if ($findModel) {
            Yii::$app->session->setFlash(
                'success',
                'Сгенерированная ссылка для ' . Html::a($findModel->long_url, $findModel->long_url) . ',  удаленна!');
            $findModel->delete();
        } else {
            Yii::$app->session->setFlash('warning', 'Запись не найдена!');
        }

        return $this->redirect(['/']);
    }


    /**
     * save counter in short url and redirect to long url
     *
     * @param $code
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionRedirect($code)
    {
        $model_url = ShortUrls::validateShortCode($code);
        $model_url->updateCounters(['counter' => 1]);;
        return $this->redirect($model_url->long_url);
    }
}
