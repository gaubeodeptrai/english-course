<?php
use yii\easyii\helpers\Image;
use yii\easyii\widgets\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
use kartik\file\FileInput;


$settings = $this->context->module->settings;
$module = $this->context->module->id;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'title_en') ?>
<?php if($settings['itemThumb']) : ?>
    <?php if($model->image) : ?>
        <img src="<?= Image::thumb($model->image, 240) ?>">
        <a href="<?= Url::to(['/admin/'.$module.'/items/clear-image', 'id' => $model->primaryKey]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
    <?php endif; ?>
    <?= $form->field($model, 'image')->fileInput() ?>
<?php endif; ?>
<?= $dataForm ?>
        
<?php
  $base = Yii::$app->getUrlManager()->getBaseUrl(); 
  if (Yii::$app->controller->action->id === 'create'){
  echo $form->field($model, 'video')->widget(FileInput::classname(), [
   'options'=>['accept'=>'*/*', 'multiple'=>FALSE],
    'pluginOptions' => [
        'uploadUrl' => Url::to([$base.'/uploads/videos/']),
        'uploadExtraData' => [
            'album_id' => 20,
            'cat_id' => 'Nature'
        ],
        'maxFileCount' => 10
    ]
  ]);    
  }
  else{
    $video = $base;
    $video .= $model->video;
    //echo $video;
    echo $form->field($model, 'video')->widget(FileInput::classname(), [
   'options'=>['accept'=>'*/*', 'multiple'=>FALSE],
    'pluginOptions' => [
        'initialPreviewAsData'=>true,
        'initialPreview'=>[
            "$video"
          
        ],
        'previewFileType' => 'any',
        'initialPreviewConfig' => [
            ['caption' => $video],
           
        ],
        //'uploadUrl' => Url::to(['/site/file-upload']),
        'uploadExtraData' => [
            'album_id' => 20,
            'cat_id' => 'Nature'
        ],
        'maxFileCount' => 10,
        'overwriteInitial'=>false,
    ]
        
]);  
   
  }
?>    
<br/>        
<?= $form->field($model, 'video_time'); ?>        
<br/>        
<?php if($settings['itemDescription']) : ?>
    <?= $form->field($model, 'description')->widget(Redactor::className(),[
        'options' => [
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'courses'], true),
            'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'courses'], true),
            'plugins' => ['fullscreen']
        ]
    ]) ?>

    <?= $form->field($model, 'description_en')->widget(Redactor::className(),[
        'options' => [
            'minHeight' => 400,
            'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'courses'], true),
            'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'courses'], true),
            'plugins' => ['fullscreen']
        ]
    ]) ?>
<?php endif; ?>



<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>