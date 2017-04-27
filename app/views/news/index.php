<?php
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$base = Yii::$app->getUrlManager()->getBaseUrl();
$page = Page::get('page-news');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;

?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title"><?=$page->model->title?></h1>
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
 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12">
                <?php foreach($news as $item) : ?>
    		 <div class="col-xs-12 col-sm-4">
                	<article class="events">
                         <a href="<?=$base?>/news/view/<?=$item->slug?>"><?= Html::img($item->thumb(320, 210)) ?></a>
                        <h4><?= Html::a($item->title, ['news/view', 'slug' => $item->slug]) ?></h4>
                         <i><?=Yii::$app->formatter->asDate($item->time, 'dd-mm-YYYY')?></i><br/>
                         <p><?=$item->short?></p>
                        <a href="<?=$base?>/news/view/<?=$item->slug?>" class="more">Chi tiết<i class="lnr lnr-arrow-right"></i></a>
                    </article>
                 </div> <!-- event #end -->
                 
                <?php endforeach; ?> 
    
 		</main><!-- #main -->
             </div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->
 </div> <!-- page-spacer #end  --> 







<?= News::pages() ?>
