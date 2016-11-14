<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 */
class m160515_133143_create_category extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(1),
            'slug' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createTable('category_lang', [
            'category_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text(),
            'text' => $this->text()
        ]);

        $this->addPrimaryKey('category_id-lang_id', 'category_lang', ['category_id', 'lang_id']);

        $this->createIndex('parent_id', 'category', 'parent_id');
        
        $this->addForeignKey('fk-category-parent_id', 'category', 'parent_id', 'category', 'id', 'CASCADE');

        $this->addForeignKey('fk-category_lang-category_id', 'category_lang', 'category_id', 'category', 'id', 'CASCADE');

        $this->addForeignKey('fk-category_lang-lang_id', 'category_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');

        $this->insert('category', [
            'parent_id' => null,
            'slug' => 'main',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->batchInsert('category_lang', ['category_id', 'lang_id', 'name', 'title'], [
            [1, 'en', 'Main category', 'Main category'],
            [1, 'ru', 'Главная категория', 'Главная категория'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category_lang-lang_id', 'category_lang');

        $this->dropForeignKey('fk-category_lang-category_id', 'category_lang');
        
        $this->dropTable('category_lang');
        
        $this->dropTable('category');
    }
}
