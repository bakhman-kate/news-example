<?php

use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
?>
<div class="news-index">
    <h1><?= Html::encode($this->title) ?></h1>    

    <p><?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',                            
                'headerOptions' => ['width' => '80'],
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}', 
            ],
            [
                'attribute' => 'id',                
                'headerOptions' => ['width' => '70'],      
            ],
            [
                'attribute' => 'created_at',                
                'headerOptions' => ['width' => '120'],
                'format' => 'date',                 
            ],
            [
                'attribute' => 'name',                
                'headerOptions' => ['width' => '200'],      
            ],
            [
                'attribute' => 'body',                
                'headerOptions' => ['width' => '300'],
                'format' => 'ntext',                 
            ],
            [
                'attribute' => 'theme_id', 
                'headerOptions' => ['width' => '150'],
                'format' => 'raw',                
                'value' => function($data){
                   return Html::a($data->theme->name, Url::to('/admin/theme/'.$data->theme_id), ['target' => '_blank']);
                },       
            ],      
        ],
        'options' => ['class' => 'table-responsive no-padding'],        
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
    ]); ?>   
</div>
