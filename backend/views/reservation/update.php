<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */

$this->title = Yii::t('app', 'Update Reservation: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('comment').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
            <?= Html::a(Heart::icon('arrow-alt-circle-left'), ['index'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'file_ext' => $file_ext,
    ]) ?>

</div>
