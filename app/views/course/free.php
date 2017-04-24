<?php
use yii\easyii\modules\catalog\api\Catalog;
use yii\easyii\modules\file\api\File;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use kartik\rating\StarRating;
$page = Page::get('free-courses');
$base = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = $page->seo('title', $page->model->title);
//$this->params['breadcrumbs'][] = $page->model->title;

function renderNode($node){
    if(!count($node->children)){
        $html = '<li>'.Html::a($node->title, ['/course/cat', 'slug' => $node->slug]).'</li>';
    } else {
        $html = '<li>'.Html::a($node->title, ['/course/cat', 'slug' => $node->slug]).'</li>';
       // $html .= '<ul>';
       // foreach($node->children as $child) $html .= renderNode($child);
       // $html .= '</ul>';
    }
    return $html;
}
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

 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12 col-sm-8 left-block">
                
          <div class="well well-sm row">
         		
                
         
                 <div class="btn-group">
                    <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                    </span></a> <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span></a>
                </div>
            </div>
                
     <div id="products" class="list-group"> 
     		<div class="row">  
                   <?php
                   foreach ($courses as $course):
                   ?> 
                    
                  <div class="col-xs-12 col-sm-6 zoom courses">
                	<div class="course clist">
                    <a class="img-thumb " href="<?=$base?>/course/cat/<?=$course->slug?>">
                      <figure>
                        <img alt="<?=$course->title?>" src="<?=$base?><?=$course->image?>" width="360px">
                      </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">Free<span></span></div>
                    <h3><a href="<?=$base?>/course/cat/<?=$course->slug?>"><?=$course->title?></a></h3>
                    <p class="meta">by: <a href="#">Logan G</a></p>
                    <p><?=$course->short_description?></p>
                    
                    
                	</div> <!--course #end -->
                    	
                        <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                            <?php 
                           
                            $comments1 = app\modules\comment\models\Guestbook::find()->where(['course_id'=>$course->category_id])->all();
                            if (count($comments1) == 0){
                                $avarage = 0;
                            }else{
                            foreach ($comments1 as $rate):
                              $rating1[] = $rate->rating;
                            endforeach;
                            //echo array_sum($rating1); echo"<br/>";echo count($rating1);
                            //print_r($rating1);
                            $avarage = array_sum($rating1)/count($rating1);
                            }
                            echo StarRating::widget([
                                  'name' => 'rating_2',
                                  'value' => $avarage,
                                  'disabled' => true,
                                   
                                  'pluginOptions' => [
                                      'displayOnly' => true,
                                      'size' => 'l',
                                      'theme' => 'Glyphicons Halflings',
                                      'filledStar' => '<i class="glyphicons glyphicon-star"></i>',
                                      'emptyStar' =>  '<span class="glyphicon glyphicon-star-empty"></span>',
                                      
                                   ] 
                                ]);
                         ?> 
                        </div>
                        
                        
                    	</div>
                    
                    </div>  <!--course space #end -->
                </div> <!-- course #end -->
                  <?php
                    endforeach;
                  ?> 
                
                
                
                
                
              
            <!--<div class="pagination">
            <span class="page-numbers current">1</span>
            <a href="#" class="page-numbers">2</a>
            <a href="#" class="page-numbers">3</a>
            <a href="#" class="next page-numbers"><i class="fa fa-angle-right"></i></a>
            </div>-->
     
        </div> <!-- row #end -->
     </div> <!-- product list #end -->               
                     
</main><!-- #main -->
                
                
                
    <!-- sidebar start-->
    <div class="widget-area col-xs-12 col-sm-4 pull-right" id="secondary">
      <aside class="widget widget_search">
        <h3 class="widget-title">Search Course</h3>
        <form action="#" class="search-form search-course">
            <input type="search" title="What do you want to learn today?" name="s" value="" placeholder="What do you want to learn today?" class="search-field">
          <button type="submit" class="btn btn-orange btn-medium course-submit"> <i class="lnr lnr-magnifier"></i> </button>
        </form>
      </aside>
      
     
      
    
      <aside class="widget widget_courses">
        <h3 class="widget-title">Free Courses</h3>
        <ul>
          <?php foreach ($premium_courses as $course):?>  
          <li class="clearfix">
            <div class="course-thumbnail">
            <img alt="" class="course-media-img" src="<?=$base?><?=$course->image?>">
            </div>
            <div class="simi-co">
              <h5><a href="<?=$base?>/course/cat/<?=$course->slug?>"><?=$course->title?></a></h5>
             
              <p><span class="simi-price"><?= number_format($course->price, 0, ',','.').' VNĐ';?></span> 
              <span class="rating">
                  <?php 
                           
                            $comments1 = app\modules\comment\models\Guestbook::find()->where(['course_id'=>$course->category_id])->all();
                            if (count($comments1) == 0){
                                $avarage = 0;
                            }else{
                            foreach ($comments1 as $rate):
                              $rating1[] = $rate->rating;
                            endforeach;
                            //echo array_sum($rating1); echo"<br/>";echo count($rating1);
                            //print_r($rating1);
                            $avarage = array_sum($rating1)/count($rating1);
                            }
                            echo StarRating::widget([
                                  'name' => 'rating_2',
                                  'value' => $avarage,
                                  'disabled' => true,
                                   
                                  'pluginOptions' => [
                                      'displayOnly' => true,
                                      'size' => 'l',
                                      'theme' => 'Glyphicons Halflings',
                                      'filledStar' => '<i class="glyphicons glyphicon-star"></i>',
                                      'emptyStar' =>  '<span class="glyphicon glyphicon-star-empty"></span>',
                                      
                                   ] 
                                ]);
                         ?> 
              </span>
              </p>
            </div>
          </li>
          <?php endforeach;?>
         
        </ul>
      </aside>
      
     </div>
    <!-- sidebar #end -->
                
                
             </div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->







