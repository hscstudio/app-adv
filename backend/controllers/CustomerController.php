<?php

namespace backend\controllers;

use Yii;
use common\models\Customer;
use backend\models\CustomerSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Heart;
use yii\web\UploadedFile;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->birthday = Heart::dateFormat($model->birthday,'Y-m-d','d/m/Y');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(int $user_id)
    {
        $model = new Customer([
            'user_id' => $user_id
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $model->birthday = Heart::dateFormat($model->birthday,'d/m/Y','Y-m-d');
            $avatar_new = UploadedFile::getInstance($model, 'avatar_new');
            if ($avatar_new) {
                $filename = $avatar_new->baseName . '.' . $avatar_new->extension;
                $path = Heart::getUploadPath('customers/'.$user_id.'/');
                $upload = $avatar_new->saveAs($path . $filename);
                if($upload) $model->avatar = $filename;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->birthday = Heart::dateFormat($model->birthday,'d/m/Y','Y-m-d');
            $avatar_new = UploadedFile::getInstance($model, 'avatar_new');
            if ($avatar_new) {
                $filename = $avatar_new->baseName . '.' . $avatar_new->extension;
                $path = Heart::getUploadPath('customers/'.$id.'/');
                $upload = $avatar_new->saveAs($path . $filename);
                if($upload) {
                    @unlink($path . $model->avatar);
                    $model->avatar = $filename;
                }    
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        $model->birthday = Heart::dateFormat($model->birthday,'Y-m-d','d/m/Y');

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->avatar;
        if($model->delete()){
            $path = Heart::getUploadPath('customers/'.$id.'/');
            @unlink($path . $filename);
        }
            
        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
