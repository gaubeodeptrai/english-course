<?php
use yii\easyii\modules\shopcart\api\Shopcart;
use yii\easyii\modules\subscribe\api\Subscribe;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use richardfan\widget\JSRegister;
use yii\bootstrap\Html;
use pjhl\multilanguage\assets\ChangeLanguageAsset; 
use pjhl\multilanguage\LangHelper;
use yii\widgets\Menu;
use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\widgets\ActiveForm;
use dektrium\user\models\RegistrationForm;
use yii\easyii\modules\text\api\Text;

$base = Yii::$app->getUrlManager()->getBaseUrl();
ChangeLanguageAsset::register($this);
$goodsCount = count(Shopcart::goods());
$lang = LangHelper::getLanguage(Yii::$app->language)['id'];
$langs = Yii::$app->params['languages'];

?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>


    <!-- header -->
    <header class="site-header" id="masthead">

        <!-- header_meta #start -->
        <div class="header_meta">
            <div class="container">
                <div class="row">
                   <?php if (!\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile() ):?>
                    <p class="site-description col-xs-12 col-sm-6">
                        <a href="#" class="multilanguage-set" data-language="2"><img src="http://clara.com.vn/image/vietnam.gif" width="30px"></a>
                        <a href="#" class="multilanguage-set" data-language="1"><img src ="http://clara.com.vn/image/english.png" width="30px"></a>
                    </p>
                    <?php endif;?>
                    <nav class="meta-login">
                        
                        <ul>

                           
                            
                            <?php if (\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile() ):?>
                            <li><a href="#" class="multilanguage-set" data-language="2" style="padding-right: 10px"><img src="http://clara.com.vn/image/vietnam.gif" width="30px"></a>
                            <a href="#" class="multilanguage-set" data-language="1" style="padding-right: 10px"><img src ="http://clara.com.vn/image/english.png" width="30px"></a></li>
                            
                            <?php endif;?>
                            
                            <li class="call"><i class="lnr lnr-phone-handset"></i>0936.437.467</li>
                           
                            <?php
                              if (Yii::$app->user->isGuest){
                            ?>
                             <?php if (\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile()):?>
                               
                             <?php else :?>
                               <li><a href="#login-form" class="fancybox"><?=Yii::t('user', 'Login')?></a></li>
                               <li><a href="#register-form" class="fancybox"><?=Yii::t('user', 'Sign up')?></a></li>
                             <?php endif;?>
                            
                           
                            
                            
                            <?php
                              }  else {
                            ?>
                              <?php if (\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile()):?>
                               
                             <?php else :?>
                               <li><?=Html::a('Your Profile ('.Yii::$app->user->identity->username.')',['/user/settings'],['data-method'=>'post']);?></li>
                               <li><?=Html::a('Logout',['/user/security/logout'],['data-method'=>'post']);?></li>
                             <?php endif;?>  
                               
                           
                            <?php
                              } 
                            ?>
                            
                        </ul>
                    </nav>
                </div>
                <!--row #end-->
            </div>
            <!--container #end-->
        </div>
        <!-- Header Meta #end -->
        <!-- header_meta #end -->

        <div class="container">
            <div class="row">
                <!-- #site-branding #start -->
                <div class="site-branding col-xs-12 col-sm-3"> <a rel="home" href="#"> <img alt="educationpress" class="brand" src="<?=$base?>/images/logo.png"> </a> </div>
                <!-- #site-branding #end -->

                <!-- #site-navigation #start -->
                <nav class="main-navigation navbar navbar-default" id="site-navigation">
                    <div class="navbar-header">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <?php
                    if($goodsCount > 0) :
                       $count_item = $goodsCount;
                    else :
                       $count_item = 0;
                    endif; 
 $menuItems = [
    ['label' => Yii::t('easyii', 'Home'), 'url' => ['/'], 'active' => $this->context->route == 'site/index'],
    ['label' => Yii::t('easyii', 'About us'), 'url' => ['/about'], 'active' => $this->context->route == 'about/index'],
    ['label' => Yii::t('easyii', 'Free Course'), 'url' => ['/course/free'], 'active' => $this->context->route == 'course/free'],
    ['label' => Yii::t('easyii', 'Premium Course'), 'url' => ['/course'], 'active' => $this->context->route == 'course/index'],   
    ['label' => Yii::t('easyii', 'FAQ'), 'url' => ['/faq'], 'active' => $this->context->route == 'faq/index'],
    ['label' => Yii::t('easyii', 'Blogs'), 'url' => ['/news'], 'active' => $this->context->route == 'news/index'],
    ['label' => Yii::t('easyii', 'Contact'), 'url' => ['/contact'], 'active' => $this->context->route == 'contact/index'],   
      
];
                      
                      
                    ?>
                    
                    <div class="collapse navbar-collapse">
                       
                           
                      <?php
                              if (Yii::$app->user->isGuest){
                            ?>
                             <?php if (\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile()):?>
                               <ul class="nav navbar-nav">
                               <li>
                                   
                                              <a href="#login-form" class="fancybox"><?=Yii::t('user', 'Login')?></a> 
                                          
                                              <a href="#register-form" class="fancybox"><?=Yii::t('user', 'Sign up')?></a> 

                               </li>
                               
                             </ul>  
                       
                             <?php else :?>
                             
                             <?php endif;?>
                            
                           
                            
                            
                            <?php
                              }  else {
                            ?>
                              <?php if (\skeeks\yii2\mobiledetect\MobileDetect::getInstance()->isMobile()):?>
                               <ul class="nav navbar-nav"> 
                               <li>
                                  <?=Html::a('Your Profile ('.Yii::$app->user->identity->username.')',['/user/settings'],['data-method'=>'post']);?>
                                   <?=Html::a('Logout',['/user/security/logout'],['data-method'=>'post']);?>
                               </li>
                               
                              
                               
                              </ul> 
                              <hr/>
                             <?php else :?>
                              
                             <?php endif;?>  
                               
                           
                            <?php
                              } 
                            ?>      

                    <?= Menu::widget([
                        'options' => ['class' => 'nav navbar-nav'],
                        'items' => $menuItems,
                        'activateParents'=>true,
                    ]);?>
                        <ul class="nav navbar-nav">
                            <li class="pull-right">
                                <a title="Danh sách đặt mua" href="<?=$base?>/checkout" class="menu-cart">
                                    <i class="lnr lnr-cart"></i> 
                                    <span>
                                       <?=$count_item?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        
                        
                        
                    </div>
                </nav>
                <!-- #site-navigation  #end-->

            </div><!--row #end-->
        </div> <!--container #end-->
    </header>
    <!-- header #end -->

        <?php if($this->context->id != 'site') : ?>
           
           
        <?php endif; ?>
        <?= $content ?>
        <div class="push"></div>

        
  

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_text" id="text-1">
                    <h6 class="widget-title"><?=Yii::t('easyii', 'About us')?> Tieng Anh Giao Tiep</h6>
                    <div class="textwidget">
                        <p>
                            <?= Text::get('about') ?>
                        </p>
                    </div>
                </aside>
            </div>

            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget menu">
                    <h6 class="widget-title"><?=Yii::t('easyii', 'Quick Links')?></h6>
                   <?= Menu::widget([
                        
                        'items' => $menuItems,
                        'activateParents'=>true,
                    ]);?>
                </aside>

            </div>


            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_courses">
                    <h6 class="widget-title"><?=Yii::t('easyii', 'Recent Courses')?></h6> <ul>
                        <?php
                          
                          $courses = \app\modules\courses\models\Category::find()
                                  ->where(['status'=>1])
                                  ->andWhere('depth = 0')
                                  ->limit(2)
                                  ->all();  
                          foreach ($courses as $course):
                              if ($lang == 2){
                                $title = $course->title;  
                             }else{
                                $title = $course->title_en;   
                             }
                        ?>
                        
                        <li class="clearfix">
                            <img alt="" class="course-media-img" src="<?=$base?><?=$course->image?>">
                            <div class="simi-co">
                                <h5><a href="<?=$base?>/course/cat/<?=$course->slug?>"><?=$title?></a></h5>
                                
                            </div>
                        </li>
                       <?php
                   endforeach;
                       ?>
                    </ul>
                </aside>
            </div>


            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_quickcontact">
                    <h6 class="widget-title"><?=Yii::t('easyii', 'Subscribe to Newsletter')?></h6>
                    <?php if(Yii::$app->request->get(Subscribe::SENT_VAR)) : ?>
                    You have successfully subscribed
                <?php else : ?>
                    <?= Subscribe::form() ?>
                <?php endif; ?>
                </aside>
            </div>

        </div>
    </div><!--container #end  -->


    <div class="container">
        <div class="row">
            <div class="copyright" style="text-align: center">
                <p class="copy col-xs-12">&copy; Copyright 2017. All Rights Reserved by Tieng Anh Giao Tiep.</p>

            </div>
        </div>
    </div>

</footer>

        <!-- loginform popup start -->
<div id="login-form" style="display:none; max-width:400px; padding-left: 20px; padding-right: 20px; ">
     <div class="row">
         <h3>Login</h3>
        
        <?php $model = Yii::createObject(LoginForm::className());?>
        <?php $form = ActiveForm::begin([
                    'id' => 'login',
                    'action' => $base.'/user/security/login',
                  
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => TRUE,
                    'validateOnBlur' => TRUE,
                    'validateOnType' => TRUE,
                    'validateOnChange' => TRUE,
                ]) ?>
        <?= $form->field($model, 'login')->textInput(['style'=>'width:500px','class' => '','placeholder' => "Username or Email"])->label(FALSE);?>
        <?= $form->field($model,'password')->passwordInput(['style'=>'width:100%','class' => '','placeholder' => "Password"])->label(FALSE);?>
        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

                <?= Html::submitButton(
                    Yii::t('user', 'Sign in'),
                    ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
                ) ?>
      
        <?php
          ActiveForm::end();
        ?>
        <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
             <p class="text-center">
                <?php //echo Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
                 <a href="#register-form" class="fancybox"><?=Yii::t('user', 'Don\'t have an account? Sign up!')?></a>
            </p>
            
            <p>
                <a href="user/auth?authclient=facebook" class="btn btn-block btn-social btn-facebook" style="text-align: center;text-decoration: none; color: white">
               <i class="fa fa-facebook"></i> Sign in with Facebook
            </a>
                <a href="user/auth?authclient=google" class="btn btn-block btn-social btn-google" style="text-align: center;text-decoration: none; color: white">
             <i class="fa fa-google-plus"></i> Sign in with Google
            </a>
            </p>    
    </div> <!-- row #end -->
</div>   <!-- loginform popup #end -->

<!-- register popup start -->
<div id="register-form" style="display:none; padding-left: 20px; padding-right: 20px;" >
     <div class="row">
     <h3><?=Yii::t('user', 'Register')?></h3>
    
      <?php
      $model = Yii::createObject(RegistrationForm::className());
      $form = ActiveForm::begin([
                    'id' => 'register',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => TRUE,
                    'action' => $base.'/user/register' 
                ]); ?>

                <?= $form->field($model, 'email')->textInput(['style'=>'width:430px','class' => '','placeholder' => "Your email address"])->label(FALSE); ?>

                <?= $form->field($model, 'username')->textInput(['style'=>'width:100%','class' => '','placeholder' => "Username"])->label(FALSE); ?>

               
                <?= $form->field($model, 'password')->passwordInput(['style'=>'width:100%','class' => '','placeholder' => "Password"])->label(FALSE) ?>
                

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-primary btn-block']) ?>

                <?php ActiveForm::end(); ?>
    
    <p class="text-center">
            
        <a href="#login-form" class="fancybox"><?=Yii::t('user', 'Already registered? Sign in!')?></a>
        </p>
    </div>
</div>
<!-- register popup #end -->

<?php JSRegister::begin(); ?>
<script>
    jQuery.noConflict();
    jQuery('.fancybox').fancybox();
</script>
<?php JSRegister::end(); ?>        


<?php JSRegister::begin(); ?>
<script> new WOW().init(); </script>
<?php JSRegister::end(); ?>  


<?php $this->endContent(); ?>
