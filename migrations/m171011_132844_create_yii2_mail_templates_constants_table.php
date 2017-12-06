<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `yii2_mail_templates_constants`.
 */
class m171011_132844_create_yii2_mail_templates_constants_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('yii2_mail_templates_constants', [
            'id' => Schema::TYPE_PK,
            'mail_template_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
        ]);

        // creates index for column `mail_template_id`
        $this->createIndex(
            'idx-yii2_mail_templates_constants-mail_template_id',
            'yii2_mail_templates_constants',
            'mail_template_id'
        );

        // add foreign key for table `mail_template_id`
        $this->addForeignKey(
            'fk-yii2_mail_templates_constants-mail_template_id',
            'yii2_mail_templates_constants',
            'mail_template_id',
            'yii2_mail_templates',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('yii2_mail_templates_constants');
    }
}
