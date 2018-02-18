<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerShipment */

$this->title = Yii::t('app', 'Create Customer Shipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('truck').' '.Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
        <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index','user_id'=>$model->user_id], ['class' => 'btn btn-sm btn-default']) ?>
        </p>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
