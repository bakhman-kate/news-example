<?php

namespace frontend\controllers;

use common\models\News;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    private $limit = 12;
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy('created_at DESC')->limit($this->limit),
            'pagination' => [
                'pageSize' => 5,
            ],            
        ]);
        
        $dateArray = News::find()
            ->select([
                'created_at', 
                'EXTRACT(YEAR FROM created_at) AS year', 
                'EXTRACT(MONTH FROM created_at) AS month', 
                //'EXTRACT(YEAR_MONTH FROM created_at) AS yearmonth', 
                'COUNT(*)'])                    
            ->groupBy(['year', 'month'])
            ->orderBy('created_at desc')
            ->asArray()
            ->all();        
        
        $result = ArrayHelper::index($dateArray, 'COUNT(*)', [function ($element) {           
            return $element['year'];
        }, 'month']);
        
        foreach($result as $year => $months)
        {
            $result[$year] = ['count' => 0, 'year' => $year, 'months' => $months];
            foreach($months as $month => $news)
            {
                foreach($news as $count => $news_element)
                {
                    $result[$year]['count'] += $count;
                    $result[$year]['months'][$month] = $news_element;
                }
            }
        }
        
        $timeProvider = new ArrayDataProvider([
            'allModels' => $result,
            'pagination' => false,            
        ]);
        
        $themeProvider = new ActiveDataProvider([
            'query' => News::find()
                    ->select(['news.theme_id AS id', 'theme.name AS name', 'COUNT(*)'])
                    ->innerJoin('theme', 'news.theme_id = theme.id')
                    ->where(['not', ['theme_id' => null]])
                    ->groupBy(['theme_id'])
                    ->asArray(),
            'pagination' => false,            
        ]);      

        $this->view->title = 'Список новостей';
        $this->view->params['breadcrumbs'] = ['label' => 'Новости'];

        return $this->render('index', [            
            'dataProvider' => $dataProvider,
            'timeProvider' => $timeProvider,
            'themeProvider' => $themeProvider,                        
        ]);       
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);        
    }
    
    public function actionTheme($id)
    {
        return $this->RenderQuery(News::find()->where('theme_id=:theme_id', [':theme_id' => $id]));                        
    }
    
    public function actionSearch($year, $month=NULL)
    {
        $query = News::find()->where(['YEAR(created_at)' => $year]);
        if(!empty($month)) {
            $query->andFilterWhere(['MONTH(created_at)' => $month]);
        } 
        
        return $this->RenderQuery($query);          
    }
    
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function RenderQuery($query) {
        return $this->renderAjax('search', [
            'dataProvider' => new ActiveDataProvider([
                'query' => $query->orderBy('created_at DESC')->limit($this->limit),
                'pagination' => ['pageSize' => 5],            
            ])
        ]);
    }
}
