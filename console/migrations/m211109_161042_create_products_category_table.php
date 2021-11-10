<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_category}}`.
 */
class m211109_161042_create_products_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_category}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(80),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_category}}');
    }
}
