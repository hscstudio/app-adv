<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'View User #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Html::encode($this->title) ?>
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
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
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
            [
                'label'=>'Created',
                'format' => 'html',
                'value'=>function($data){
                    return 
                        Html::tag('span',date('d/M/Y H:i:s',$data->created_at),['class'=>'label label-default']);
                }
            ],
            [
                'label'=>'Modified',
                'format' => 'html',
                'value'=>function($data){
                    return 
                        Html::tag('span',date('d/M/Y H:i:s',$data->updated_at),['class'=>'label label-default']);
                }
            ],
        ],
    ]) ?>
    </div>
    
</div>
