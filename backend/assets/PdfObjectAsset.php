<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-icons
 * @version 1.4.3
 */

 namespace backend\assets;
 
 use yii\web\AssetBundle;

/**
 * Asset bundle for FontAwesome icon set. Uses client assets (CSS, images, and fonts) from font-awesome repository.
 *
 * @see http://fortawesome.github.io/Font-Awesome/
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class PdfObjectAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@backend/assets/pdf-object';

    /**
     * @inheritdoc
     */
    public $publishOptions = [
        'only' => ['js/*']
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    
    public $js = [ 
        'js/pdfobject.min.js', 
    ];
}
