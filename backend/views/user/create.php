<?php

use yii\helpers\Html;
use common\helpers\Heart;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <div class="row">
        <div class="col-sm-6 lead">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="col-sm-6 text-right">
            <?= Html::a(Heart::icon('arrow-alt-circle-left').' Back', ['index'], ['class' => 'btn btn-sm btn-default']) ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
