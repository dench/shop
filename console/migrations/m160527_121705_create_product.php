<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 */
class m160527_121705_create_product extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull()->defaultValue(0),
            'slug' => $this->string()->notNull()->defaultValue(''),
            'code' => $this->string()->notNull()->defaultValue(''),
            'price' => $this->decimal(11,2)->notNull()->defaultValue(0.0),
            'old_price' => $this->decimal(11,2)->notNull()->defaultValue(0.0),
            'available' => $this->integer()->notNull()->defaultValue(1),
            'currency_id' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createTable('product_lang', [
            'product_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull()->defaultValue(''),
            'title' => $this->string()->notNull()->defaultValue(''),
            'keywords' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text()->notNull(),
            'text' => $this->text()->notNull()
        ]);
        
        $this->createIndex('model_id', 'product', 'model_id');

        $this->addPrimaryKey('product_id-lang_id', 'product_lang', ['product_id', 'lang_id']);

        $this->addForeignKey('fk-product_lang-product_id', 'product_lang', 'product_id', 'product', 'id', 'CASCADE');

        $this->addForeignKey('fk-product_lang-lang_id', 'product_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('fk-product-model_id', 'product', 'model_id', 'model', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-model_id', 'product');
        
        $this->dropForeignKey('fk-product_lang-lang_id', 'product_lang');

        $this->dropForeignKey('fk-product_lang-product_id', 'product_lang');

        $this->dropTable('product_lang');

        $this->dropTable('product');
    }
}
