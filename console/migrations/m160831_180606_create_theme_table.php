<?php

use yii\db\Migration;

/**
 * Handles the creation for table `theme`.
 */
class m160831_180606_create_theme_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('theme', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('theme');
    }
}
