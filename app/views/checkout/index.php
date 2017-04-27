<?php
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\couponcode\models\Coupon;
$base = Yii::$app->getUrlManager()->getBaseUrl();
$page = Page::get('page-shopcart');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">Giỏ hàng</h1>
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
             <h3 style="font-size: 20px">Nội dung giỏ hàng</h3>
            
<table class="table">
    <thead>
    <tr>
        <th>Danh sách khóa học</th>
        <th width="100">Số lượng</th>
        <th width="120">Giá tiền</th>
        <th width="100">Thành tiền</th>
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
        <tr >
            <td style="font-size: 17px">
                <?= Html::img($good->item->thumb(100)) ?><span style="padding-left: 10px"></span>
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
            <th  style="vertical-align: middle"><?= Html::a('<i class="glyphicon glyphicon-trash text-danger"></i>', ['/checkout/remove', 'id' => $good->id], ['title' => 'Remove item']) ?></th>
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
             
       
    </div> <!-- col 1 #end -->

     <div class="col-xs-12 col-sm-3 cart-total">
         <h3 style="font-size: 20px">Hóa đơn của bạn</h3>
            <h5> Thành tiền : <?= $total ?> </h5> 
            <a href="<?=$base?>/checkout/payment">
               <button class="btn btn-orange btn-medium">Tiến hành thanh toán<i class="lnr lnr-arrow-right"></i></button>  
            </a>
    </div> <!-- col 2 #end -->

    </div>
         <?php else : ?>
          <p>Shopping cart is empty</p>
         <?php endif; ?>  
        </div> <!--row #end  -->
    </div><!-- container #end -->
 </div> 



