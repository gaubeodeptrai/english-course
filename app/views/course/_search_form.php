<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?= Html::beginForm(Url::to(['/course/search']), 'get') ?>
                <fieldset>
                    <div class="input-group">
                        <input type="text" name="text" value="<?=  Yii::$app->request->get('text')?>" id="search" placeholder="<?=Yii::t('easyii', 'Enter keywors to find courses you like')?>" value="" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-orange btn-medium"><i class="lnr lnr-magnifier"></i><?=Yii::t('easyii', 'Search')?></button>
                        </span>
                    </div>
                </fieldset>
            <?= Html::endForm() ?><!-- #search-form #end  -->
