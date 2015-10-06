<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 06.10.15
 * Time: 13:09
 */

namespace bobroid\remodal;

use yii\web\AssetBundle;

class RemodalAsset extends AssetBundle{

    public $sourcePath = '@vendor/bobroid/yii2-remodal/assets';

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $css = [
        'css/remodal.css',
        'css/remodal-default-theme.css',
    ];

    public $js = [
        'js/remodal.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

}