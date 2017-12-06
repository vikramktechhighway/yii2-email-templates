Yii2 Mail Templates
===================
Create and Edit mail templates

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tusharugale/yii2-mail-templates "*"
```

or add

```
"tusharugale/yii2-mail-templates": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Add mailtemplates to modules in web.php

```php
$config['modules']['mailtemplates'] = [
    'class' => 'tusharugale\mailtemplates\Template',
];
```


Create tables by running following migration command

```php
php yii migrate --migrationPath=@vendor/tusharugale/yii2-mail-templates/migrations/
```


Send Mail using Template

```php
use tusharugale\mailtemplates\components\MailTemplateManager;

$data = array(
			'key1'=>'Value1',
			'key2'=>'Value2',
			'key3'=>'Value3',
		);
$template = new MailTemplateManager();
$template->setTemplate('template_code', $data);
```

Get Subject

```php
$template->getSubject();
```

Get Body

```php
$template->getBody();
```

You should manage access of following links.
 

Developer / Admin Link - Will be used to create, update, delete Templates
```php
http://www.yourapp.com/index.php?r=mailtemplates
```

End User Link -Will be used only for editing templates.
```php
http://www.yourapp.com/index.php?r=mailtemplates/user
```