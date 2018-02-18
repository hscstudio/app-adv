<?php

use yii\helpers\Html;
use common\helpers\Heart;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsComment */

$this->title = Yii::t('app', 'Create Goods Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods Comments'), 'url' => ['index','goods_id'=>$model->goods_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Heart::icon('comment').' '.Html::encode($this->title) ?>
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
