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
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput([
            'maxlength' => true,
            'class' => 'input-sm',
        ]) ?>
        </div>
        <div class="col-sm-6">  
        <?= $form->field($model, 'gender')->widget(SwitchInput::classname(), [
            'pluginOptions'=>[
                'handleWidth'=>60,
                'onText'=>'Male',
                'offText'=>'Female',
                'size'=>'small'
            ],
            
        ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'born')->textInput(['maxlength' => true,'class' => 'input-sm']) ?>
        </div>
        <div class="col-sm-6">    
        <?= $form->field($model, 'birthday', [
                'feedbackIcon' => [
                    'prefix' => 'fas fa-',
                    'default' => 'calendar-alt'
                ]
            ])->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter birth date ...'],
            'size' => 'sm',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
            ]
        ]); ?>
        </div>
    </div>
    
    <?= $form->field($model, 'avatar')->hiddenInput()->label(false) ?>

    <?php
    if (!$model->isNewRecord) { ?>
    <div class="row">
        <div class="col-sm-6">
        <?= Html::img(Url::to([
                        'site/image',
                        'image'=>'customers/'.$model->user_id.'/'.$model->avatar
                    ]),
        ['class'=>'img-responsive img-rounded','style'=>'max-width:200px;margin-bottom:20px;']) ?>
        </div>
        <div class="col-sm-6">
        <?php } ?>

        <?= $form->field($model, 'avatar_new')->widget(FileInput::classname(), [
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

    <?= $form->field($model, 'address')->textarea(['rows' => 3, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'phone', [
        'feedbackIcon' => [
            'prefix' => 'fas fa-',
            'default' => 'mobile-alt'
        ]
    ])->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>
    
    <div class="row">
        <div class="col-xs-6">
        <?= $form->field($model, 'level')->widget(Select2::classname(), [
            'data' => ['1'=>'REGULER','2'=>'PREMIUM'],
            'options' => ['placeholder' => 'Select a level ...'],
            'size' => Select2::SMALL,
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) ?>
        </div>
        <div class="col-xs-6">
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
            'pluginOptions' => ['size' => 'small'],
        ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
