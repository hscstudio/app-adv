<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goods Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('tags').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Yii::t('app', Heart::icon('plus-circle').' Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
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
            [    
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->name,['view','id'=>$data->id],[
                        'title' => $data->description
                    ]);
                }
            ],
            [
                'attribute' => 'image',
                'filter' => false,
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Url::to([
                        'site/image',
                        'image'=>'goods-categories/'.$data->id.'/'.$data->image,
                    ]),
                    ['class'=>'img-responsive img-rounded','style'=>'max-height:50px;']);
                }
            ],
            [    
                'label' => 'Goods',
                'format' => 'html',
                'value' => function($data){
                    $count = \backend\models\GoodsSearch::find()
                        ->where(['category_id'=>$data->id])
                        ->count();
                    return Html::a($count,['goods/index','GS[category_id]'=>$data->id]);
                }
            ],
            //'created_at',
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
