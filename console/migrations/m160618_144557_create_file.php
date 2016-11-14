<?php

use yii\db\Migration;

/**
 * Handles the creation for table `file`.
 */
class m160618_144557_create_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'dir' => $this->string()->notNull(),
            'hash' => $this->string(32)->notNull(),
            'extension' => $this->string(10)->notNull(),
            'mime' => $this->string(32)->notNull(),
            'size' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('file');
    }
}
