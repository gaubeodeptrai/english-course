<?php

namespace app\controllers;

use app\models\AddToCartForm;
use Yii;
use app\modules\courses\api\Catalog;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\easyii\modules\shopcart\models\Order;

class CheckoutController extends \yii\web\Controller
{
    public $successUrl = '';
    
   public function behaviors()
   {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['login','plan',  'error'],
                    'allow' => true,
                ],
                [
                    'actions' => ['logout', 'index', 'add','remove','success'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ],
     ];
   }
   
   public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
             'auth' => [
                 'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => $this->successUrl
            ],
        ];
    }
    
    public function actionIndex()
    {
        
        //exit();
        return $this->render('index', [
            'goods' => Shopcart::goods()
        ]);
    }

    public function actionSuccess($status=0,$order_id=null,$user_id=null)
    {
        if ($status == 200 && $order_id && $user_id){
            $order = Order::findOne($order_id);
            $order->user_id = $user_id;
            $order->status = Order::STATUS_COMPLETED;
            $order->save();
            
            $couponcode = new \app\modules\couponcode\models\Coupon();
            $couponcode->user_id = $user_id;
            $count_user = $couponcode->find()->where(['user_id'=>$user_id])->count();
            if ($count_user == 0){
                 $couponcode->save();
            }
        }
        return $this->render('success');
    }

    public function actionAdd($id)
    {
    
        
        //exit();
        //$item = Catalog::get($id);

        //if(!$item){
            //throw new NotFoundHttpException('Item not found');
        //}

        $form = new AddToCartForm();
        $success = 0;
        
        
            $response = Shopcart::add($id, 1, '');
            $success = $response['result'] == 'success' ? 1 : 0;
        
        //echo "<pre>";
        //print_r(Shopcart::goods()) ;
        //echo "</pre>";
        if ($success==1){
            return $this->redirect('../index');
        }
        else{
        return $this->render('index',[
            'goods' => Shopcart::goods()
        ]);
       }
    }

    public function actionRemove($id)
    {
        Shopcart::remove($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate()
    {
        Shopcart::update(Yii::$app->request->post('Good'));
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionOrder($id, $token)
    {
        $order = Shopcart::order($id);
        if(!$order || $order->access_token != $token){
            throw new NotFoundHttpException('Order not found');
        }

        return $this->render('order', ['order' => $order]);
    }

}
