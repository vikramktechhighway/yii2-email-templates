<?php

namespace tusharugale\mailtemplates;

use Yii;
use yii\web\AssetBundle;

class TemplateAsset extends AssetBundle
{

    public $sourcePath = '@tusharugale-assets';
    // public $css = [
    //     'css/site.css',
    // ];
    public $js = [
    	'js/jquery.js',
    	'js/jquery_validate.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}

