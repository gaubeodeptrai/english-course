<?php
$this->title = Yii::t('easyii/couponcode', "Create Coupon code from user's email");
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>