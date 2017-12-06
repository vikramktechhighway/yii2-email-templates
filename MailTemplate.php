<?php

namespace tusharugale\mailtemplates;

/**
 * mailtemplates module definition class
 */
class MailTemplate extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [

        	[['template_code','name','description','subject','body'],'required'],
        	[['template_code','name','description','subject','body'], 'string', 'message' => 'Must be string'],
        	['template_code','match','not' => true, 'pattern' => '/[^a-zA-Z0-9\\\_-]/',
		            'message' => 'You can only use A-Z, a-z, 0-9, Underscore, and hyphen characters (Space are not allowed).'],
        	['template_code', 'unique'],
            // [['phone_no'], 'integer', 'message' => 'Phone must be a number'],
            // [['confirmation_no', 'client_name', 'hotel_name', 'hotel_address', 'phone_no', 'no_of_rooms', 'adults', 'children', 'meals', 'room_type', 'room_view', 'document_type', 'cancel_policy', 'checkin', 'checkout', 'remarks', 'terms', 'show_map', 'ground_handler'], 'required'],
            // [['no_of_rooms','adults', 'children', 'meals', 'room_type', 'room_view', 'document_type', 'ground_handler'], 'integer'],
            // [['checkin', 'checkout', 'created_on', 'created_at', 'updated_at'], 'safe'],
            // [['confirmation_no','nationality'], 'string', 'max' => 100,'message'=>'Must be string'],
            // [['client_name'],'string'],
            // [['hotel_name'], 'string', 'max' => 200],
            // [['hotel_address', 'cancel_policy', 'remarks', 'terms'], 'string', 'max' => 500],
            // [['trip_advisor_link'], 'string', 'max' => 300],
            // [['confirmation_no'], 'unique'],
            // [['adults','no_of_rooms'],'compare', 'operator'=>'>', 'compareValue'=>0],
            // [['children'],'compare', 'operator'=>'>=', 'compareValue'=>0],
            // ['checkout','compare','compareAttribute'=>'checkin','operator'=> '>='],
        ];
    }

    public static function tableName()
    {
        return 'yii2_mail_templates';
    }
}