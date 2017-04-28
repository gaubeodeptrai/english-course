<?php
use yii\helpers\Url;

$this->title = Yii::t('easyii/couponcode', 'Coupon Code');

$module = $this->context->module->id;
?>

<?= $this->render('_menu') ?>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <th width="50">#</th>
                <?php endif; ?>
                <th><?= Yii::t('easyii', 'CouponCode') ?></th>
                <?php if(IS_ROOT) : ?>
                    <th><?= Yii::t('easyii', 'Email') ?></th>
                    <th><?= Yii::t('easyii', 'Username') ?></th>
                    <th><?= Yii::t('easyii', 'Start date') ?></th>
                    <th><?= Yii::t('easyii', 'End date') ?></th>
                    <th><?= Yii::t('easyii', 'Status') ?></th>
                    <!--<th width="30"></th>-->
                <?php endif; ?>
                   
            </tr>
        </thead>
        <tbody>
    <?php 
          $today = strtotime(date('Y-m-d'));
          foreach($data->models as $item) : 
             
             $user = \dektrium\user\models\User::find()->where(['id'=>$item->user_id])->one();
              //echo $today; echo $model->start_date; echo $model->end_date;
              if ($today > $item->end_date):
                  $info = "Out of date";
              elseif ($today < $item->start_date):

                  $info = "Less than a day";
              else:
                  $info = "Using";
              endif;
            
    ?>
            <tr>
                <?php if(IS_ROOT) : ?>
                <td><?= $item->primaryKey ?></td>
                <?php endif; ?>
                <td><a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->user_id]) ?>">
                        <?php if ($item->coupon_code):?>
                          <?= $item->coupon_code ?>
                        <?php else:?>
                          Not have coupon code
                        <?php endif;?>
                    </a>
                </td>
                <?php if(IS_ROOT) : ?>
                <td><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
                 <td><?php echo $user['username']; ?></td>
                 <td><?php echo  Yii::$app->formatter->asDate($item->start_date, 'yyyy-MM-dd');?></td>   
                 <td><?php echo  Yii::$app->formatter->asDate($item->end_date, 'yyyy-MM-dd');?></td>  
                 <td><?=$info?></td>
                   <!-- <td><a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"></a></td>-->
                <?php endif; ?>
                
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<?php endif; ?>