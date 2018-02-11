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
<div class="reservation-index">

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

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'start',
            'end',
            'warranty:ntext',
            //'bill',
            //'customer_shipment',
            //'customer_note',
            //'payment_proof',
            //'paid_status',
            //'admin_note:ntext',
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
