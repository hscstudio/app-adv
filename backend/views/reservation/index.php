<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reservations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('calendar-check').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Yii::t('app', Heart::icon('calendar-plus').' Create'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'user_id',
                'label'=>'Customer',
                'filter' => false,
                'format' => 'html',
                'value'=>function($data){
                    return Html::a($data->customer->name,['view','id'=>$data->id]);
                }
            ],
            'start',
            'end',
            //'warranty:ntext',
            'bill',
            //'customer_shipment',
            //'customer_note',
            //'payment_proof',
            'paid_status',
            //'admin_note:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
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
