<?php
use yii\helpers\Html;

$this->title = $subject;
?>
<p>User <b><?= $post->name ?></b> leaved message in your Website.</p>
<p>You can view it <?= Html::a('here', $link) ?>.</p>