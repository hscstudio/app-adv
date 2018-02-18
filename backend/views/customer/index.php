<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('id-card').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            [
                'label' => 'User',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->user->username,['user/view','id'=>$data->user_id],[
                        'class' => 'label label-info'
                    ]);
                }
            ],
            [    
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->name,['view','id'=>$data->user_id],[
                    ]);
                }
            ],
            //'gender',
            //'born',
            [
                'attribute'=>'birthday',
                'value'=>function($data){
                    return Heart::dateFormat($data->birthday,'Y-m-d','d/M/Y');
                }
            ],
            //'avatar',
            //'address:ntext',
            'phone',
            [
                'attribute' => 'level',
                'format' => 'html',
                'value' => function($data){
                    $level = ($data->level==1)?'REGULER':'PREMIUM';
                    return Html::tag('span',$level,[
                        'class' => 'label label-warning'
                    ]);
                }
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
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
