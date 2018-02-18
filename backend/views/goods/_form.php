<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use yii\web\JsExpression;
use kartik\number\NumberControl;
use common\models\GoodCategory;

use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class' => 'input-sm']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3,'class' => 'input-sm']) ?>

    <?= $form->field($model, 'image')->hiddenInput()->label(false) ?>

    <?php
    if (!$model->isNewRecord) { ?>
    <div class="row">
        <div class="col-sm-6">
        <?= Html::img(Url::to([
                        'site/image',
                        'image'=>'goods/'.$model->id.'/'.$model->image,
                    ]),
        ['class'=>'img-responsive img-rounded','style'=>'max-width:200px;']) ?>
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

    <?php
    $category_url = Url::to(['goods-category/list']);
    $category = ($model->category_id>0) ? $model->category->name : '';
    
    echo $form->field($model, 'category_id')->widget(Select2::classname(), [
        'initValueText' => $category, // set the initial display text
        'options' => ['placeholder' => 'Search for a category ...'],
        'size' => Select2::SMALL,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 0,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $category_url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(items) { return items.text; }'),
            'templateSelection' => new JsExpression('function (items) { return items.text; }'),
        ],
    ])->label('Category');
    ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'stock')->textInput(['class' => 'input-sm']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'rate')->widget(NumberControl::classname(), [
                'maskedInputOptions' => [
                    'prefix' => 'Rp ',
                    //'suffix' => ' ,-',
                    'allowMinus' => false,
                ],
                'displayOptions' => [
                    'class' => 'form-control input-sm',
                ],
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
