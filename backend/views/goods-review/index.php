<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review: '.' "'.$goods->name.'"';;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('comment-alt').' '.Html::encode($this->title) ?>
    </div>
    <div class="col-sm-6 text-right">
    <p>
    <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['goods/view','id'=>$goods->id], ['class' => 'btn btn-sm btn-default']) ?>
    <?= Html::a(Yii::t('app', Heart::icon('plus-circle').' Create'), ['create','goods_id'=>$goods->id], ['class' => 'btn btn-sm btn-success']) ?>
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
            //'goods_id',
            [
                'attribute'=>'user_id',
                'filter' => false,
                'value'=>function($data){
                    return Heart::getUser($data->user_id);
                }
            ],
            [
                'attribute'=>'review',
                'format'=>'html',
                'value' => function($data){
                    return Html::a($data->review,['view','id'=>$data->goods_id],[
                        ]);
                }
            ],
            'response_admin:ntext',
            [
                'attribute'=>'created_at',
                'filter' => false,
                'format' => 'html',
                'value'=>function($data){
                    return 
                        Html::tag('span',date('d/M/Y H:i:s',$data->created_at),['class'=>'label label-default']);
                }
            ],
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'attribute' => 'status',
                'filter' => false,
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
    <?php Pjax::end(); ?>
</div>
