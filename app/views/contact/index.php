<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;
$base = Yii::$app->getUrlManager()->getBaseUrl();
$page = Page::get('page-contact');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">Liên hệ</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb-->

<div class="page-spacer clearfix"> 
       		<div class="container">
            	<div class="row">
            		
                    
               	<div class="col-xs-12 col-sm-6 contact-form">
                	<h3>Liên hệ với chúng tôi</h3>
					<p>Bạn có thể đặt câu hỏi tại đây. Chúng tôi sẽ phản hồi với bạn sớm nhất</p>
                   <div id="success" class="alert alert-success">Your message succesfully sent!</div>
  					<div id="error" class="alert alert-danger">Opps! There is something wrong. Please try again</div>
                  <?php if(Yii::$app->request->get(Feedback::SENT_VAR)) : ?>
            <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Đã gửi thành công</h4>
        <?php else : ?>
            <div class="well well-sm">
                <?= Feedback::form() ?>
            </div>
        <?php endif; ?>
                </div> <!-- contact-form #end -->
                
                
                 <!-- right col #startt -->
                 <div class="col-xs-12 col-sm-6 contact-info">
                 	 
                    
                    <div class="col-xs-12 col-sm-12">
                 		<h3 class="head-border-default">Hỗ trợ học viên</h3>
                        <p class="phone"><i class="fa fa-phone"></i>731-234-5678</p>
                        <p class="email"><i class="lnr lnr-envelope"></i>support@eductionpress,com</p>
                 	</div>
                    
                    <div class="col-xs-12 col-sm-12 have-question">
                    	<h3>Bạn có thắc mắc?</h3>
                        <p>Có thể bạn chưa hiểu cách thức thanh toán hoặc chưa biết cách học online hiệu quả?</p>
                        <a href="<?=$base?>/faq" class="btn btn-blue btn-medium">Xem phần hỏi/đáp</a>
                    </div>
                    
                    
                 </div> <!-- right col #end -->
                
                
              
            </div> <!--row #end  -->
        </div><!-- container #end -->
 </div> <!-- page-spacer #end  -->


