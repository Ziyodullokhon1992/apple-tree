<?php

use yii\db\Migration;

/**
 * Class m231126_101633_create_apple_tree
 */
class m231126_101633_create_apple_tree extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(20)->notNull(),
            'created_date' => $this->integer(10)->notNull(),
            'fallen_date' => $this->integer(10),
            'status' => $this->string(10)->notNull()->defaultValue('on_tree'),
            'remained' => $this->decimal(3,2)->notNull()->defaultValue(1.00),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
