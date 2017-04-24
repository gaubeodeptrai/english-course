<?php
namespace app\modules\couponcode;

class CouponcodeModule extends \yii\easyii\components\Module
{
    public static $installConfig = [
        'title' => [
            'en' => 'Coupon Code',
            'ru' => 'Текстовые блоки',
        ],
        'icon' => 'font',
        'order_num' => 20,
    ];
}