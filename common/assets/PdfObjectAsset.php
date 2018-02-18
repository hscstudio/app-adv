<?php

/**
 * @copyright Copyright &copy; Hafid Mukhlasin, hafidmukhlasin.com, 2018
 * @package yii2-pdf-object
 * @version 1.4.3
 */

 namespace common\assets;
 
 use yii\web\AssetBundle;

/**
 * Asset bundle for PDF Object
 *
 * @see http://
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 */
class PdfObjectAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = __DIR__.'/pdf-object';

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
