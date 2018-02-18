<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('cubes').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Yii::t('app', Heart::icon('plus-circle').' Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        </div>
    </div>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

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
            /*
            [
                'attribute' => 'image',
                'filter'   => false,
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Url::to([
                        'site/image',
                        'image'=>'goods/'.$data->id.'/'.$data->image,
                    ]),
                    ['class'=>'img-responsive img-rounded','style'=>'max-height:50px;']);
                }
            ],
            */
            [
                'attribute'=>'category_id',
                'label'=>'Category',
                'filter'=> ArrayHelper::map($categories,'id','name'),
                'value'=>function($data){
                    return ($data->category)?$data->category->name:'';
                }
            ],
            [
                'attribute'=>'stock',
                'filter'=>false,
                'value'=>function($data){
                    return $data->stock;
                }
            ],
            [
                'attribute'=>'rate',
                'filter'=>false,
                'value'=>function($data){
                    return 'Rp. '.number_format($data->rate);
                }
            ],
            [
                'label' => 'Other',
                'format' => 'raw',
                'value' => function ($data){
                    $return = Html::beginTag('div', ['class'=>'dropdown']);
                    $return .= Html::button('Action <span class="caret"></span></button>', 
                        ['type'=>'button', 'class'=>'btn btn-default btn-xs', 'data-toggle'=>'dropdown']);
                    $return .= DropdownX::widget([
                        'items' => [
                            ['label' => 'Files', 'url' => ['goods-file/index','goods_id'=>$data->id]],
                            ['label' => 'Comment', 'url' => ['goods-comment/index','goods_id'=>$data->id]],
                            ['label' => 'Review', 'url' => ['goods-review/index','goods_id'=>$data->id]],
                        ],
                    ]); 
                    $return .= Html::endTag('div');
                    return $return;
                }
            ],
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
