<?php
namespace app\modules\couponcode\models;

use Yii;
use yii\easyii\behaviors\CacheFlush;

class Coupon extends \yii\easyii\components\ActiveRecord
{
    const CACHE_KEY = 'easyii_text';

    public static function tableName()
    {
        return 'app_couponcodes';
    }

    public function rules()
    {
        return [
            ['coupon_id', 'number', 'integerOnly' => true],
            //['coupon_code', 'required'],
            ['coupon_code', 'trim'],
            ['user_id', 'number'],
            ['start_date', 'default'],
            ['end_date', 'default']
        ];
    }

    public function attributeLabels()
    {
        return [
            'couponcode' => Yii::t('easyii', 'Coupon code'),
            'user_id' => Yii::t('easyii', 'Email'),
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className()
        ];
    }
    public function getUser()
    {
        return $this->hasMany(\dektrium\user\models\User::className(), ['id'=>'user_id']);   
    }
}