<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reply_id')->textInput() ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'response_admin')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
