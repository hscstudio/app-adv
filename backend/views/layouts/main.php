<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap\Nav;
use common\themes\lightbootstrap\widgets\NavBar;
use common\themes\lightbootstrap\widgets\NavBarSide;
use common\themes\lightbootstrap\widgets\Nav as NavSide;
use yii\widgets\Breadcrumbs;
use kartik\widgets\AlertBlock;
use common\helpers\Heart;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <?php
    $lightbootstrap = Yii::$app->assetManager->getBundle('common\themes\lightbootstrap\ThemeAsset');
    NavBarSide::begin([
        'brandLabel' => 'MRP BoardGame',
        'brandUrl' => Yii::$app->homeUrl,
        'brandIcon' => 'BG',
        'assetDir' => $lightbootstrap->baseUrl,
    ]);

    // TODO
    echo '<div class="user">
    <div class="info">
        <div class="photo">
            <img src="'.Yii::getAlias('@web').'/img/default.jpg" />
        </div>

        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
            <span>
                '.((!Yii::$app->user->isGuest)?Yii::$app->user->identity->username:'None').'
                <b class="caret"></b>
            </span>
        </a>

        <div class="collapse" id="collapseExample">
            <ul class="nav">
                <li>
                    <a href="#pablo">
                        <span class="sidebar-mini">MP</span>
                        <span class="sidebar-normal">My Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#pablo">
                        <span class="sidebar-mini">EP</span>
                        <span class="sidebar-normal">Edit Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#pablo">
                        <span class="sidebar-mini">S</span>
                        <span class="sidebar-normal">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>';

    $menuItems[] = ['icon' => Heart::icon('list-alt'), 'label' => 'Menu', 'url'=>'#submenu1', 'items' => [
        ['icon' => Heart::icon('users'), 'label' =>' User', 'url' => ['/user/index']],
        ['icon' => Heart::icon('id-card'), 'label' =>' Customer', 'url' => ['/customer/index']],
        ['icon' => Heart::icon('tags'), 'label' =>' Goods Category', 'url' => ['/goods-category/index']],
        ['icon' => Heart::icon('cubes'), 'label' =>' Goods', 'url' => ['/goods/index']],
        ['icon' => Heart::icon('calendar-check'), 'label' =>' Reservation', 'url' => ['/reservation/index']],
    ]];
    echo NavSide::widget([
        //'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
        'encodeLabels' => false, 
    ]);

    NavBarSide::end();
    ?>
    
    <?= Html::beginTag('div',['class'=>'main-panel']); ?>

        <?php
        NavBar::begin([
            'brandLabel' => $this->title,
            //'brandUrl' => Yii::$app->homeUrl,
            'innerContainerOptions' => [
                'class' => 'contrainer-fluid',
            ]
        ]);
        $menuItems = [
            //['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => Heart::icon('list-alt').'', 'items' => [
                    ['label' => Heart::icon('users').' User', 'url' => ['/user/index']],
                    ['label' => Heart::icon('id-card').' Customer', 'url' => ['/customer/index']],
                    ['label' => Heart::icon('tags').' Goods Category', 'url' => ['/goods-category/index']],
                    ['label' => Heart::icon('cubes').' Goods', 'url' => ['/goods/index']],
                    ['label' => Heart::icon('calendar-check').' Reservation', 'url' => ['/reservation/index']],
                ]];
                $menuItems[] = ['label' => Heart::icon('user-circle').'', 'items' => [
                    //'<li class="text-center"><a><strong>'.Yii::$app->user->identity->username.'</strong></a></li>',
                    ['label' => Heart::icon('envelope').' Message', 'url' => ['/user/index']],
                    ['label' => Heart::icon('id-badge').' Profile', 'url' => ['/user/index']],
                    '<li class="divider"></li>',
                    ['label' => Heart::icon('lock').' Lock Screen', 'url' => ['/user/index']],
                    [
                        'label' => Heart::icon('power-off').' Logout',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                    ],
                ]];
            /*
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post',['class'=>'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
            */
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
            'encodeLabels' => false, 
        ]);
        NavBar::end();
        ?>

        <div class="main-content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php
            echo AlertBlock::widget([
                'type' => AlertBlock::TYPE_GROWL,
                'useSessionFlash' => true
            ]);
            ?>
            <?= $content ?>
        </div>

    
    <footer class="footer">
        <div class="container-fluid">
            <p class="copyright pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="copyright pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <?= Html::endTag('div') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
