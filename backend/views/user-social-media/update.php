<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserSocialMedia */

$this->title = Yii::t('app', 'Update User Social Media: {nameAttribute}', [
    'nameAttribute' => $model->user_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Social Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-social-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
