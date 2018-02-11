<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('id-badge').' '.Html::encode($this->title) ?>
    </div>
    <div class="col-sm-6 text-right">
    <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index'], ['class' => 'btn btn-sm btn-default']) ?>
        <?= Html::a(Heart::icon('edit').' Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Heart::icon('trash').' Delete', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
    </div>

    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'user_id',
            'name',
            [
                'attribute' => 'gender',
                'format' => 'html',
                'value' => function($data){
                    return ($data->gender==1)?'Male':'Female';
                }
            ],
            'born',
            'birthday',
            [
                'attribute' => 'avatar',
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Url::to([
                        'site/image',
                        'image'=>'customers/'.$data->user_id.'/'.$data->avatar
                    ]),
                    ['class'=>'img-responsive img-rounded','style'=>'max-width:200px;']);
                }
            ],
            'address:ntext',
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
            [
                'label' => 'Shipments',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(Heart::icon('arrow-alt-circle-right').' Detail',['customer-shipment/index','user_id'=>$data->user_id],[
                        'class' => 'btn btn-sm btn-default'
                    ]);
                }
            ],
        ],
    ]) ?>
    </div>
</div>
