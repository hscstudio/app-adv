<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserSocialMedia */

$this->title = Yii::t('app', 'Create User Social Media');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Social Media'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
