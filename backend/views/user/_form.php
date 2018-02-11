<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php 
    /*
    $form->field($model, 'level')->widget(Select2::classname(), [
        'data' => ['0'=>'USER','1'=>'STAFF','2'=>'ADMIN'],
        'options' => ['placeholder' => 'Select a level ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])*/
    ?>

    <?php
    $levels = ['0'=>'USER','1'=>'STAFF','2'=>'ADMIN'];
    //echo $form->field($model, 'level')->radioList($levels, ['inline'=>true]);
    echo $form->field($model, 'level')->radioButtonGroup($levels, [
        'class' => 'btn-group-sm',
        'itemOptions' => ['labelOptions' => ['class' => 'btn btn-warning']]
    ]);

    //echo $form->field($model, 'level')->multiselect($levels, ['selector'=>'radio']);
    ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCss('
        div#user-level{
            display:block;
            clear:both;
            margin-bottom:50px;
        }
')

?>
