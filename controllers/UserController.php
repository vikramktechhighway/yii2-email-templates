<?php

namespace tusharugale\mailtemplates\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use tusharugale\mailtemplates\MailTemplate;
use tusharugale\mailtemplates\MailTemplateConstants;
use tusharugale\mailtemplates\components\MailTemplateManager;
/**
 * Default controller for the `mailtemplates` module
 */
class UserController extends Controller
{
    public $layout = "main";
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$model = new MailTemplate();
    	$dataProvider = new ActiveDataProvider([
            'query' => MailTemplate::find()
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
    

    public function actionUpdate($id)
    {
    	$template = MailTemplate::findOne($id);

        if (Yii::$app->request->isAjax && $template->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($template);
        }
    	if ($template->load(Yii::$app->request->post()) && $template->save()) {
            return $this->redirect(['user/index']);
        }
    	// $form_values = Yii::$app->request->post();
    	// if (isset($form_values) && count($form_values) > 0)
     //    {
     //        $template_body = $form_values['MailTemplate']['body'];
     //    	$template->subject = $form_values['MailTemplate']['subject'];
     //    	$template->body = $template_body;
     //    	$template->save();
     //      	return $this->redirect(['user/index']);
     //    } 
        $template_constants = MailTemplateConstants::find()->where(['mail_template_id'=>$id])->asArray()->all();
        return $this->render('_form', [
            'template' => $template,
            'template_constants' => $template_constants,
        ]);
    }

}
