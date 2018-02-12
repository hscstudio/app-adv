<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input-sm']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3, 'class' => 'input-sm']) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'file')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'file_new')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'previewFileType' => 'any',
                    'allowedFileExtensions'=>['jpg','jpeg','png','pdf','mp4','webm'],
                    'mainClass' => 'input-group-sm'
                ],
            ]) ?>

            <?php
            $types = ['0'=>'image','1'=>'pdf','2'=>'video'];
            echo $form->field($model, 'type')->radioButtonGroup($types, [
                'disabled' => true,
                'class' => 'btn-group-sm',
                'itemOptions' => ['labelOptions' => ['class' => 'btn btn-warning']]
            ]);
            ?>
        </div>
        <div class="col-sm-6">
            <?php 
            $file_source = Url::to([
                    'site/file',
                    'filename'=>'goods-file/'.$model->goods_id.'/'.$model->file,
                    'inline'=>true
                ],true);
            if($model->type==0){
                echo '<img src="'.$file_source.'" class="displayMaxHeight">';
            }
            else if($model->type==1){
                //echo "<div class='embed-responsive' style='padding-bottom:150%'>";
                echo '<object data="'.$file_source.'" type="application/pdf" width="100%" height="300px">
                        <p>Your browser does not support PDFs, please download PDF file 
                        <a href="'.$file_source.'">click here</a>.</p>
                        </object>';
                //echo "</div>";
            }
            else if($model->type==2){        
                echo '<video controls src="'.$file_source.'" type="video/mp4"       
                            class="displayMaxHeight">
                            <p>Your browser does not support the video element.</p>
                        </video>';
            }
            ?>
        </div>
    </div>    
    

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => ['size' => 'small'],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Heart::icon('save').' '.Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCss('
        div#goodsfile-type{
            display:block;
            clear:both;
            margin-bottom:50px;
        }

        .displayMaxHeight{
            max-height:200px;
        }

        .preview-file video{
            border:1px solid #ddd;
            border-radius:5px;
        }

        .preview-file img{
            border:1px solid #ddd;
            border-radius:5px;
        }

        .preview-file object{
            border:1px solid #ddd;
            border-radius:5px;
        }

        .embed-responsive {
            /*
            position: relative;
            display: block;
            height: 200px;
            max-height:200px;
            padding: 0;
            overflow: hidden;
            margin-bottom:20px;
            */
        }
')

?>
