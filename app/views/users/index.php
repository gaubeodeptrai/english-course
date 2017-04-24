<?php
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title='Danh sách người dùng';
$this->params['breadcrumbs'][] = $this->title;
$base = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="col-lg-2">
        
     <?= $this->render('/admin/_menu') ?>
</div>
<div class="col-lg-10">

    <h3><?= Html::encode($this->title) ?></h3>
    <table class="table  table-striped">
        <thead style="background-color: whitesmoke">
      <tr>
        <th>Họ tên</th>
        <th>Điện thoại</th>
        <th>Email</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
        $users = \common\models\User::find()->all();
        foreach ($users as $item):
          if ($item->chapnhan == 1){
              $active = 'success';
          }
          else{
              $active = 'danger';
          }
      ?>  
      <tr class="<?=$active?>">
          <td><a href="<?=$base?>/users/view/?id=<?=$item->id?>"><?=$item->fullname?></a></td>
        <td><?=$item->tel?></td>
        <td><?=$item->email?></td>
        
      </tr>
     
     <?php
       endforeach;
     ?>
    </tbody>
  </table>

    
</div>