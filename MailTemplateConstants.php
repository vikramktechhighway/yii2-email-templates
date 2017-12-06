<?php

namespace tusharugale\mailtemplates;

/**
 * mailtemplates module definition class
 */
class MailTemplateConstants extends \yii\db\ActiveRecord
{
	public function rules()
    {
    	return 
    	[
    		[['name','description'],'required'],
        ];
    }
    public static function tableName()
    {
        return 'yii2_mail_templates_constants';
    }
}