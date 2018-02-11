<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\ReservationDetail */

$this->title = Yii::t('app', 'Update Reservation Detail: {nameAttribute}', [
    'nameAttribute' => $model->reservation_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservation Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reservation_id, 'url' => ['view', 'id' => $model->reservation_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reservation-detail-update">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="col-sm-6 text-right">
        <?= Html::a(Heart::icon('arrow-alt-circle-left'), ['index'], ['class' => 'btn btn-success']) ?>
    </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
