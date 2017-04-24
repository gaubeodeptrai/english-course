<?php
use yii\easyii\modules\faq\api\Faq;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-faq');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title">Frequently Asked Questions</h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->

<div class="breadcrumb-detail-page">
	<div class="container">
    	<div class="row">
            <p><a href="/">HOME</a><i class="fa fa-angle-right"></i>
               <?=$page->model->title?>
            </p>
        </div> <!--row #end  -->
    </div>
</div>

<div class="page-spacer clearfix">
	<div id="primary" class="content-area">
       <div class="container">
        	<div class="row">

			<main id="main" class="site-main col-xs-12">
              	
             <div class="col-xs-12 col-sm-8">
                <?php foreach(Faq::items() as $item) : ?>
                 <p><b>Question: </b><?= $item->question ?></p>
                 <blockquote><b>Answer: </b><?= $item->answer ?></blockquote>
                <?php endforeach; ?>
             
             </div> <!-- col1 #end -->
             <div class="col-xs-12 col-sm-4">
                 
             </div>
             
             

				</main><!-- #main -->
			</div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->
</div><!-- page-spacer --> 
