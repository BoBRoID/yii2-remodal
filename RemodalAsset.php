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

    public $sourcePath = '@bower/remodal/dist';

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $css = [
        'remodal.css',
        'remodal-default-theme.css',
    ];

    public $js = [
        'remodal.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

}