<?php

/**
 * @copyright Copyright &copy; Hafid Mukhlasin, hafidmukhlasin.com, 2018
 * @package yii2-font-awesome
 * @version 1.0.0
 */

 namespace common\assets;
 
 use yii\web\AssetBundle;

/**
 * Asset bundle for FontAwesome icon set. Uses client assets (CSS, images, and fonts) from font-awesome repository.
 *
 * @see http://fortawesome.github.io/Font-Awesome/
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 */
class FontAwesomeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = __DIR__.'/font-awesome';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        'only' => ['webfonts/*', 'css/*']
    ];

    public $css = [ 
        'css/fontawesome-all.css', 
    ];
}
