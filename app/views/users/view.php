<?php

use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title='Danh sách người dùng';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$base = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="col-lg-2">
        
     <?= $this->render('/admin/_menu') ?>
</div>
<div class="col-lg-10">

    <h3><?= Html::encode($model->fullname) ?></h3>
    <p>
        <?php
          if ($model->chapnhan == 1){
              echo Html::button('Đã kích hoạt', ['class' => 'btn btn-primary', 'disabled' => 'disabled']);
          }
          else{
              echo Html::a('Kích hoạt', ['active', 'id' => $model->id], ['class' => 'btn btn-primary']);
          }
        ?>
         <?php
           if ($model->level == 0)
           {    
               echo "";
         ?>
       
        <?php
           }
           else{
             echo Html::a('Xóa bỏ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có muốn xóa người này không?',
                'method' => 'post',
            ],
        ]);  
           }
        ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
    <tbody>
       
     <tr><th>Họ tên</th><td><?=$model->fullname?></td></tr>
     <tr><th>Email</th><td><?=$model->email?></td></tr>
     <tr><th>Điện thoại</th><td><?=$model->tel?></td></tr>
     <tr><th>Username</th><td><?=$model->username?></td></tr>
     <tr><th>Ngày đăng ký</th><td></td></tr></tbody></table>
</div>