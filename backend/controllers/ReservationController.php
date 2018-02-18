<?php

namespace backend\controllers;

use Yii;
use common\models\Reservation;
use common\models\CustomerShipment;
use backend\models\ReservationSearch;
use common\models\ReservationDetail;
use backend\models\ReservationDetailSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Heart;
use yii\web\UploadedFile;

/**
 * ReservationController implements the CRUD actions for Reservation model.
 */
class ReservationController extends Controller
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
     * Lists all Reservation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->start = Heart::dateTimeFormat($model->start,'Y-m-d H:i:s','d F Y');
        $model->end = Heart::dateTimeFormat($model->end,'Y-m-d H:i:s','d F Y');
        $file_ext = '-';
        if(strlen($model->payment_proof)>4){
            $file_ext = pathinfo($model->payment_proof, PATHINFO_EXTENSION); 
        }

        $searchModel = new ReservationDetailSearch([
            'reservation_id' => $id,
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'file_ext' => $file_ext,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Reservation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reservation();

        if ($model->load(Yii::$app->request->post())) {
            $model->start = Heart::dateTimeFormat($model->start,'d F Y','Y-m-d H:i:s');
            $model->end = Heart::dateTimeFormat($model->end,'d F Y','Y-m-d H:i:s');
            $model->save();
            $payment_proof_new = UploadedFile::getInstance($model, 'payment_proof_new');
            if ($payment_proof_new) {
                $safe_filename = \Yii::$app->security->generateRandomString();                
                $filename = $safe_filename . '.' . $payment_proof_new->extension;
                $path = Heart::getUploadPath('reservation/'.$model->id.'/');
                $upload = $payment_proof_new->saveAs($path . $filename);
                if($upload) {
                    $model->payment_proof = $filename;
                }
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Create successful');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->start = (new \DateTime())->format('d F Y');
        $model->end = (new \DateTime())->modify('+1 day')->format('d F Y');
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reservation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->start = Heart::dateTimeFormat($model->start,'d F Y','Y-m-d H:i:s');
            $model->end = Heart::dateTimeFormat($model->end,'d F Y','Y-m-d H:i:s');
            $payment_proof_new = UploadedFile::getInstance($model, 'payment_proof_new');
            if ($payment_proof_new) {
                $safe_filename = \Yii::$app->security->generateRandomString();                
                $filename = $safe_filename . '.' . $payment_proof_new->extension;
                $path = Heart::getUploadPath('reservation/'.$id.'/');
                $upload = $payment_proof_new->saveAs($path . $filename);
                if($upload) {
                    @unlink($path . $model->payment_proof);
                    $model->payment_proof = $filename;
                }
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Update successful');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->start = Heart::dateTimeFormat($model->start,'Y-m-d H:i:s','d F Y');
        $model->end = Heart::dateTimeFormat($model->end,'Y-m-d H:i:s','d F Y');
        $file_ext = '-';
        if(strlen($model->payment_proof)>4){
            $file_ext = pathinfo($model->payment_proof, PATHINFO_EXTENSION); 
        }      
        return $this->render('update', [
            'model' => $model,
            'file_ext' => $file_ext,
        ]);
    }

    /**
     * Deletes an existing Reservation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Delete successful');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reservation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionSetDetailStatus(int $reservation_id, int $goods_id, int $status)
    {
        $rd = ReservationDetail::find()->where([
            'reservation_id'=>$reservation_id,
            'goods_id'=>$goods_id,
        ])->one();
        if($rd){
            $rd->status = $status;
            $rd->save();
            Yii::$app->session->setFlash('success', 'Update status successful');
            //die(print_r($rd->errors));
        }
        return $this->redirect(['view', 'id' => $reservation_id]);
    }
}
