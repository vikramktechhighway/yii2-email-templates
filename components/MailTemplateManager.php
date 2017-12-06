<?php

namespace tusharugale\mailtemplates\components;

use Yii;
use yii\base\Object;
use tusharugale\mailtemplates\MailTemplate;
use tusharugale\mailtemplates\MailTemplateConstants;


class MailTemplateManager extends Object
{
	private $subject;
	private $body;
	public function setTemplate($key, $data)
    {
    	$template = MailTemplate::find()->where(['template_code'=>$key])->asArray()->one();
        if(isset($template) && count($template) > 0)
        {
            $this->subject = $template['subject'];
            $body = $template['body'];
            foreach ($data as $key => $value) {
                $body = str_replace("{{".$key."}}",$value,$body);
            }
            $this->body = $body;
        }
        else
        {
            
        }
    }

    public function getSubject()
    {
    	return $this->subject;
    }

    public function getBody()
    {
    	return nl2br($this->body);
    }
}