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
                    <p class="site-description col-xs-12 col-sm-6">
                        <a href="#" class="multilanguage-set" data-language="2"><img src="http://clara.com.vn/image/vietnam.gif" width="20px"></a>
                        <a href="#" class="multilanguage-set" data-language="1"><img src ="http://clara.com.vn/image/english.png" width="20px"></a>
                    </p>
                    <nav class="meta-login">
                        <style>
                            @media only screen and (min-width: 680px){
                                .languagle {
                                    display: none;
                                }
                            }
                        </style>
                        <ul>

                            <li class="languagle"> <img src="http://clara.com.vn/image/vietnam.gif" width="20px">
                                <img src ="http://clara.com.vn/image/english.png" width="20px"></li>
                            <li class="call"><i class="lnr lnr-phone-handset"></i>0936.437.467</li>
                            
                            
                            <?php
                              if (Yii::$app->user->isGuest){
                            ?>
                            <li><a href="#login-form" class="fancybox"><?=Yii::t('user', 'Login')?></a></li>
                            <li><a href="#register-form" class="fancybox"><?=Yii::t('user', 'Sign up')?></a></li>
                           
                            
                            
                            <?php
                              }  else {
                            ?>
                            <li><?=Html::a('Your Profile ('.Yii::$app->user->identity->username.')',['/user/settings'],['data-method'=>'post']);?></li>
                            <li><?=Html::a('Logout',['/user/security/logout'],['data-method'=>'post']);?></li>
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

        
<div class="signup-newsletter">
	<div class="container">
    	<div class="row">
             <div class="col-xs-12 col-sm-6">
             <span class="i-email-subscribe"><i class="icon-envelope-letter icons"></i></span>
             <h3>Signup for Newsletter</h3>
             <p>Lorem Ipsum is simply dummy text of the printing contents and typesetting industry.</p>
             </div>
             
             <div class="col-xs-12 col-sm-6">
             	<?php if(Yii::$app->request->get(Subscribe::SENT_VAR)) : ?>
                    You have successfully subscribed
                <?php else : ?>
                    <?= Subscribe::form() ?>
                <?php endif; ?>
            </div>
        </div> 
    </div>
</div> <!-- #signup_newsletter End -->        

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_text" id="text-1">
                    <h6 class="widget-title">About Tieng Anh Giao Tiep</h6>
                    <div class="textwidget">
                        <p>Lorem ipsum dolor sit amet, consectet
                            ur adipiscing Nunc varius sed dolor
                            sed sagittis will be helpful.</p>
                        <p>Morbi quis eros ornare, rhoncus lorem
                            efficitur erat. Morbi est at.</p>
                    </div>
                </aside>
            </div>

            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget menu">
                    <h6 class="widget-title">Quick Links</h6>
                    <ul>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Instructor</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Legal Desclaimer</a></li>
                        <li><a href="#">Shortcodes</a></li>
                    </ul>
                </aside>

            </div>


            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_courses">
                    <h6 class="widget-title">Recent Courses</h6> <ul>
                        <li class="clearfix">
                            <img alt="" class="course-media-img" src="images\use_img\f1.jpg">
                            <div class="simi-co">
                                <h5><a href="#">Learn to Use jQuery UI Widgets</a></h5>
                                <p>Maecenas cursus mauris libero, a imperdi.</p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img alt="" class="course-media-img" src="images\use_img\f2.jpg">
                            <div class="simi-co">
                                <h5><a href="#">Learn to Use jQuery UI Widgets</a></h5>
                                <p>Maecenas cursus mauris libero, a imperdi.</p>
                            </div>
                        </li>
                    </ul>
                </aside>
            </div>


            <div class="col-xs-12 col-sm-3 footer-widget">
                <aside class="widget widget_quickcontact">
                    <h6 class="widget-title">Quick Contact</h6>
                    <form class="quickcontact" method="post" action="#">
                        <input type="email" placeholder="Your email address" class="qc-text" size="40" value="" name="your-email">
                        <textarea placeholder="Type your message" aria-invalid="false" class="qc-textarea" rows="10" cols="40" name="your-message"></textarea>
                        <div class="quicksubmit">
                            <input type="submit" class="qc-submit btn btn-default" value="→">
                        </div>
                    </form>
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
