<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\select2\Select2;
    use dektrium\user\models\User;
    use yii\easyii\widgets\DateTimePicker;
    //use kartik\datetime\DateTimePicker;
    use yii\data\ActiveDataProvider;
    use yii\db\Expression;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>
<?php
$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";


  echo $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'email'),
                'options' => ['placeholder' => 'Select email ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
?>
<?php if ($model->coupon_code): ?>
  <?= $form->field($model, 'coupon_code')->textInput(['readonly' => TRUE]) ?>
<?php else: ?>
  <?php
     $res = "";
     for ($i = 0; $i < 8; $i++) {
       $res .= $chars[mt_rand(0, strlen($chars)-1)];
       if ($i==3){
       $res .= '-';  
     }
}
  ?>
  <?= $form->field($model, 'coupon_code')->textInput(['readonly' => FALSE, 'value' => $res]) ?>
 <?php endif;?>

<?= $form->field($model, 'start_date')->widget(DateTimePicker::className()); ?>
<?= $form->field($model, 'end_date')->widget(DateTimePicker::className()); ?>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>