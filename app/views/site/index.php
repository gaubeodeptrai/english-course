<?php
//use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
//use yii\easyii\modules\gallery\api\Gallery;
//use yii\easyii\modules\guestbook\api\Guestbook;
//use yii\easyii\modules\news\api\News;
use yii\helpers\Url;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\helpers\Html;
use pjhl\multilanguage\LangHelper;
use kartik\rating\StarRating;

$page = Page::get('page-index');
$base = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = $page->seo('title', $page->model->title);
$lang = LangHelper::getLanguage(Yii::$app->language)['id'];

?>
<!-- flexslider start -->

<div class="flexslider">
    <ul class="slides">
        <?php
          $sliders = \yii\easyii\modules\carousel\models\Carousel::find()->where('status = 1')->all();
          foreach ($sliders as $slider):
        ?>
        <!-- #item start -->
        <li style="background:url(<?=$base?><?=$slider->image?>) no-repeat left top; background-size:cover;">
            <div class="container">
                <div class="row">
                    <div class="slide-caption" > 
                        <h2 data-animation="animated bounceInLeft" class=""> <?=$slider->title?></h2>
                        <p data-animation="animated bounceInUp" class=""><?=$slider->text?> </p>
                        <a href="#" data-animation="animated zoomInUp" class="btn btn-medium btn-default">View Courses <i class="lnr lnr-arrow-right"></i></a> </div>
                </div>
            </div>
        </li>
        <!-- #item end -->
       <?php endforeach;?>
    </ul>
    <ol class="flex-control-nav flex-control-paging">
        <li><a href="#" class="flex-active">1</a></li>
        <li><a href="#">2</a></li>
    </ol>
    <ul class="flex-direction-nav">
        <li class="flex-nav-prev"><a href="#" class="flex-prev">Previous</a></li>
        <li class="flex-nav-next"><a href="#" class="flex-next">Next</a></li>
    </ul>
</div>
<!-- flexslider start #end -->
<!-- #search-form #start  -->
        <section class="search-form">
   		<div class="container">
        	<div class="row">
        	<h2 class="text-center"><?=Yii::t('easyii', 'What do you want to learn today')?></h2>
           <?= Html::beginForm(Url::to(['/course/search']), 'get') ?>
                <fieldset>
                    <div class="input-group">
                        <input type="text" name="text" style="height: 51px" id="search" placeholder="<?=Yii::t('easyii', 'Enter keywors to find courses you like')?>" value="" class="form-control">
                        <br/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-orange btn-medium"><i class="lnr lnr-magnifier"></i><?=Yii::t('easyii', 'Search')?></button>
                        </span>
                    </div>
                </fieldset>
            <?= Html::endForm() ?><!-- #search-form #end  -->
            
            
            <div class="courses-count">
            	<div class="col-sm-7 col-md-3 wow bounceInLeft"><h3><i class="lnr lnr-graduation-hat"></i> Over 5 Million Students Enrolled</h3> </div>
				<div class="col-sm-7 col-md-3 wow bounceInDown"><h3><i class="lnr lnr-book"></i> More than 25,000 Online Available Courses</h3></div>
				<div class="col-sm-7 col-md-3 wow bounceInUp"><h3><i class="lnr lnr-laptop-phone"></i>Learn skills on any Devices anytime</h3></div>
				<div class="col-sm-7 col-md-3 wow bounceInRight"><h3><i class="lnr lnr-users"></i> More than 5,000 Instructors Registered</h3></div>
            </div>
            </div> <!-- row #end -->
 		</div><!-- #container #end -->
       </section><!-- #search-form #end  -->
       
       <!-- #popular-courses #star  -->
       <section class="popular-courses">
       		<div class="container">
            	<div class="row">
            	<div class="course_list">
            	<h2 class="text-center head-border-default"><?=Yii::t('easyii', 'Most Popular Online Courses')?></h2>
                <?php
                foreach ($allcourses as $course):
                  if ($lang == 2){
                         $title = $course->title;  
                         $short_description = $course->short_description;
                         $description = $course->description;
                         $logan_g = $course->logan_g;
                       }else{
                          $title = $course->title_en; 
                          $short_description = $course->short_description_en;
                          $description = $course->description_en;
                          $logan_g = $course->logan_g_en;
                       }  
                
                ?>
                <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="<?=$base?>/course/cat/<?=$course->slug?>" class="img-thumb ">
                    <figure>
                        <img src="<?=$base?><?=$course->image?> " alt="<?=$title?>">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">
                        <?php if ($course->type == 'free'):?>
                          Free<span></span>
                        <?php else:?>
                        <?= number_format($course->price, 0, ',','.').' VNĐ';?><span></span>
                        <?php endif;?>
                    </div>
                    <h3><a href="<?=$base?>/course/cat/<?=$course->slug?>"><?=$title?></a></h3>
                    <p class="meta">by: <a href="#">Logan G</a></p>
                    <p><?=$short_description?></p>
                    
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
                                      
                                      
                                   ] 
                                ]);
                         ?> 
                        </div>
                        
                        <!--<p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>-->
                    </div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                <?php
                endforeach;
                ?>
                
               
                
                
                <div class="btn-group text-center col-xs-12">
                <a href="#" class="btn btn-orange btn-medium"><?=Yii::t('easyii', 'Browse all Courses')?> <i class="lnr lnr-arrow-right"></i></a>
                </div>
                
                
               </div>   <!-- #course_list #end  -->
                </div> <!-- row #end -->
            </div><!-- #container #end  -->
       </section><!-- #popular-courses #end  -->
       
       <section class="why-choose-us text-center parallax">
       		<div class="layer"> 
        			<div class="container">
                	<div class="row">
                    		<div class="div_hr div_hr1 wow pulse"><span class="alignleft"></span><span class="alignright"></span></div>
                            <div class="div_hr div_hr2 wow pulse"><span class="alignleft"></span><span class="alignright"></span></div>
                    	<h2 class="text-center head-border-default"> <?=Yii::t('easyii', 'Why should you choose')?> Tieng Anh Giao Tiep</h2> 
                        
                         <div class="col-xs-12 col-sm-4 wow bounceInLeft">
                         	<i class="lnr lnr-rocket"></i>
                         	<h3><?=Yii::t('easyii', 'Effective evident after each course')?> </h3>
                          
                         </div>
                         
                         <div class="col-xs-12 col-sm-4 wow bounceInUp">
                         	<i class="lnr lnr-laptop-phone"></i>
                         	<h3><?=Yii::t('easyii', 'Learn on any Device')?></h3>
                           
                         </div>
                         
                         
                         <div class="col-xs-12 col-sm-4 wow bounceInRight">
                         	<i class="lnr lnr-license"></i>
                         	<h3><?=Yii::t('easyii', 'The famous teacher and many years of experience')?></h3>
                           
                         </div>
                        
                        
				 
	
                    </div>  <!-- row #end  -->
                </div> <!-- container #end  -->
              </div> <!-- layer #end  -->
        </section> 
       
      
        
       <section class="multi-widget-options">
    	<div class="container">
        	<div class="row">
                  <h3 class="text-center head-border-orange">Thông tin & sự kiện</h3>
               
                
                <?php
                $news = \yii\easyii\modules\news\models\News::find()
                        ->where('status = 1')
                        ->andWhere(['lang_id'=>$lang])
                        ->orderBy(['time'=>SORT_DESC])
                        ->limit(3)
                        ->all();
                  foreach ($news as $blog):
                       
                 
                ?>
                
                <div class="col-xs-12 col-sm-4">

                    <a href="<?=$base?>/news/view/<?=$blog->slug?>"><img src="<?=$base?><?=$blog->image?>" alt=""></a>
                        <h5> <?= Html::a($blog->title, ['news/view', 'slug' => $blog->slug]) ?></h5>
                        <i><?=Yii::$app->formatter->asDate($blog->time, 'dd-mm-YYYY')?></i>
                        <p><?=$blog->short?></p>
                        <a href="#" class="more">Read More <i class="lnr lnr-arrow-right"></i></a>
                  
                </div> <!-- col 3 #end -->
                <?php
                 endforeach;
                ?>
            </div><!-- /row  #end -->
        </div><!-- /container  #end -->
    </section> 
       <video controls width="400" 
       autoplay loop muted
       poster="poster.png">
  <source src="<?=$base?>/uploads/videos/oceans.mp4" type="video/mp4">
  <source src="rabbit320.webm" type="video/webm">
  <p>Your browser doesn't support HTML5 video. Here is a <a href="rabbit320.mp4">link to the video</a> instead.</p>
</video>
       


