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
//     * Lists all ShortUrls models.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new ShortUrlsSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

//    /**
//     * Displays a single ShortUrls model.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new ShortUrls model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShortUrls();

        if ($model->load(Yii::$app->request->post() && $model->validate())) {
            $model->setAttribute('short_code', $model->genShortCode());
            if ($model->save()){
                Yii::$app->session->setFlash(
                    'success',
                    'Создана сссылка '.Html::a($model->getShortUrl(), $model->getShortUrl()).' !') ;
            }else{
                Yii::$app->session->setFlash(
                    'danger',
                    'Ошибка записи!');
            }

            return $this->redirect(['/']);
        }
        return $this->redirect(['/']);

//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }


//    /**
//     * Updates an existing ShortUrls model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
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
                'Сгенерированная ссылка для '.Html::a($findModel->long_url, $findModel->long_url) . ',  удаленна!');
            $findModel->delete();
        } else {
            Yii::$app->session->setFlash('warning', 'Запись не найдена!');
        }

        return $this->redirect(['/']);
    }

//    /**
//     * Finds the ShortUrls model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return ShortUrls the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = ShortUrls::findOne($id)) !== null) {
//            return $model;
//        }
//
//        throw new NotFoundHttpException('The requested page does not exist.');
//    }

    /**
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
