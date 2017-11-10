<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/landing.css'
    ];
    public $js = [
        'js/landing/pjax-submit-event.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
