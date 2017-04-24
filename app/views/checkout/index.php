<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\couponcode\models\Coupon;

$page = Page::get('page-shopcart');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">Shopping Cart</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->
<div class="page-spacer clearfix"> 
   <div class="container">
       <div class="row">
         <?php if(count($goods)) : ?>                        
            <div class="col-xs-12">



    <div class="col-xs-12 col-sm-9 cart-total">
            <h3>Cart Totals</h3>
            <?= Html::beginForm(['/shopcart/update'])?>
<table class="table">
    <thead>
    <tr>
        <th>List courses</th>
        <th width="100">Quantity</th>
        <th width="120">Unit Price</th>
        <th width="100">Total</th>
        <th width="30"></th>
    </tr>
    </thead>
    <tbody>
    <?php 
       $course_title = '';
       foreach($goods as $good) :
           $course_title .=  $good->item->title;
           $course_title .= "<br/>";
    ?>
        <tr>
            <td>
                <?= Html::a($good->item->title, ['/course/cat', 'slug' => $good->item->slug]) ?>
                <?= $good->options ? "($good->options)" : '' ?>
            </td>
            <td><?=$good->count?></td>
            <td>
                <?php if($good->discount) : ?>
                    <del class="text-muted "><small><?= $good->item->oldPrice ?></small></del>
                <?php endif; ?>
                <?= $good->price ?>
            </td>
            <td><?= $good->price * $good->count ?></td>
            <th><?= Html::a('<i class="glyphicon glyphicon-trash text-danger"></i>', ['/checkout/remove', 'id' => $good->id], ['title' => 'Remove item']) ?></th>
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
    
<?= Html::endForm()?>
           
            <?= Html::beginForm(Url::to(['']), 'post') ?>
             
             <?= Html::textInput('copupon', '', ['placeholder' => 'Nhập mã giảm giá của bạn']) ?>
       
            <input name="Apply Coupon" type="submit" value="Áp dụng mã này" class="btn btn-medium btn-default"><br/>
            <?=$info?>
            <?= Html::endForm() ?>
    </div> <!-- col 1 #end -->

     <div class="col-xs-12 col-sm-3 cart-total">
            <h3>Thanh toán</h3>
<div class="well well">
    <a href="https://www.baokim.vn/payment/product/version11?business=anhvu26%40gmail.com&user_id=<?=Yii::$app->user->id?>&order_id=<?=$good->order_id?>&product_name=<?=$course_title?>&product_price=120000&product_quantity=1&total_amount=<?= $total?> &url_cancel=&url_detail=http%3A%2F%2Flocalhost%2Fyii-logistic%2Fshop%2Fview%2Fiphone-6&url_success=http%3A%2F%2Flocalhost%2Fyii-logistic%2Fcheckout%2Fsuccess">
        <img src="http://www.baokim.vn/developers/uploads/baokim_btn/thanhtoan-l.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" ></a>
    <?php //echo  Shopcart::form(['successUrl' => Url::to('/shopcart/success')])?>
</div>

    </div> <!-- col 2 #end -->

    </div>
         <?php else : ?>
          <p>Shopping cart is empty</p>
         <?php endif; ?>  
        </div> <!--row #end  -->
    </div><!-- container #end -->
 </div> 



