<?php

use yii\db\Migration;

/**
 * Handles the creation for table `model`.
 */
class m160527_101510_create_model extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('model', [
            'id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull()->defaultValue(1),
            'slug' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);
        
        $this->createTable('model_lang', [
            'model_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text(),
            'text' => $this->text()
        ]);

        $this->addPrimaryKey('model_id-lang_id', 'model_lang', ['model_id', 'lang_id']);

        $this->addForeignKey('fk-model_lang-model_id', 'model_lang', 'model_id', 'model', 'id', 'CASCADE');

        $this->addForeignKey('fk-model_lang-lang_id', 'model_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-model_lang-lang_id', 'model_lang');

        $this->dropForeignKey('fk-model_lang-model_id', 'model_lang');

        $this->dropTable('model_lang');

        $this->dropTable('model');
    }
}
