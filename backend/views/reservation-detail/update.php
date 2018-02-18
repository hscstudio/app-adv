<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReservationDetail */

$this->title = Yii::t('app', 'Update Reservation Detail: {nameAttribute}', [
    'nameAttribute' => $model->reservation_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reservation_id, 'url' => ['view', 'reservation_id' => $model->reservation_id, 'goods_id' => $model->goods_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reservation-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
