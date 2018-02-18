<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('users').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Yii::t('app', Heart::icon('user-plus').' Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'username',
                'format'=>'html',
                'value'=>function($data){
                    return Html::a($data->username,['view','id'=>$data->id]);
                }
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'header' => 'Customer',
                'format' => 'html',
                'value' => function ($data){
                    $customer = \common\models\Customer::findOne($data->id);
                    if($customer){
                        return Html::a($customer->user->username,['customer/view','id'=>$data->id],['class'=>'label label-primary']);
                    }
                    else{
                        return Html::a(Heart::icon('plus'),['customer/create','user_id'=>$data->id],['class'=>'label label-primary']);
                    }
                }
            ],
            [
                'attribute' => 'level',
                'format' => 'html',
                'value' => function($data){
                    $level = ($data->level==2)?'ADMIN':(($data->level==1)?'STAFF':'USER');
                    return Html::tag('span',$level,[
                        'class' => 'label label-info'
                    ]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data){
                    $status = ($data->status==1)?'ON':'OFF';
                    $label = ($data->status==1)?'success':'danger';
                    return Html::tag('span',$status,[
                        'class' => 'label label-'.$label
                    ]);
                }
            ],
            //'created_at',
            //'updated_at',

            [
                'header' => Heart::icon('edit'),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a(Heart::icon('edit'), $url, [
                                    'title' => 'Update',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
