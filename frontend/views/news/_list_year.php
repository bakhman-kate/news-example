<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

echo Html::a($model['year'], Url::to('/news/search?year='.$model['year'])).' ('.$model['count'].')<br/>';

echo ListView::widget([
    'dataProvider' => new ArrayDataProvider([
        'allModels' => $model['months'],
        'pagination' => false,            
    ]),
    'itemView' => function ($model, $key, $index, $widget) {
        $monthName = date('F', strtotime($model['created_at']));
        $searchLink = Url::to('/news/search?year='.$model['year'].'&month='.$model['month']);
        return Html::a($monthName, $searchLink).' ('.$model['COUNT(*)'].')';
    },          
    'layout' => "{items}",
    'options' => [
        'tag' => 'ul',
        'class' => 'months-list',
        'id' => 'months-'.$model['year'],
        'data-year' => $model['year']
    ],
    'itemOptions' => [
        'tag' => 'li',                
        'class' => 'month-item',
    ],            
]);?>
                                                        