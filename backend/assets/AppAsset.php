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
    public $css = [
        'css/site.css',
        'template/sbadmin2/vendor/metisMenu/metisMenu.min.css',
        'template/sbadmin2/dist/css/sb-admin-2.css',
        'template/sbadmin2/vendor/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        'template/sbadmin2/vendor/metisMenu/metisMenu.min.js',
        'template/sbadmin2/dist/js/sb-admin-2.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
