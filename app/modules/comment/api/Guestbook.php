<?php
namespace app\modules\comment\api;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\comment\models\Guestbook as GuestbookModel;
use yii\easyii\widgets\ReCaptcha;
use kartik\rating\StarRating;

/**
 * Guestbook module API
 * @package app\modules\comment\api
 *
 * @method static string form(array $options = []) Returns fully worked standalone html form.
 * @method static array items(array $options = []) Get list of guestbook posts as PostObject objects
 * @method static array save(array $attributes) If you using your own form, this function will be useful for manual saving guestbook posts.
 * @method static mixed last(int $limit = 1) Get last posts as PostObject objects
 * @method static string pages() returns pagination html generated by yii\widgets\LinkPager widget.
 * @method static \stdClass pagination() returns yii\data\Pagination object.
 */

class Guestbook extends \yii\easyii\components\API
{
    const SENT_VAR = 'guestbook_sent';

    private $_adp;
    private $_last;
    private $_items;

    private $_defaultFormOptions = [
        'errorUrl' => '',
        'successUrl' => ''
    ];

    public function api_items($options = [],$cat=NULL)
    {
        if(!$this->_items){
            $this->_items = [];
            if($cat==NULL):
              $query = GuestbookModel::find()->status(GuestbookModel::STATUS_ON)->sortDate();
            else:
               $query = GuestbookModel::find()->where(['course_id'=>$cat])->status(GuestbookModel::STATUS_ON)->sortDate(); 
            endif; 
            if(!empty($options['where'])){
                $query->andFilterWhere($options['where']);
            }

            $this->_adp = new ActiveDataProvider([
                'query' => $query,
                'pagination' => !empty($options['pagination']) ? $options['pagination'] : []
            ]);

            foreach($this->_adp->models as $model){
                $this->_items[] = new PostObject($model);
            }
        }
        return $this->_items;
    }

    public function api_last($limit = 1)
    {
        if($limit === 1 && $this->_last){
            return $this->_last;
        }

        $result = [];
        foreach(GuestbookModel::find()->status(GuestbookModel::STATUS_ON)->sortDate()->limit($limit)->all() as $item){
            $result[] = new PostObject($item);
        }

        if($limit > 1){
            return $result;
        } else {
            $this->_last = count($result) ? $result[0] : null;
            return $this->_last;
        }
    }

    public function api_form($options = [],$item_id=1)
    {
        $model = new GuestbookModel;
        $settings = Yii::$app->getModule('admin')->activeModules['comment']->settings;
        $options = array_merge($this->_defaultFormOptions, $options);

        ob_start();
        $form = ActiveForm::begin([
            'enableClientValidation' => true,
            'action' => Url::to(['/admin/comment/send'])
        ]);

        echo Html::hiddenInput('errorUrl', $options['errorUrl'] ? $options['errorUrl'] : Url::current([self::SENT_VAR => 0]));
        echo Html::hiddenInput('successUrl', $options['successUrl'] ? $options['successUrl'] : Url::current([self::SENT_VAR => 1]));

        echo $form->field($model, 'name');
        //echo $form->field($model, 'item_id');
        echo '<input class="form-control" name="Guestbook[course_id]" type="hidden" value="'.$item_id.'">';

        if($settings['enableTitle']) echo $form->field($model, 'title');
        if($settings['enableEmail']) echo $form->field($model, 'email');
        echo $form->field($model, 'rating')->widget(StarRating::classname(), [
          'pluginOptions' => [
              'step' => 0.5,
               
            ] 
        ]);
        
        echo $form->field($model, 'text')->textarea();

        if($settings['enableCaptcha']) echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className());

        echo Html::submitButton(Yii::t('easyii', 'Send'), ['class' => 'btn btn-primary']);
        ActiveForm::end();

        return ob_get_clean();
    }

    public function api_save($data)
    {
        $model = new GuestbookModel($data);
        $model->scenario = 'send';
        if ($model->save()) {
            return ['result' => 'success'];
        } else {
            return ['result' => 'error', 'error' => $model->getErrors()];
        }
    }

    public function api_pagination()
    {
        return $this->_adp ? $this->_adp->pagination : null;
    }

    public function api_pages()
    {
        return $this->_adp ? LinkPager::widget(['pagination' => $this->_adp->pagination]) : '';
    }
}