<?php

namespace tusharugale\mailtemplates;


use tusharugale\mailtemplates\TemplateAsset;
use Yii;

/**
 * mailtemplates module definition class
 */
class Template extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'tusharugale\mailtemplates\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setAliases(['@tusharugale-assets' => __DIR__ . '/assets']); 

        TemplateAsset::register(Yii::$app->view); 
        
        parent::init();
    }
}
