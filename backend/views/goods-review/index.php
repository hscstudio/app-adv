<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\Heart;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goods Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Goods Review'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'goods_id',
            'user_id',
            'review:ntext',
            'response_admin:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'status',

            [
                'header' => Heart::icon('edit'),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a(Heart::icon('edit'), $url, [
                                    'title' => 'Update',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
