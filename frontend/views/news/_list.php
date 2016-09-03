<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;
use yii\helpers\Url;?>

<article class="news-item" data-key="<?= $model->id; ?>">
    <h2 class='title'><?= Html::encode($model->name) ?></h2>
    <div><?= $model->created_at.', '.$model->theme->name ?></div>   
    <p class='text-justify'>        
        <?= HtmlPurifier::process(StringHelper::truncate($model->body, 256)) ?>
    </p> 
    <p class="text-right"><?= Html::a('Читать далее', Url::to('/news/'.$model->id))?></p>
</article>
                                                        