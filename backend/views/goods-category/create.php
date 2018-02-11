<?php

use yii\helpers\Html;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = Yii::t('app', 'Create Goods Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-create">

    <div class="row">
    <div class="col-sm-6 lead">
        <?= Heart::icon('tag').' '.Html::encode($this->title) ?>
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
