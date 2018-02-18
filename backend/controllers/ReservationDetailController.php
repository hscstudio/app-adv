<?php

namespace backend\controllers;

use Yii;
use common\models\ReservationDetail;
use backend\models\ReservationDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservationDetailController implements the CRUD actions for ReservationDetail model.
 */
class ReservationDetailController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * Lists all ReservationDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservationDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReservationDetail model.
     * @param integer $reservation_id
     * @param integer $goods_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($reservation_id, $goods_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($reservation_id, $goods_id),
        ]);
    }

    /**
     * Creates a new ReservationDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReservationDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'reservation_id' => $model->reservation_id, 'goods_id' => $model->goods_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReservationDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $reservation_id
     * @param integer $goods_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($reservation_id, $goods_id)
    {
        $model = $this->findModel($reservation_id, $goods_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'reservation_id' => $model->reservation_id, 'goods_id' => $model->goods_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReservationDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $reservation_id
     * @param integer $goods_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($reservation_id, $goods_id)
    {
        $this->findModel($reservation_id, $goods_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReservationDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $reservation_id
     * @param integer $goods_id
     * @return ReservationDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($reservation_id, $goods_id)
    {
        if (($model = ReservationDetail::findOne(['reservation_id' => $reservation_id, 'goods_id' => $goods_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
