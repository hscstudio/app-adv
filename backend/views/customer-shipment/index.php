<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shipments: '.' "'.$customer->name.'"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('truck').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['customer/view','id'=>$customer->user_id], ['class' => 'btn btn-sm btn-default']) ?>
        <?= Html::a(Yii::t('app', Heart::icon('ambulance').' Create'), ['create','user_id'=>$customer->user_id], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [    
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->title,['view','id'=>$data->user_id],[
                    ]);
                }
            ],
            'name',
            'address:ntext',
            'phone',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'status',

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
    <?php Pjax::end(); ?>
</div>
