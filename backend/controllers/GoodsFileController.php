<?php

namespace backend\controllers;

use Yii;
use common\models\Goods;
use common\models\GoodsFile;
use backend\models\GoodsFileSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Heart;
use yii\web\UploadedFile;

/**
 * GoodsFileController implements the CRUD actions for GoodsFile model.
 */
class GoodsFileController extends Controller
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
     * Lists all GoodsFile models.
     * @return mixed
     */
    public function actionIndex(int $goods_id)
    {
        $goods = Goods::findOne($goods_id);
        $searchModel = new GoodsFileSearch([
            'goods_id' => $goods_id,
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'goods' => $goods,
        ]);
    }

    /**
     * Displays a single GoodsFile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GoodsFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(int $goods_id)
    {
        $model = new GoodsFile([
            'goods_id' => $goods_id,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $file_new = UploadedFile::getInstance($model, 'file_new');
            if ($file_new) {
                $safe_filename = \Yii::$app->security->generateRandomString();                
                $filename = $safe_filename . '.' . $file_new->extension;
                $path = Heart::getUploadPath('goods-file/'.$goods_id.'/');
                $upload = $file_new->saveAs($path . $filename);
                if($upload) {
                    $model->file = $filename;
                    $model->size = $file_new->size;
                    if(in_array($file_new->extension,['jpg','jpeg','png'])){
                        $model->type = 0;
                    }
                    if(in_array($file_new->extension,['pdf'])){
                        $model->type = 1;
                    }
                    if(in_array($file_new->extension,['mp4'])){
                        $model->type = 2;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GoodsFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file_new = UploadedFile::getInstance($model, 'file_new');
            if ($file_new) {
                $safe_filename = \Yii::$app->security->generateRandomString();                
                $filename = $safe_filename . '.' . $file_new->extension;
                $path = Heart::getUploadPath('goods-file/'.$model->goods_id.'/');
                $upload = $file_new->saveAs($path . $filename);
                if($upload) {
                    @unlink($path . $model->file);
                    $model->file = $filename;
                    $model->size = $file_new->size;
                    if(in_array($file_new->extension,['jpg','jpeg','png'])){
                        $model->type = 0;
                    }
                    if(in_array($file_new->extension,['pdf'])){
                        $model->type = 1;
                    }
                    if(in_array($file_new->extension,['mp4'])){
                        $model->type = 2;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GoodsFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GoodsFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsFile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
