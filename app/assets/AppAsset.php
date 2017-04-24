<?php
namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/media/english-course';
    public $css = [
        //'css/styles.css',
        "css/bootstrap.min.css" ,
        "css/font-awesome.min.css",
        "css/linearicons-free.css",
        "vendor/fancybox/css/fancybox.css",
        "css/simple-line-icons.css",
        "css/animate.css",
        "vendor/flexslider/flexslider.css",
        "css/global.css",
        "css/style.css",
        "css/bootstrap-social.css"
    ];
    public $js = [
        //'js/scripts.js'
        //"js/jquery.min.js",
        "js/bootstrap.min.js",

        "vendor/flexslider/jquery.flexslider-min.js",

        "js/theme.js",

        "vendor/fancybox/js/jquery.fancybox.js",
        "vendor/fancybox/js/custom.fancybox.js",
        "js/wow.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}



