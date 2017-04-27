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
            <h1 class="entry-title">Thanh toán thành công</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb-->

<div class="page-spacer clearfix"> 
       		<div class="container">
            	<div class="row">
            		
                    
               	<div class="col-xs-12 col-sm-12">
                  <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Bạn đã thanh toán thành công</h4>
                </div> <!-- contact-form #end -->
                
              
              
            </div> <!--row #end  -->
        </div><!-- container #end -->
 </div> <!-- page-spacer #end  -->


