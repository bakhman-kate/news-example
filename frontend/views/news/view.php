<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;?>

<h1 class="title"><?= Html::encode($model->name) ?></h1>

<div class="row">
    <div class="col-xs-12 news-item">
        <div><?= $model->created_at.', '.$model->theme->name?></div>
        <p class='text-justify'>
            <?= HtmlPurifier::process($model->body) ?>
        </p>            
        <div><?= Html::a('Все новости', Url::to('/news'))?></div>
    </div>
</div>