<?php
namespace app\modules\couponcode\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

use yii\easyii\components\Controller;
use app\modules\couponcode\models\Coupon;

class AController extends Controller
{
    public $rootActions = ['create', 'delete'];

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Coupon::find(),
        ]);
        
        $today = strtotime(date('Y-m-d'));
 
  
 
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate($user_id = null)
    {
        $model = new Coupon;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('easyii/couponcode', 'Coupon code created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            if($user_id){
                $model->user_id = $user_id;
            }
            return $this->render('create', [
                'model' => $model,
                
            ]);
        }
    }

    public function actionEdit($id)
    {
        //echo \dektrium\user\models\User::find()->where(['id'=>$id])->one()['email'];
        $model = Coupon::find()->where(['user_id'=>$id])->one();

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if($model->save()){
                    $this->flash('success', Yii::t('easyii/couponcode', 'Coupon code updated'));
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model,
                'email' => \dektrium\user\models\User::find()->where(['id'=>$id])->one()['email'],
            ]);
        }
    }

    public function actionDelete($id)
    {
        if(($model = Coupon::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/couponcode', 'Coupon code deleted'));
    }
}