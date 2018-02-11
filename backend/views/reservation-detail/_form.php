<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\ReservationDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservation-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reservation_id')->textInput() ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
