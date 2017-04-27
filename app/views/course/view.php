<?php
use app\models\AddToCartForm;
use yii\easyii\modules\catalog\api\Catalog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$base = Yii::$app->getUrlManager()->getBaseUrl();
$this->title = $item->seo('title', $item->model->title);
$root = $item->cat->tree;
$node = app\modules\courses\models\Category::find()->where('category_id ='.$root)->one();
$node_type = $node->type;
$node_title = $node->title;
$node_slug = $node->slug;

$colors = [];
if(!empty($item->data->color) && is_array($item->data->color)) {
    foreach ($item->data->color as $color) {
        $colors[$color] = $color;
    }
}
?>

<div class="breadcrumb-section">
	<div class="container">
    	<div class="row">
            <header class="entry-header">
            <h1 class="entry-title"><?= $item->seo('h1', $item->title) ?></h1>
            </header><!-- .entry-header -->
        </div> <!--row #end  -->
    </div>
</div><!-- Breadcrumb #end -->
<div class="breadcrumb-detail-page">
	<div class="container">
    	<div class="row">
            <p>
                <a href="/">HOME</a><i class="fa fa-angle-right"></i>
                <?php if ($node_type == 'premium'): ?>
                  <a href="<?=$base?>/course/index">Premium Courses</a><i class="fa fa-angle-right"></i>
                <?php else :?>
                  <a href="<?=$base?>/course/free">Free Courses</a><i class="fa fa-angle-right"></i>
                <?php endif;?> 
                 <a href="<?=$base?>/course/cat/<?=$node_slug?>"><?=$node_title?></a><i class="fa fa-angle-right"></i> 
                 <a href="#"><?=$item->cat->title?></a><i class="fa fa-angle-right"></i>
                 <?=$item->model->title?>
            </p>
        </div> <!--row #end  -->
    </div>
</div>


<div class="page-spacer clearfix"> 
 <div id="primary">
        <div class="container">
        	<div class="row">
                <main id="main" class="site-main col-xs-12">
           <div class="row">
            <div class=" col-md-3">
              <h4>Danh sách bài học</h4>
                <div class="panel-group" id="accordion">
    <?php
                
               
                  $list_sub_courses = app\modules\courses\models\Category::find()
                          ->where(['tree'=>$item->cat->tree])
                          ->andWhere('status = 1')
                          ->andWhere('depth > 0')
                          ->all();  
                  foreach ($list_sub_courses as $sub_course): 
                      $list_items = app\modules\courses\models\Item::find()
                                          ->where(['category_id'=>$sub_course->category_id])
                                          ->andWhere('status =1')
                                          ->all();
                            
                               
    ?>  
     <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title" >
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$sub_course->category_id?>">
                            
                              <?=$sub_course->title?>
                            </a>
                        </h4>
                    </div>
                     <?php
                     
                        if (Yii::$app->request->get('close')==$sub_course->category_id):
                            $in = 'in';
                        else:
                            $in = '';
                        endif;
                     ?>
                    <div id="collapse<?=$sub_course->category_id?>" class="panel-collapse collapse <?=$in?>">
                        <div class="panel-body">
                            <table class="table" style="border-right-width:0px; border-left-width:0px;">
                               <?php
                                  
                                  foreach ($list_items as $content):
                                      $path_info = pathinfo($content->video); 
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
                                       if (Yii::$app->request->get('slug')==$content->slug):
                                         $color = 'orange';
                                       else:
                                        $color = '';
                                       endif;
                                ?>  
                                  
                                <tr>
                                    <td>
                                        
                                        <?=$icon?><a href="<?=$base?>/course/view/<?=$content->slug?>?close=<?=$sub_course->category_id?>" style="padding-left: 9px; color:<?=$color?>"><?=$content->title?></a>
                                    </td>
                                </tr>
                                <?php endforeach;?>    
                              
                                
                              
                            </table>
                        </div>
                    </div>
                </div>
     <?php endforeach;?>                         
</div>
            </div>
            <div class="col-md-9">
                <?php
                      $path_info = pathinfo($item->model->video); 
                      $ext = $path_info['extension'];
                  if ($ext == 'pdf'|| $ext == 'doc'||$ext == 'docx'){
                     
                  $pdf = Url::base();
                  $pdf .= $item->model->video;
                  //echo $pdf;
                ?>
              <iframe src="http://docs.google.com/gview?url=<?=$pdf?>&embedded=true" style="width:100%; height:700px;" frameborder="0"></iframe>
                <?php
                  }
                
                    
                ?> 
              <?php    
               if ($paid=='free' || $paid > 0):    
                   if ($ext == 'mp4'|| $ext == 'mkv'||$ext == 'ts'){
              ?>
                 <style>
                    video::-internal-media-controls-download-button {
                        display:none;
                    }

                    video::-webkit-media-controls-enclosure {
                        overflow:hidden;
                    }

                    video::-webkit-media-controls-panel {
                        width: calc(100% + 30px); /* Adjust as needed */
                    }
                </style>

                <?php
                function getEncodedVideoString($type, $file) {
                    return 'data:video/' . $type . ';base64,' . base64_encode(file_get_contents($file));
                }
                //$url = 'uploads/videos/oceans.mp4';
                
                
                           
                
                $url = substr($item->model->video, 1);
                echo \xutl\videojs\VideoJsWidget::widget([
                    'options' => [
                        'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                        'poster' => "http://www.videojs.com/img/poster.jpg",
                        'controls' => true,
                        'preload' => 'auto',
                        'width' => '100%',
                        'height' => '400',
                        'save video' => FALSE,
                    ],
                    'tags' => [
                        'source' => [
                            ['src' => getEncodedVideoString('mp4', $url)],
                            //['src'=>'http://localhost/yii-logistic/uploads/videos/video.php?name=oceans','type' => 'video/mp4'],

                        ],

                    ]
                ]);
                ?>
                   <?php }?>
                <?= $item->description ?>
                <?php else : ?>
                    <div class="alert alert-warning" style="font-size: 20px; text-align: center">
                      <a class="close">
                         <span aria-hidden="true">×</span>
                      </a> 
                      Bạn chưa thanh toán cho khóa học này. 
                    </div>
               <?php endif; ?>
                  
            </div>
          </div>

    
				</main><!-- #main -->
             </div> <!-- row -->
         </div> <!-- container -->
  </div><!-- #primary -->
 </div> <!-- page-spacer #end  --> 




