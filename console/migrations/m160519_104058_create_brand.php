<?php

use yii\db\Migration;

/**
 * Handles the creation for table `brand`.
 */
class m160519_104058_create_brand extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createTable('brand_lang', [
            'brand_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text(),
            'text' => $this->text(),
        ]);

        $this->addPrimaryKey('brand_id-lang_id', 'brand_lang', ['brand_id', 'lang_id']);

        $this->addForeignKey('fk-brand_lang-brand_id', 'brand_lang', 'brand_id', 'brand', 'id', 'CASCADE');

        $this->addForeignKey('fk-brand_lang-lang_id', 'brand_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');

        $this->insert('brand', [
            'slug' => 'unknown',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->batchInsert('brand_lang', ['brand_id', 'lang_id', 'name', 'title'], [
            [1, 'en', 'Unknown', 'Unknown'],
            [1, 'ru', 'Неизвестный', 'Неизвестный'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-brand_lang-lang_id', 'brand_lang');

        $this->dropForeignKey('fk-brand_lang-brand_id', 'brand_lang');
        
        $this->dropTable('brand_lang');
        
        $this->dropTable('brand');
    }
}
