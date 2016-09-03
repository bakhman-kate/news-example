<?php

use yii\widgets\ListView;?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_list',[
            'model' => $model,
            'key' => $key, 
            'index' => $index, 
            'widget' => $widget
        ]);
    },           
    'layout' => "{items}\n{pager}",
    'options' => [
        'tag' => 'div',
        'class' => 'col-xs-12',
        'id' => 'news',
    ],                          
    'emptyText' => '',
    'emptyTextOptions' => [
        'tag' => 'p'
    ],
    'pager' => [
        'class' => 'yii\widgets\LinkPager',
        'options' => [
            'class' => 'pagination news-ajax-pagination'            
        ],
    ]
]);?>       
