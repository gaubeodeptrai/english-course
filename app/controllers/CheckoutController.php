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
                    'actions' => ['login','plan',  'error','index','add','remove'],
                    'allow' => true,
                ],
                [
                    'actions' => ['logout','success','payment'],
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

    public function actionSuccess()
    {
        $base = Yii::$app->getUrlManager()->getBaseUrl();
        
        //Baokim Payment Notification (BPN) Sample
        //Lay thong tin tu Baokim POST sang
         $req = '';
        foreach ( Yii::$app->request->post() as $key => $value ) {
                $value = urlencode ( stripslashes ( $value ) );
                $req .= "&$key=$value";
        }

        //thuc hien  ghi log cac tin nhan BPN
        $myFile = "logs/bpn.log";
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, $req);

        $ch = curl_init();

        //Dia chi chay BPN test
        //curl_setopt($ch, CURLOPT_URL,'http://sandbox.baokim.vn/bpn/verify');

        //Dia chi chay BPN that
        curl_setopt($ch, CURLOPT_URL,'https://www.baokim.vn/bpn/verify');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        $error = curl_error($ch);

        if($result != '' && strstr($result,'VERIFIED') && $status==200){
	//thuc hien update hoa don
	fwrite($fh, ' => VERIFIED');
	
	$order_id = $_POST['order_id'];
	$transaction_id = $_POST['transaction_id'];
	$transaction_status = $_POST['transaction_status'];
	$total_amount = $_POST['total_amount'];
	
	//Mot so thong tin khach hang khac
	$customer_name = $_POST['customer_name'];
	$customer_address = $_POST['customer_address'];
	//...
	
	//kiem tra trang thai giao dich
        if ($transaction_status == 4||$transaction_status == 13){//Trang thai giao dich =4 la thanh toan truc tiep = 13 la thanh toan an toan
                    $order = Order::findOne($order_id);

                    $order->status = Order::STATUS_COMPLETED;


                    $couponcode = new \app\modules\couponcode\models\Coupon();
                    $couponcode->user_id = $order->user_id;
                    $count_user = $couponcode->find()->where(['user_id'=>$order->user_id])->count();
                    if ($count_user == 0){
                         $couponcode->save();
                    }
                   if ($order->save()){
                     return $this->redirect($base.'/success');
                  }
                }

                /**
                 * Neu khong thi bo qua
                 */
        }else{
                fwrite($fh, ' => INVALID');
        }

        if ($error){
                fwrite($fh, " | ERROR: $error");
        }

        fwrite($fh, "\r\n");
        fclose($fh);
        return $this->redirect($base.'/unsuccess');  

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
    
    public function actionPayment(){
        $goods = Shopcart::goods();
        foreach ($goods as $item):
            $order_id =  $item->order_id;
        endforeach;
        if ($order_id):
          $order = Order::findOne($order_id);
          $order->user_id = \Yii::$app->user->id;
          $order->save();
        endif;
        return $this->render('payment',[
            'goods' => Shopcart::goods()
        ]);
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
