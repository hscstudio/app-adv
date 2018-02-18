<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = Yii::t('app', 'Create Customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('id-badge').' '.Html::encode($this->title) ?>
    </div>
    <div class="col-sm-6 text-right">
    <p>
        <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index'], ['class' => 'btn btn-sm btn-default']) ?>
    </p>
    </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
