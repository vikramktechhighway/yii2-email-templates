<?php

namespace tusharugale\mailtemplates\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use tusharugale\mailtemplates\MailTemplate;
use tusharugale\mailtemplates\MailTemplateConstants;
use tusharugale\mailtemplates\components\MailTemplateManager;
use tusharugale\mailtemplates\TemplateAsset;
/**
 * Default controller for the `mailtemplates` module
 */
class DefaultController extends Controller
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
    public function actionCreate()
    {
    	$template = new MailTemplate();

        if (Yii::$app->request->isAjax && $template->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($template);
        }

        if ($template->load(Yii::$app->request->post()) && $template->save()) {
           $form_values = Yii::$app->request->post();
            if(isset($form_values['constant_key']) && count($form_values['constant_key']) > 0)
            {
                foreach ($form_values['constant_key'] as $key => $value) {
                    $template_constant = new MailTemplateConstants();
                    $template_constant->mail_template_id = $template->id;
                    $template_constant->name = $value;
                    $template_constant->description = $form_values['constant_desc'][$key];
                    $template_constant->save();
                }
            }
            return $this->redirect(['default/index']);
        }
        else
        {
            return $this->render('_form', [
                'template' => $template,
            ]);
        }
    }
    public function actionUpdate($id)
    {
    	$template = MailTemplate::findOne($id);
    	$template_constants = MailTemplateConstants::find()->where(['mail_template_id'=>$id])->asArray()->all();

        if (Yii::$app->request->isAjax && $template->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($template);
        }
        if ($template->load(Yii::$app->request->post()) && $template->save()) {
            $form_values = Yii::$app->request->post();
            Yii::$app->db->createCommand()->delete('yii2_mail_templates_constants', ['mail_template_id' => $id])->execute();
            if(isset($form_values['constant_key']) && count($form_values['constant_key']) > 0)
            {
                foreach ($form_values['constant_key'] as $key => $value) {
                    $template_constant = new MailTemplateConstants();
                    $template_constant->mail_template_id = $template->id;
                    $template_constant->name = $value;
                    $template_constant->description = $form_values['constant_desc'][$key];
                    $template_constant->save();
                }
            }
            return $this->redirect(['default/index']);
        }
        else
        {
            return $this->render('_form', [
                'template' => $template,
                'template_constants' => $template_constants,
            ]);
        }
    }

    public function actionDelete($id)
    {
    	$template = MailTemplate::findOne($id);
    	$template->delete();
      	return $this->redirect(['default/index']);        
    }
}
