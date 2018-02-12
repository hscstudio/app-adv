<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reply_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'goods_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

    <?php 
    echo "<p class='lead'>"."Comment of ".Heart::getUser($model->user_id).' for '.$model->goods->name.'</p>';
    ?>

    <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'response_admin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
