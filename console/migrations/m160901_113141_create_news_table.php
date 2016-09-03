<?php

use yii\db\Migration;

/**
 * Handles the creation for table `news`.
 * Has foreign keys to the tables:
 *
 * - `theme`
 */
class m160901_113141_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'body' => $this->text(),
            'theme_id' => $this->integer(),
            'created_at' => $this->date(),
        ]);

        // creates index for column `theme_id`
        $this->createIndex(
            'idx-news-theme_id',
            'news',
            'theme_id'
        );

        // add foreign key for table `theme`
        $this->addForeignKey(
            'fk-news-theme_id',
            'news',
            'theme_id',
            'theme',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `theme`
        $this->dropForeignKey(
            'fk-news-theme_id',
            'news'
        );

        // drops index for column `theme_id`
        $this->dropIndex(
            'idx-news-theme_id',
            'news'
        );

        $this->dropTable('news');
    }
}
