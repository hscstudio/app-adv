<?php

use yii\helpers\Html;
use common\helpers\Heart;


/* @var $this yii\web\View */
/* @var $model common\models\Reservation */

$this->title = Yii::t('app', 'Create Reservation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reservations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-create">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
            <?= Html::a(Heart::icon('arrow-alt-circle-left'), ['index'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
