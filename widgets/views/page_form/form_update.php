<?php
use yii\helpers\Html;
/** @var $content string */
?>

<div class="row">
    <div class="col-md-6">
        <?= Html::beginForm() ?>
        <?= $content ?>
        <?= Html::submitButton('Update') ?>
        <?= Html::endForm() ?>
    </div>
</div>
