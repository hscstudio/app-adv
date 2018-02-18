<?php

/**
 * @copyright Copyright &copy; Hafid Mukhlasin, hafidmukhlasin.com, 2018
 * @package yii2-light-bootstrap
 * @version 1.4.3
 */

 namespace common\themes\lightbootstrap;
 
 use yii\web\AssetBundle;

/**
 * Asset bundle for LightBootstrap
 *
 * @see http://
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = __DIR__.'/assets';

    public $css = [
        'css/pe-icon-7-stroke.css',
        'css/light-bootstrap-dashboard.css',
        //'css/widget.css',
    ];
    public $js = [
        'js/perfect-scrollbar.jquery.min.js',
        'js/light-bootstrap-dashboard.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
