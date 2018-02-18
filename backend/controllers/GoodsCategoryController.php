<?php

namespace backend\controllers;

use Yii;
use common\models\GoodsCategory;
use backend\models\GoodsCategorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Heart;
use yii\web\UploadedFile;

/**
 * GoodsCategoryController implements the CRUD actions for GoodsCategory model.
 */
class GoodsCategoryController extends Controller
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
     * Lists all GoodsCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoodsCategory model.
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
     * Creates a new GoodsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsCategory();

        if ($model->load(Yii::$app->request->post())) {
            $image_new = UploadedFile::getInstance($model, 'image_new');
            if ($model->save() and $image_new) {
                $filename = $image_new->baseName . '.' . $image_new->extension;
                $path = Heart::getUploadPath('goods-categories/'.$model->id.'/');
                $upload = $image_new->saveAs($path . $filename);
                if($upload) $model->image = $filename;
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Create successful');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GoodsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image_new = UploadedFile::getInstance($model, 'image_new');
            if ($image_new) {
                $filename = $image_new->baseName . '.' . $image_new->extension;
                $path = Heart::getUploadPath('goods-categories/'.$id.'/');
                $upload = $image_new->saveAs($path . $filename);
                if($upload) {
                    @unlink($path . $model->image);
                    $model->image = $filename;
                }    
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'Update successful');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GoodsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->image;
        if($model->delete()){
            $path = Heart::getUploadPath('goods-categories/'.$id.'/');
            @unlink($path . $filename);
            Yii::$app->session->setFlash('success', 'Delete successful');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the GoodsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionList($q = null, $id = null) 
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if ($id > 0) {
            $cat = GoodsCategory::findOne($id);
            if($cat) $out['results'] = ['id' => $id, 'text' => $cat->name];
        }
        else {
            $data = GoodsCategory::find()
                ->select(['id', 'text'=>'name'])
                ->filterWhere(['like', 'name', $q])
                ->limit(20)
                ->asArray()
                ->all();
            $out['results'] = array_values($data);
        }
        return $out;
    }
    
}
