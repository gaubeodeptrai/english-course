<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;

$this->title = $cat->seo('title', $cat->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Course', 'url' => ['course/index']];
$this->params['breadcrumbs'][] = $cat->model->title;
$base = Yii::$app->getUrlManager()->getBaseUrl();
$lang = Yii::$app->language;

if ($lang == 'vi'){
 $title = $cat->model->title;  
 $short_description = $cat->model->short_description;
 $description = $cat->model->description;
 $logan_g = $cat->model->logan_g;
}else{
  $title = $cat->model->title_en; 
  $short_description = $cat->model->short_description_en;
  $logan_g = $cat->model->logan_g_en;
  $description = $cat->model->description_en;
}
?>
<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title"><?=$title?></h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->


<div class="breadcrumb-detail-page">
	<div class="container">
    	<div class="row">
            <p>
                <a href="/">HOME</a><i class="fa fa-angle-right"></i>
                <?php if ($cat->model->type == 'premium'): ?>
                  <a href="<?=$base?>/course/index"><?=Yii::t('easyii', 'Premium Course')?></a><i class="fa fa-angle-right"></i>
                <?php else :?>
                  <a href="<?=$base?>/course/free"><?=Yii::t('easyii', 'Free Course')?></a><i class="fa fa-angle-right"></i>
                <?php endif;?>  
                 <?=$title?>
            </p>
        </div> <!--row #end  -->
    </div>
</div>

<div class="page-spacer co-detail-page clearfix"> 
 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12 col-sm-8 left-block">
                	
                     <div class="courses-info">
                     	<h1><?=$title;?></h1>
                        <p class="excerpt"><?=$short_description?></p>
                        
                         <p class="meta">Logan G : <?=$logan_g;?></p>
                     </div><!--courses-info #end  -->
                	
                    
                   
                    <div class="courses-info">
                    	<h3><?=Yii::t('easyii', 'Course Description')?></h3>
                        <?=$description;?>
                        
                <!-- courses-curriculum #start -->    
               <section class="courses-curriculum clearfix">
                   <h3><?=Yii::t('easyii', 'Course Content')?></h3>
               <?php
                $cats = \app\modules\courses\models\Category::find()
                ->where(['tree'=>$cat->model->category_id])
                ->andWhere('category_id <>'.$cat->model->category_id)
                ->all();
                if (count($cats)):
                foreach ($cats as $cat_sub):
                $items = app\modules\courses\models\Item::find()->where(['category_id'=>$cat_sub->category_id])->all();
               ?>  
                 <h4><?=$cat_sub->title?></h4>
                 <ul>
                    <?php  
                        foreach ($items as $item ): 
                          $path_info = pathinfo($item->video); 
                          $ext = $path_info['extension'];
                          if ($ext == 'mp4'|| $ext == 'mkv'||$ext == 'ts'){
                              $icon = '<i class="fa fa-play-circle"></i>';
                              $type = 'Video file';
                          }
                          else
                           if ($ext == 'pdf'|| $ext == 'doc'||$ext == 'docx'){
                              $icon = '<i class="fa fa-paperclip"></i>';
                              $type = 'PDF file';
                           }      
                       
                    ?>
                      <li class="courses-open">
                        <p class="ctitle"> 
                           <span class="title"><?=$icon?>  
                             <?=Html::a($item->title, ['/course/view', 'slug' => $item->slug,'close'=>$cat_sub->category_id])?>
                           </span>    
                          
                           <p class="other">
                            <span class="time"><i class="fa fa-clock-o"></i> 11:30</span> 
                            <span class="info"> <?=$type?></span>
                           </p> 
                        </p>    
                      </li>   
                    <?php endforeach; ?>
                 </ul>
        <?php    
        endforeach;
        ?>
          <?php    
        else :
          echo "Course is empty";
        endif;    
        ?>        
        </section>
                 <!-- courses-curriculum #end -->
           
                   
            </div> <!--courses-info #end  -->
                    
       
     <div class="courses-info clearfix">
        <div class="">
            <?php if (count($comments) > 0) :?>
            <h3><?=Yii::t('easyii', 'Review')?></h3>
            
             <ul class="review-list">
        	
             <?php foreach (app\modules\comment\api\Guestbook::items(['pagination' => ['pageSize' => 10]],$cat->model->category_id) as $comment): ?> 
             
             <li>
            	<img src="<?=$base?>/images/person-solid.png" width="50px" class="avatar" alt="">
            	<div class="review-right col-xs-12 col-sm-9">
                	<span class="author-name"><?=$comment->name?></span>
                     <div class="time">
                    <?=Yii::$app->formatter->asDatetime($comment->time,"php:d-m-Y  H:i:s");?>
                        <div class="course_rating">
                           <?php
                               echo StarRating::widget([
                                  'name' => 'rating_2',
                                  'value' => $comment->rating,
                                  'disabled' => true,
                                   'language' => 'ru',
                                  'pluginOptions' => [
                                      'displayOnly' => true,
                                      'size' => 'l',
                                      'theme' => 'Glyphicons Halflings',
                                      'filledStar' => '<i class="glyphicons glyphicon-star"></i>',
                                     
                                      
                                   ] 
                                ]);
                            ?>
                         </div>
                    </div>
                </div> <!-- review-right #end -->
                 <div class="review-des">
                	<p><?=$comment->title?></p>
                    <p><?=$comment->text?></p>
                </div><!-- review-des #end -->
             </li>
             <?php endforeach;?>
        </ul>
           <?php endif;?> 
            <?= app\modules\comment\api\Guestbook::pages() ?>
        </div> <!-- courses review #end  #end -->    
        
        
        
        
        
        <div class="">
        	<h3><?=Yii::t('easyii', 'Add a review')?></h3>
            <div class="row">
              <div class="review_form">
                <div class="review-right col-xs-12 col-sm-9">  
                    <?php if(Yii::$app->request->get(app\modules\comment\api\Guestbook::SENT_VAR)) : ?> 
                       <h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Gửi thành công</h4>
                    <?php endif;?>   
                   <?= app\modules\comment\api\Guestbook::form([],$cat->model->category_id)?>     
                </div>   
             </div> 
                
               
            </div>
        </div>
      </div> <!-- course info #end-->
                      
 </main><!-- #main -->
                
                
             <!-- sidebar start-->
            <div id="secondary" class="widget-area col-xs-12 col-sm-4 left-block" role="complementary">
                <div class="co-join-info">
                    <?php if ($cat->model->type == 'premium'): ?>  
                       <p class="co-price"><?=Yii::t('easyii', 'Price')?>:  <span><?= number_format($cat->model->price, 0, ',','.').' VNĐ';?></span></p>
                     <?php else: ?>
                       <p class="co-price"></p>
                     <?php endif;?>     
                    <div class="btns">
                      <?php if ($cat->model->type == 'premium'): ?>  
                        <?php if ($paid > 0 ):?>
                          
                        <button class="btn btn-orange"><?=Yii::t('easyii', 'You have this course')?></button>
                        <?php else:?>
                          <?= Html::a(Yii::t('easyii', 'Buy this course'), ['checkout/add', 'id' => $cat->model->category_id], ['class' => 'btn btn-orange']) ?> 
                        <?php endif;?>
                     <?php else: ?>
                        <?= Html::button(Yii::t('easyii', 'Free Course'), ['#'], ['class' => 'btn btn-orange']) ?>
                     <?php endif;?>   
                        
                    </div>
                    
                    
                    <div class="course_rat">
                    <div class="course_rating col-xs-12 col-sm-6 pull-left">
                       <?php
                          //$rating = array();
                       if (count($comments) == 0){
                           $avarage =0;
                       }else{
                          foreach ($comments as $rate):
                              $rating[] = $rate->rating;
                          endforeach;
                          //print_r($rating);
                          $avarage = array_sum($rating)/count($rating);
                       }   
                          echo StarRating::widget([
                                  'name' => 'rating_2',
                                  'value' => $avarage,
                                  'disabled' => true,
                                   
                                  'pluginOptions' => [
                                      'displayOnly' => FALSE,
                                      'size' => 'l',
                                      'theme' => 'Glyphicons Halflings',
                                      'filledStar' => '<i class="glyphicons glyphicon-star"></i>',
                                      //'emptyStar' => '<span class="glyphicon glyphicon-star-empty"></span>',  
                                   ] 
                                ]);
                       ?>
                     </div>
                     <?php if ($cat->model->type == 'premium'): ?> 
                        <p class="enroll col-xs-12 col-sm-6"><?=$count_person?> <?=Yii::t('easyii', 'Enrolled')?> </p>
                     <?php endif;?>   
                    </div> <!-- course rat #end -->
                    
                    <!--<ul>
                        <li><span>Lectures:</span> 10 </li>
                        <li><span>Language:</span> English </li>
                        <li><span>Video:</span> 12 hours </li>
                        <li><span>Duration:</span> 30 days </li>
                        <li><span>Includes:</span> Certificate of Completion </li>
                        <li><span> </span>More includes here</li>
                    </ul>-->
                     
                </div><!-- co-join-info #end -->
                
                
                <aside class="widget widget_courses">
                <h3 class="widget-title"><?=Yii::t('easyii', 'Similar Courses')?></h3>
                <ul>
                  <?php
                   //$rating1[] = 0;  
                  foreach ($courses as $course):?>  
                  <li class="clearfix">
                    <div class="course-thumbnail">
                    <img src="<?=$base?><?=$course->image?>" class="course-media-img" alt="">
                    </div>
                    <div class="simi-co">
                      <h5><a href="<?=$base?>/course/cat/<?=$course->slug?>"><?=$course->title?></a></h5>
                     <?php if ($course->type == 'premium'): ?>  
                        <p><span class="simi-price"><?= number_format($course->price, 0, ',','.').' VNĐ';?></span>
                     <?php else:?>
                        <p><span class="simi-price">free</span>  
                     <?php endif;?>     
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
</div> <!-- page-spacer #end  --> 	     
    










