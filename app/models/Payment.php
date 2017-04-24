<?php
namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class Payment extends \yii\easyii\components\ActiveRecord
{
    
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    
    public static function tableName()
    {
        return 'payment';
    }

    public function rules()
    {
        return [
            [['user_id', 'item_id'], 'integer'],
             
           
            ['payment_status', 'default', 'value' => self::STATUS_OFF],
            
        ];
    }

    public function attributeLabels()
    {
        return [
           // 'customer_id' => Yii::t('easyii', 'Customer name'),
           // 'payment_id' => Yii::t('easyii', 'Payment'),
           
        ];
    }
   
    
    public function getItem()
    {
        return $this->hasMany(\yii\easyii\modules\catalog\models\Item::className(), ['item_id' => 'item_id']);
    }
    public function getUser()
    {
        return $this->hasMany(\dektrium\user\models\User::className(), ['id'=>'user_id']);   
    }
    
    
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        

        $query->andFilterWhere(['like', 'user_id', $this->total])
            ->andFilterWhere(['like', 'item_id', $this->customer_id])    
            ->andFilterWhere(['like', 'payment_status', $this->payment_id]);
            

        return $dataProvider;
    }
}