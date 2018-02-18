<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $css = [
        'css/site.css',
    ];
    public $js = [

    ];

    public $depends = [
        'common\themes\lightbootstrap\ThemeAsset',
        'common\assets\FontawesomeAsset',
        'common\assets\PdfObjectAsset',
    ];
}
