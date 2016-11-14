<?php

use yii\db\Migration;

/**
 * Handles the creation for table `language`.
 */
class m160515_131352_create_language extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('language', [
            'id' => $this->string(3)->notNull(),
            'name' => $this->string(31)->notNull(),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);
        
        $this->addPrimaryKey('id', 'language', 'id');

        $this->batchInsert('language', ['id', 'name'], [
            ['en', 'English'],
            ['ru', 'Русский']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('language');
    }
}
