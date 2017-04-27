<?php
use yii\easyii\modules\news\api\News;
use yii\helpers\Url;
use yii\bootstrap\Html;

$this->title = $news->seo('title', $news->model->title);
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['news/index']];
$this->params['breadcrumbs'][] = $news->model->title;
$base = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title"><?=$news->model->title?></h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->

<div class="breadcrumb-detail-page">
	<div class="container">
    	<div class="row">
            <p><a href="/">HOME</a><i class="fa fa-angle-right"></i>
            <a href="<?=$base?>/news/">Blogs</a><i class="fa fa-angle-right"></i>    
               <?=$news->model->title?>
            </p>
        </div> <!--row #end  -->
    </div>
</div>

<div class="page-spacer clearfix"> 
 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12 col-sm-8 left-block"">
                   <h4><?= $news->seo('h1', $news->title) ?></h4> 
                   <?= $news->text ?>
                   <div class="small-muted">Views: <?= $news->views?></div>
 		</main><!-- #main -->
                 <!-- sidebar start-->
        <div class="widget-area col-xs-12 col-sm-4 pull-right" id="secondary">
              <?php if(count($news->photos)) : ?>
              <aside class="widget widget_categories">
                <h3 class="widget-title">Categories</h3>
                 <?php foreach($news->photos as $photo) : ?>
                    <?= $photo->box(100, 100) ?>
                 <?php endforeach;?>
                    <?php News::plugin() ?>
              </aside>
              <?php endif; ?>
              <aside class="widget recent_posts_widget">
                <h3 class="widget-title">Recent Posts</h3>
                <ul>
                   <?php
                   $others = News::items(['<>', 'news_id', $news->model->news_id]);
                   foreach ($others as $recent):
                   ?> 
                  <li class="clearfix"> <?= Html::img($recent->thumb(100)) ?>
                    <div class="simi-co">
                      <h5><?= Html::a($recent->title, ['news/view', 'slug' => $recent->slug]) ?></h5>
                      <p class="meta"><a href="#">News</a></p>
                    </div>
                  </li>
                  <?php endforeach;?>
                 
                </ul>
              </aside>
              <aside class="widget widget_tag_cloud">
                <h3 class="widget-title">Tags</h3>
                <div class="tagcloud">
                   <?php foreach($news->tags as $tag) : ?>
        <a href="<?= Url::to(['/news', 'tag' => $tag]) ?>" ><?= $tag ?></a>
    <?php endforeach; ?>
                </div>
              </aside>
             
            </div>
        <!-- sidebar #end -->
             </div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->
 </div> <!-- page-spacer #end  --> 




