<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = Yii::t('app', 'Create Goods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('cube').' '.Html::encode($this->title) ?>
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
