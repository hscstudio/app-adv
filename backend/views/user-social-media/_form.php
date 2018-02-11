<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\UserSocialMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-social-media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'facebook_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'google_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'github_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
