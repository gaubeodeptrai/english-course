<?php use yii\helpers\Html; ?>

<div class="row">
    <div class="col-md-2">
        <?= Html::img($item->thumb(80, 160)) ?>
    </div>
    <div class="col-md-10">
        <p><?= Html::a($item->title, ['course/view', 'slug' => $item->slug]) ?></p>
        
        
    </div>
</div>
<br>