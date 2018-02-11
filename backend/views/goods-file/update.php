<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsFile */

$this->title = Yii::t('app', 'Update: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="goods-file-update">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('file').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index','goods_id'=>$model->goods_id], ['class' => 'btn btn-sm btn-default']) ?>
        </p>
        </div>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
