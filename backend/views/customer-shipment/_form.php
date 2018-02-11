<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerShipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-shipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 3, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
