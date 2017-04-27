<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;
$base = Yii::$app->getUrlManager()->getBaseUrl();
$page = Page::get('about-us');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">About Us</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb-->

<div class="page-spacer clearfix"> 
       		<div class="container">
            	<div class="row">
            		
                    
               	<div class="col-xs-12 col-sm-12">
                  
                </div> <!-- contact-form #end -->
                
              
              
            </div> <!--row #end  -->
        </div><!-- container #end -->
 </div> <!-- page-spacer #end  -->


