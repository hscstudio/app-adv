<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-view">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('tag').' '.Html::encode($this->title) ?>
    </div>
    <div class="col-sm-6 text-right">
    <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index'], ['class' => 'btn btn-sm btn-default']) ?>
        <?= Html::a(Heart::icon('edit').' Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Heart::icon('trash').' Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Url::to([
                        'site/image',
                        'image'=>'goods-categories/'.$data->id.'/'.$data->image
                    ]),
                    ['class'=>'img-responsive img-rounded','style'=>'max-width:200px;']);
                }
            ],
            [
                'label'=>'Created',
                'format' => 'html',
                'value'=>function($data){
                    return 
                        'by '.
                        Html::a(Heart::getUser($data->created_by),[
                            'user/view','id'=>$data->created_by],['class'=>'label label-default']).
                        ' at '.
                        Html::tag('span',date('d/M/Y H:i:s',$data->created_at),['class'=>'label label-default']);
                }
            ],
            [
                'label'=>'Modified',
                'format' => 'html',
                'value'=>function($data){
                    return 
                        'by '.
                        Html::a(Heart::getUser($data->updated_by),[
                            'user/view','id'=>$data->updated_by],['class'=>'label label-default']).
                        ' at '.
                        Html::tag('span',date('d/M/Y H:i:s',$data->updated_at),['class'=>'label label-default']);
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
        ],
    ]) ?>

</div>
