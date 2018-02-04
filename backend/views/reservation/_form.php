<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <?= $form->field($model, 'warranty')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bill')->textInput() ?>

    <?= $form->field($model, 'customer_shipment')->textInput() ?>

    <?= $form->field($model, 'customer_note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_proof')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid_status')->textInput() ?>

    <?= $form->field($model, 'admin_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
