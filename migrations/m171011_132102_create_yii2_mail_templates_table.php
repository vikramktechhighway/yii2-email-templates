<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `yii2_mail_templates`.
 */
class m171011_132102_create_yii2_mail_templates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('yii2_mail_templates', [
            'id' => Schema::TYPE_PK,
            'template_code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'subject' => $this->text(),
            'body' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('yii2_mail_templates');
    }
}
