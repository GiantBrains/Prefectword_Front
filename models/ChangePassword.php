<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $email
 *  @property string $current_password
 * @property string $new_password
 * @property string $repeat_password
 * @property string $password_hash
 *
 */
class ChangePassword extends \yii\db\ActiveRecord
{
    public $new_password;
    public $repeat_password;
    public $current_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'current_password','new_password','repeat_password'], 'required'],
            [['email'], 'string', 'max' => 150],
            [['email'], 'unique'],
            ['current_password', function ($attribute) {
                if (!User::ValidatePass($this->$attribute, Yii::$app->user->identity->password_hash)) {
                    $this->addError($attribute, 'Current password is not valid');
                }
            }],
            ['repeat_password', 'required'],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>"Passwords don't match" ],
            [['username', 'password_hash', 'current_password','new_password','repeat_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'username' => 'Username',
            'current_password'=>'Current Password',
            'new_password' => 'New Password',
            'repeat_password' => 'Repeat Password'
        ];
    }

}
