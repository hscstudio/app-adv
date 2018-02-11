<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\helpers\Heart;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Read image from files
     */
    public function actionImage($image)
    {
        $image = str_replace(['..'],'',$image);
        $file = Heart::getUploadPath($image,0);
        if(file_exists($file)){
            $mimeType = mime_content_type($file);
            if(substr($mimeType,0,5)=='image'){
                return \Yii::$app->response->sendFile($file,null,[
                    'inline' => true,
                    'mimeType' => $mimeType,
                ]);
            }
        }
        return;
    }
    
    public function actionFile($filename,$inline=false)
    {
        $filename = str_replace(['..'],'',$filename);
        $file = Heart::getUploadPath($filename,0);
        if(file_exists($file)){
            $mimeType = mime_content_type($file);
            return \Yii::$app->response->sendFile($file,null,[
                'inline' => $inline,
                'mimeType' => $mimeType,
            ]);
        }
        return;
    }
}
