<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\guestbook\api\Guestbook;
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\helpers\Html;
use pjhl\multilanguage\LangHelper;

$page = Page::get('page-index');
$base = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = $page->seo('title', $page->model->title);
$lang = LangHelper::getLanguage(Yii::$app->language)['id'];
?>
<!-- flexslider start -->
<div class="flexslider">
    <ul class="slides">
        <!-- #item start -->
        <li style="background:url(<?=$base?>/images/use_img/banner_img1.jpg) no-repeat left top; background-size:cover;">
            <div class="container">
                <div class="row">
                    <div class="slide-caption"> <span data-animation="animated bounceInDown" class="btn btn-bg">One Stop Solution for</span>
                        <h2 data-animation="animated bounceInLeft" class=""> Education Needs Complete Solution </h2>
                        <p data-animation="animated bounceInUp" class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                            dictum sapien in augue consequat. </p>
                        <a href="#" data-animation="animated zoomInUp" class="btn btn-medium btn-default">View Courses <i class="lnr lnr-arrow-right"></i></a> </div>
                </div>
            </div>
        </li>
        <!-- #item end -->
        <!-- #item start -->
        <li style="background:url(<?=$base?>/images/use_img/banner_img2.jpg) no-repeat left top; background-size:cover;">
            <div class="container">
                <div class="row">
                    <div class="slide-caption"> <span data-animation="animated bounceInDown" class="btn btn-bg">E Learning Solution</span>
                        <h2 data-animation="animated bounceInLeft"> Complete Solution For You Education Needs </h2>
                        <p data-animation="animated bounceInUp">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                            dictum sapien in augue consequat. </p>
                        <a href="#" data-animation="animated zoomInUp" class="btn btn-medium btn-default">View Courses <i class="lnr lnr-arrow-right"></i></a> </div>
                </div>
            </div>
        </li>
        <!-- #item end -->
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
        	<h2 class="text-center">Emerge yourself by learning new Skills</h2>
            <form action="#" method="get" class="form-inline">
                <fieldset>
                    <div class="input-group">
                        <input type="text" name="s" id="search" placeholder="What do you want to learn today" value="" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-orange btn-medium"><i class="lnr lnr-magnifier"></i> Search</button>
                        </span>
                    </div>
                </fieldset>
            </form><!-- #search-form #end  -->
            
            
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
            	<h2 class="text-center head-border-default">Most Popular Online Courses</h2>
                
                <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img1.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                
                
                 <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img2.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                
                
                 <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img3.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                
                
                
                 <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img4.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                
                
                 <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img5.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course #end -->
                    </div>  <!--course space #end -->
                </div> <!-- col course #end -->
                
                
                 <!-- course start-->
                <div class="col-xs-12 col-sm-4 zoom">
                	<div class="course">
                	<a href="#" class="img-thumb ">
                    <figure>
                    <img src="images\use_img\course_img6.png" alt="">
                    </figure>
                    </a>
                                      
                    <div class="course_space">
                    <div class="price">$18<span></span></div>
                    <h3><a href="#">Photoshop CC 2015</a></h3>
                    <p class="meta">by: <a href="#">Greg Christman</a> . in: <a href="#">Icon Design</a></p>
                    <p>Maecenas cursus mauris libero, a imperdi dolor site amet enim pellentesque id. Aliquam erat volutpat.</p>
                    
                    <div class="course_rel">
                    	<div class="course_rating col-xs-12 col-sm-6">
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
                         <i class="glyphicons glyphicon-star"></i>
		                </div>
                        
                        <p class="enroll col-xs-12 col-sm-6">18.4K Enrolled</p>
                    	</div>
                	</div> <!--course space #end -->
                    </div>  <!--course  #end -->
                </div> <!-- col course #end -->
                
                
                <div class="btn-group text-center col-xs-12">
                <a href="#" class="btn btn-orange btn-medium">Browse all Courses <i class="lnr lnr-arrow-right"></i></a>
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
                    	<h2 class="text-center head-border-default">Why should you choose Tieng Anh Giao Tiep</h2> 
                        
                         <div class="col-xs-12 col-sm-4 wow bounceInLeft">
                         	<i class="lnr lnr-rocket"></i>
                         	<h3>Superfast Support</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing  <br>
                            and typesetting industry. When an unknown  <br>
                            printer took a galley of type.</p>
                         </div>
                         
                         <div class="col-xs-12 col-sm-4 wow bounceInUp">
                         	<i class="lnr lnr-laptop-phone"></i>
                         	<h3>Learn on any Device</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing  <br>
                            and typesetting industry. When an unknown  <br>
                            printer took a galley of type.</p>
                         </div>
                         
                         
                         <div class="col-xs-12 col-sm-4 wow bounceInRight">
                         	<i class="lnr lnr-license"></i>
                         	<h3>Certification Courses</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing  <br>
                            and typesetting industry. When an unknown  <br>
                            printer took a galley of type.</p>
                         </div>
                        
                        
				 <div class="btn-group col-xs-12">
               
                <a href="#" class="btn btn-default">Take a Tour</a>
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
       
       


