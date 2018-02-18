<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\themes\lightbootstrap\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Widget;
use yii\bootstrap\Html;
use yii\bootstrap\BootstrapPluginAsset;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the [[begin()]] and [[end()]] calls of NavBar
 * is treated as the content of the navbar. You may use widgets such as [[Nav]]
 * or [[\yii\widgets\Menu]] to build up such content. For example,
 *
 * ```php
 * use yii\bootstrap\NavBar;
 * use yii\bootstrap\Nav;
 *
 * NavBar::begin(['brandLabel' => 'NavBar Test']);
 * echo Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => ['/site/index']],
 *         ['label' => 'About', 'url' => ['/site/about']],
 *     ],
 *     'options' => ['class' => 'navbar-nav'],
 * ]);
 * NavBar::end();
 * ```
 *
 * @see http://getbootstrap.com/components/#navbar
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */

class NavBarSide extends Widget
{
    public $assetDir = '@web';

    public $bgColor = 'orange'; // blue | azure | green | orange | red | purple

    public $bgImage = 'full-screen-image-3.jpg'; 

    public $brandLabel = 'Application';

    public $brandIcon = 'A';

    public $brandUrl = '#';
    
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        echo Html::beginTag('div',[
            'class'=>'sidebar',
            'data'=>[
                'color'=>$this->bgColor,
                'image'=>(!empty($this->bgImage))?$this->assetDir . '/img/' . $this->bgImage:'',
            ]
        ]);

            echo Html::beginTag('div',['class'=>'logo']);
                echo Html::a($this->brandIcon,$this->brandUrl,['class'=>'simple-text logo-mini']);
                echo Html::a($this->brandLabel,$this->brandUrl,['class'=>'simple-text logo-normal']);
            echo Html::endTag('div');

            echo Html::beginTag('div',[
                'class'=>'sidebar-wrapper',
            ]);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
            echo Html::endTag('div');
        echo Html::endTag('div');
    }
}
