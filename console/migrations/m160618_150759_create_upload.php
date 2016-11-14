<?php

use yii\db\Migration;

/**
 * Handles the creation for table `upload`.
 */
class m160618_150759_create_upload extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('upload', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'dir' => $this->string()->notNull()->defaultValue(''),
            'name' => $this->string()->notNull(),
            'tmp' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->integer()->notNull()
        ]);
        
        $this->addForeignKey('fk-upload-file_id', 'upload', 'file_id', 'file', 'id', 'CASCADE');
        $this->addForeignKey('fk-upload-user_id', 'upload', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-upload-file_id', 'upload');
        
        $this->dropForeignKey('fk-upload-user_id', 'upload');
        
        $this->dropTable('upload');
    }
}
