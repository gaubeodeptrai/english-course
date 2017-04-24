<?php
namespace app\modules\courses\models;


class Category extends \yii\easyii\components\CategoryModel
{


    static $fieldTypes = [
        'string' => 'String',
        'text' => 'Text',
        'boolean' => 'Boolean',
        'select' => 'Select',
        'checkbox' => 'Checkbox'
    ];



    public static function tableName()
    {
        return 'app_courses_categories';
    }
    
    public function rules()
    {
        return [
            ['title', 'required'],
            ['type', 'required'],
            ['title', 'trim'],
            ['title', 'string', 'max' => 128],
            ['image', 'image'],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => \Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['price', 'number'],
            ['description', 'safe'],
            ['short_description', 'safe'],
            ['logan_g', 'safe'],
            ['type','safe']
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert && ($parent = $this->parents(1)->one())){
                $this->fields = $parent->fields;
            }

            if(!$this->fields || !is_array($this->fields)){
                $this->fields = [];
            }
            $this->fields = json_encode($this->fields);

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $attributes)
    {
        parent::afterSave($insert, $attributes);
        $this->parseFields();
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->parseFields();
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'category_id'])->sortDate();
    }

    public function afterDelete()
    {
        parent::afterDelete();

        foreach($this->getItems()->all() as $item){
            $item->delete();
        }
    }

    private function parseFields(){
        $this->fields = $this->fields !== '' ? json_decode($this->fields) : [];
    }
}