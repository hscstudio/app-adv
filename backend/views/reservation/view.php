<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\helpers\Heart;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */

$this->title = 'Reservation #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('calendar-check').' '.Html::encode($this->title) ?>
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
            [
                'label'=>'Customer',
                'format' => 'html',
                'value'=>function($data){
                    return $data->customer->name;
                }
            ],
            'start',
            'end',
            'warranty:ntext',
            [
                'attribute' => 'bill',
                'format' => 'html',
                'value' => function($data){
                    return number_format($data->bill);
                }
            ],
            [
                'attribute' => 'customer_shipment',
                'format' => 'html',
                'value' => function($data){
                    if($data->shipment){
                        return  $data->shipment->name."<br>".
                                $data->shipment->address."<br>".
                                $data->shipment->phone;
                    }
                }
            ],
            'customer_note',
            [
                'attribute'=>'payment_proof',
                'format'=>'raw',
                'value'=>function($data) use ($file_ext){
                    $file_source = Url::to([
                        'site/file',
                        'filename'=>'reservation/'.$data->id.'/'.$data->payment_proof,
                        'inline'=>true
                    ],true);
                    if(in_array($file_ext,['jpg','jpeg','png'])){
                        return '<img src="'.$file_source.'" class="displayMaxHeight">';
                    }
                    elseif(in_array($file_ext,['pdf'])){
                        return '<object data="'.$file_source.'" type="application/pdf" width="100%" height="300px">
                                <p>Your browser does not support PDFs, please download PDF file 
                                <a href="'.$file_source.'">click here</a>.</p>
                                </object>';
                    }
                    else{
                        return '-';
                    } 
                }
            ],
            [
                'attribute' => 'paid_status',
                'format' => 'html',
                'value' => function($data){
                    $paid_status = ($data->paid_status==1)?'ON':'OFF';
                    $label = ($data->paid_status==1)?'success':'warning';
                    return Html::tag('span',$paid_status,[
                        'class' => 'label label-'.$label
                    ]);
                }
            ],
            'admin_note:ntext',
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
                    // 1 = awaiting (menunggu atau status awal), 
                    // 0 = rejected (ditolak), 
                    // 2 = approved (diterima), 
                    // 3 = borrowed (dipinjam), 
                    // 4 = finished (selesai barang kembali), 
                    // 5 = unfinished (barang tidak kembali,rusak,dicuri,dsb).
                    $status = [
                        0 => 'rejected',
                        1 => 'awaiting',
                        2 => 'approved',
                        3 => 'borrowed',
                        4 => 'finished',
                        5 => 'unfinished',
                    ];
                    if ($data->status==0) $label = 'default';
                    if ($data->status==1) $label = 'warning';
                    if ($data->status==2) $label = 'primary';
                    if ($data->status==3) $label = 'primary';
                    if ($data->status==4) $label = 'success';
                    if ($data->status==5) $label = 'danger';
                    return Html::tag('span',$status[$data->status],[
                        'class' => 'label label-'.$label
                    ]);
                }
            ],
        ],
    ]) ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'reservation_id',
            [
                'attribute'=>'goods_id',
                'label'=>'Goods',
                'value'=>function($data){
                    return $data->goods->name;
                }
            ],
            [
                'attribute'=>'goods_id',
                'label'=>'Goods Rate',
                'value'=>function($data){
                    return number_format($data->goods->rate);
                }
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>function($data){
                    return Html::a(($data->status==1)?'ON':'OFF',['set-detail-status','reservation_id'=>$data->reservation_id,'goods_id'=>$data->goods_id,'status'=>($data->status==1)?0:1]);
                }
            ],    
            [
                'header' => Heart::icon('trash'),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = str_replace('delete','delete-detail',$url);
                        return Html::a(Heart::icon('trash'), $url, [
                                    'title' => 'Delete',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
<?php
$this->registerCss('
        .displayMaxHeight{
            max-height:200px;
        }

        .preview-file img{
            border:1px solid #ddd;
            border-radius:5px;
        }

        .preview-file object{
            border:1px solid #ddd;
            border-radius:5px;
        }
')

?>
