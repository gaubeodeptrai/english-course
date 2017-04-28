<?php
use yii\easyii\modules\catalog\api\Catalog;
use yii\easyii\modules\page\api\Page;
use pjhl\multilanguage\LangHelper;
use kartik\rating\StarRating;

$page = Page::get('page-shop-search');
$base = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = $page->model->title;
$lang = LangHelper::getLanguage(Yii::$app->language)['id'];
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
               <?=Yii::t('easyii', 'Search')?>
            </p>
        </div> <!--row #end  -->
    </div>
</div>

<section class="popular-courses">
       		<div class="container">
                     <?= $this->render('_search_form', ['text' => $text]) ?>
            	<div class="row">
                   
            	<div class="course_list">
            	<h2 class="text-center head-border-default"><?=Yii::t('easyii', 'Course Search results')?></h2>
                <?php
                foreach ($items as $course):
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
                
               
                
                
                
                
                
               </div>   <!-- #course_list #end  -->
                </div> <!-- row #end -->
            </div><!-- #container #end  -->
       </section><!-- #popular-courses #end  -->





