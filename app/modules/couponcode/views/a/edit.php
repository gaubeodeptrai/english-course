<?php
$this->title = Yii::t('easyii/couponcode', 'Edit Coupon code');
//echo $email;
?>

<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model,'email'=>$email]) ?>