<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class' => 'input-sm']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3,'class' => 'input-sm',]) ?>

    <?= $form->field($model, 'image')->hiddenInput()->label(false) ?>

    <?php
    if (!$model->isNewRecord) { ?>
    <div class="row">
        <div class="col-sm-6">
        <?= Html::img(Url::to([
                        'site/image',
                        'image'=>'goods-categories/'.$model->id.'/'.$model->image,
                    ]),
        ['class'=>'img-responsive img-rounded','style'=>'max-width:200px;margin-bottom:20px']) ?>
        </div>
        <div class="col-sm-6">
        <?php } ?>

        <?= $form->field($model, 'image_new')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'mainClass' => 'input-group-sm'
            ]
        ]) ?>
        <?php
        if (!$model->isNewRecord) { ?>
        </div>
    </div>
    <?php } ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
