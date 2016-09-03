<?php

namespace common\models;

use common\models\Theme;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property integer $theme_id
 * @property string $created_at
 *
 * @property Theme $theme
 */
class News extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }
    
    /*public function behaviors()
    {
        return [            
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']                    
                ],               
            ]               
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['body'], 'string'],
            [['theme_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::className(), 'targetAttribute' => ['theme_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'body' => Yii::t('app', 'Текст'),
            'theme_id' => Yii::t('app', 'Тема'),
            'created_at' => Yii::t('app', 'Дата публикации'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Theme::className(), ['id' => 'theme_id']);
    }
}
