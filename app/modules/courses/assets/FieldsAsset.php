<?php
namespace app\modules\courses\assets;

class FieldsAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@easyii/modules/catalog/media';
    public $css = [
        'css/fields.css',
    ];
    public $js = [
        'js/fields.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
