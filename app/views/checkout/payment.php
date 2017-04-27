<?php
use yii\helpers\Html;
use yii\easyii\modules\shopcart\api\Shopcart;
use app\modules\couponcode\models\Coupon;
use dektrium\user\models\Profile;
use yii\helpers\Url;
$base = Yii::$app->getUrlManager()->getBaseUrl();

$this->title = 'Order details';
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">Thanh toán</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->

<div class="breadcrumb-detail-page">
	<div class="container">
    	<div class="row">
            <p><a href="/">HOME</a><i class="fa fa-angle-right"></i>
            <a href="<?=$base?>/checkout/">Giỏ hàng</a><i class="fa fa-angle-right"></i>    
               Thanh toán
            </p>
        </div> <!--row #end  -->
    </div>
</div>

<div class="page-spacer clearfix"> 
 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12 col-sm-6 left-block"">
                   <table class="table">
    <thead>
    <tr>
        <th>Danh sách khóa học</th>
        <th width="100">Số lượng</th>
        <th width="120">Giá tiền</th>
        <th width="100">Thành tiền</th>
       
    </tr>
    </thead>
    <tbody>
    <?php 
       $course_title = '';
       
       foreach($goods as $good) :
           
           $course_title .=  $good->item->title;
           $course_title .= "<br/>";
           $id = $good->model->good_id;
    ?>
        <tr >
            <td style="font-size: 17px">
               
                <?= Html::a($good->item->title, ['/course/cat', 'slug' => $good->item->slug]) ?>
                <?= $good->options ? "($good->options)" : '' ?>
            </td>
            <td  style="vertical-align: middle"><?=$good->count?></td>
            <td  style="vertical-align: middle">
                <?php if($good->discount) : ?>
                    <del class="text-muted "><small><?= $good->item->oldPrice ?></small></del>
                <?php endif; ?>
                <?= $good->price ?>
            </td>
            <td style="vertical-align: middle"><?= $good->price * $good->count ?></td>
            </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" class="text-right">
            <?php
              $info = '';
              $today = strtotime(date('Y-m-d'));
              $total = Shopcart::cost();
              if (!Yii::$app->request->post('copupon')):
                  
            ?>
             <h4>Total: <?= $total ?> VND</h4>
            <?php else:?> 
            <?php
              $couponcode = Coupon::find()
                      ->where(['user_id'=>  Yii::$app->user->id])
                      ->andwhere(['coupon_code'=>Yii::$app->request->post('copupon')])
                      ->one();
              if (count($couponcode)== 0 ){
                echo ' <h4>Total:  '.$total.' VND</h4>';  
                $info = '<span style="color:red">Mã coupon code bạn vừa nhập chưa đúng, đề nghị kiểm tra lại!</span>';  
             ?>
               
             <?php
              }
              else
              if ($today > $couponcode->end_date){
                  
                  $info = '<span style="color:red">Mã coupon code của bạn đã quá hạn sử dụng</span> ';  
                  echo ' <h4>Total:  '.$total.' VND</h4>';
              }
              else
              if($today < $couponcode->start_date){
                 echo ' <h4>Total:  '.$total.' VND</h4>'; 
                 $info =   '<span style="color:red">Mã coupon code của bạn chưa đến ngày sử dụng </span>';
              }
              else{
                $total = Shopcart::cost() - 0.2*Shopcart::cost();
                $model = yii\easyii\modules\shopcart\models\Good::findOne($id);
                $model->discount = 20;
                $model->save();
             ?>  
              <h5>Tổng cộng: <?= Shopcart::cost();?> VND</h5>
              <hr>
              <h5> Mã Coupon của bạn : <?=Yii::$app->request->post('copupon')?> (giảm 20%)</h5>
              <h4> Thành tiền : <?= $total ?> </h4>
              <?php } ?>   
            <?php endif;?>
              
              
        </td>
    </tr>
    </tbody>
</table>
                <?= Html::beginForm(Url::to(['']), 'post') ?>
             <?=$info?>
             <?= Html::textInput('copupon', '', ['placeholder' => 'Nhập mã giảm giá của bạn']) ?>
            
            <input name="Apply Coupon" type="submit" value="Áp dụng mã này" class="btn btn-small btn-default"><br/>
            
            <?= Html::endForm() ?>
    
 		</main><!-- #main -->
                 <!-- sidebar start-->
               <div class="widget-area col-xs-12 col-sm-6 pull-right" id="secondary">
                  <?php if(Yii::$app->user->id):  ?>
                  <?php
                    $profile = Profile::find()->where(['user_id'=>  Yii::$app->user->id])->one();
                  ?>
            <aside id="recent-posts-2" class="widget widget_recent_entries">			
                <ul>
					<li>
				            Thông tin của bạn 
						</li>
					<li>
				          Họ tên : <?=$profile->name ?>
                                        </li>  
					<li>
				          Email :  <?=$profile->public_email ?>
                                        </li>  
					<li>
                                          Điện thoại : <?=$profile->tel ?>  
                                        </li> 
					<li>
				          Địa chỉ : <?=$profile->location ?>
						</li>
				</ul>
                <div class="well well">
    <a href="https://www.baokim.vn/payment/product/version11?business=anhvu26%40gmail.com&user_id=<?=Yii::$app->user->id?>&order_id=<?=$good->order_id?>&product_name=<?=$course_title?>&product_price=120000&product_quantity=1&total_amount=<?= $total?> &url_cancel=&url_detail=http%3A%2F%2Flocalhost%2Fyii-logistic%2Fshop%2Fview%2Fiphone-6&url_success=http%3A%2F%2Flocalhost%2Fyii-logistic%2Fcheckout%2Fsuccess">
        <img src="http://www.baokim.vn/developers/uploads/baokim_btn/thanhtoan-l.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" ></a>
    <?php //echo  Shopcart::form(['successUrl' => Url::to('/shopcart/success')])?>
</div>
		</aside>
            
    <?php endif;?>   
             
              </div>
        <!-- sidebar #end -->
             </div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->
 </div> <!-- page-spacer #end  --> 


