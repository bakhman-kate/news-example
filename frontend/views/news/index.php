<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->registerJs('
    function newsSearch(event, url, data) {
        event.preventDefault();
        
        $.ajax({
            url: url,
            method: "GET", 
            data: data,
            dataType: "html"
        }).done(function(response) {
           $("div.content-area").html(response);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert("Произошла ошибка");
        });
    }
    
    $(document).on("click", "div.theme-item a", function(event) {        
        newsSearch(event, "/news/theme", {id: $(this).parent().attr("data-key")});
    });
    
    $(document).on("click", "div.year-item a", function(event) {        
        newsSearch(event, "/news/search", {year: $(this).parent().attr("data-key"), month: ""});      					
    });
    
    $(document).on("click", "li.month-item a", function(event) {        
        newsSearch(event, "/news/search", {year: $(this).parent().parent().attr("data-year"), month: $(this).parent().attr("data-key")});
    });
    
    $(document).on("click", ".news-ajax-pagination li a", function(event) { 
        newsSearch(event, $(this).attr("href"), null);
    });    
');?>

<div class="row"> 
    <div class="col-md-2 col-sm-4">
        <?= ListView::widget([
            'dataProvider' => $timeProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_list_year',[
                    'model' => $model,
                    'key' => $key, 
                    'index' => $index, 
                    'widget' => $widget
                ]);
            },          
            'layout' => "{items}",
            'options' => [
                'tag' => 'div',                
                'id' => 'year_list',
            ],
            'itemOptions' => [
                'tag' => 'div',                
                'class' => 'year-item',
            ],            
        ]);?>
        <p></p>
        <?= ListView::widget([
            'dataProvider' => $themeProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a($model['name'], Url::to('/news/theme/'.$model['id'])).' ('.$model['COUNT(*)'].')';                
            },           
            'layout' => "{items}",
            'options' => [
                'tag' => 'div',                
                'id' => 'theme-list',
            ],
            'itemOptions' => [
                'tag' => 'div',                
                'class' => 'theme-item',
            ],            
        ]);?>
    </div>
    
    <div class="col-md-10 col-sm-8 content-area">
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
            'emptyText' => 'Список пуст',
            'emptyTextOptions' => [
                'tag' => 'p'
            ],
        ]);?>       
    </div>      
</div>   
