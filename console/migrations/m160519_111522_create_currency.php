<?php

use yii\db\Migration;

/**
 * Handles the creation for table `currency`.
 */
class m160519_111522_create_currency extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3)->unique()->notNull(),
            'rate' => $this->decimal(8,4)->notNull(),
            'primary' => $this->boolean()->notNull()->defaultValue(0),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createTable('currency_lang', [
            'currency_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'before_name' => $this->string(20)->notNull()->defaultValue(''),
            'after_name' => $this->string(20)->notNull()->defaultValue(''),
        ]);

        $this->addPrimaryKey('currency_id-lang_id', 'currency_lang', ['currency_id', 'lang_id']);

        $this->addForeignKey('fk-currency_lang-currency_id', 'currency_lang', 'currency_id', 'currency', 'id', 'CASCADE');

        $this->addForeignKey('fk-currency_lang-lang_id', 'currency_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');

        $this->insert('currency', [
            'code' => 'USD',
            'rate' => 1,
            'primary' => 1
        ]);

        $this->batchInsert('currency_lang', ['currency_id', 'lang_id', 'name', 'before_name'], [
            [1, 'en', 'U.S. dollar', '$ '],
            [1, 'ru', 'Доллар США', '$ '],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-currency_lang-lang_id', 'currency_lang');
        
        $this->dropForeignKey('fk-currency_lang-currency_id', 'currency_lang');
        
        $this->dropTable('currency_lang');
        
        $this->dropTable('currency');
    }
}
