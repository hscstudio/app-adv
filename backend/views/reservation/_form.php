<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\DateTimePicker;
use kartik\widgets\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use kartik\number\NumberControl;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'user_id');
    }
    else{
        $form->field($model, 'user_id')->hiddenInput()->label(false);  
        echo "<p class='lead'>"."Reservation of ".Heart::getUser((int)$model->user_id).'</p>';
    }
    ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'customer_shipment');
    }
    else{
        echo $form->field($model, 'customer_shipment')->hiddenInput()->label(false);
        echo '<label class="control-label">Address</label>';
        echo "<p>";
        if ($model->getShipment()){
            echo $model->shipment->name."<br>".
                 $model->shipment->address."<br>".
                 $model->shipment->phone;
        }
        else
            echo "-";
        echo "</p>"; 
    }
    ?>

    <?php
    
    echo $form->field($model, 'booking_date', [
        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
        'options'=>['class'=>'drp-container form-group'],
    ])->widget(DateRangePicker::classname(), [
        'attribute' => 'booking_date',
        'useWithAddon'=>true,
        'convertFormat'=>true,
        'startAttribute' => 'start',
        'endAttribute' => 'end',
        'pluginOptions'=>[
            'initRangeExpr' => true,
            'ranges' => [
                "+1 day" => ["moment().startOf('day')", "moment().endOf('day').add(1,'days')"],
                "+2 day" => ["moment().startOf('day')", "moment().endOf('day').add(2,'days')"],
                "+3 day" => ["moment().startOf('day')", "moment().endOf('day').add(3,'days')"],
                "+1 week" => ["moment().startOf('day')", "moment().endOf('day').add(1,'week')"],
            ],
            /*'timePicker'=>true,
            'timePickerIncrement'=>15,*/
            'locale'=>['format' => 'd F Y','separator'=>'  to  ',],
        ],
    ]);
    ?>

    <?= $form->field($model, 'warranty')->textarea(['rows' => 3,  'class' => 'input-sm']) ?>

    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'bill')->widget(NumberControl::classname(), [
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

    <?= $form->field($model, 'customer_note')->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>

    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'payment_proof')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'payment_proof_new')->widget(FileInput::classname(), [
            //'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'allowedFileExtensions'=>['jpg','jpeg','png','pdf'],
                'mainClass' => 'input-group-sm'
            ]
        ]) ?>
        </div>
        <div class="col-sm-6">
            <?php
            if (!$model->isNewRecord) { 
                $file_source = Url::to([
                    'site/file',
                    'filename'=>'reservation/'.$model->id.'/'.$model->payment_proof,
                    'inline'=>true
                ],true);
                if(in_array($file_ext,['jpg','jpeg','png'])){
                    echo '<img src="'.$file_source.'" class="displayMaxHeight">';
                }
                elseif(in_array($file_ext,['pdf'])){
                    echo '<object data="'.$file_source.'" type="application/pdf" width="100%" height="300px">
                            <p>Your browser does not support PDFs, please download PDF file 
                            <a href="'.$file_source.'">click here</a>.</p>
                            </object>';
                }
                else{
                    echo '-';
                } 
            }
            ?>
        </div>
    </div>

    <?= $form->field($model, 'paid_status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
        ]) ?>

    <?= $form->field($model, 'admin_note')->textarea(['rows' => 3,  'class' => 'input-sm']) ?>

    <?php
    $status = [
        0 => 'rejected',
        1 => 'awaiting',
        2 => 'approved',
        3 => 'borrowed',
        4 => 'finished',
        5 => 'unfinished',
    ];
    ?>
    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => $status,
            'options' => ['placeholder' => 'Select a level ...'],
            'size' => Select2::SMALL,
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCss('
        .displayMaxHeight{
            max-height:200px;
        }

        .preview-file img{
            border:1px solid #ddd;
            border-radius:5px;
        }

        .preview-file object{
            border:1px solid #ddd;
            border-radius:5px;
        }
')
?>