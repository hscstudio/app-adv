<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Files: '.' "'.$goods->name.'"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('file-alt').' '.Html::encode($this->title) ?>
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
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->title,['view','id'=>$data->goods_id],[
                    ]);
                }
            ],
            //'description:ntext',
            [    
                'attribute' => 'file',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(Heart::icon('download'),[
                        'site/file',
                        'filename'=>'goods-file/'.$data->goods_id.'/'.$data->file,
                        'inline'=>false
                    ],['class'=>'btn btn-xs btn-default']);
                }
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function($data){
                    $type = ($data->type==0)?'image':(($data->type==1)?'pdf':'video');
                    return Html::tag('span',$type,[
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
    <?php Pjax::end(); ?>
</div>
