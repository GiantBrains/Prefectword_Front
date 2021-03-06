<?php

namespace app\models;

use Swift_TransportException;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $country;
    public $password;
    public $phone;
    public $username;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 3, 'max' => 200],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => '{value} has already been taken.'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '{value} has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            ['phone', 'trim'],
            ['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => '{value} has already been taken.'],
            ['phone', 'string', 'max' => 13],
            ['country', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password_repeat' => 'Confirm Password',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;

        } elseif ($this->validate()) {

//            $userExist = User::findByEmail($this->email);
//            $userExist = User::findByUsername($this->username);
//
            $user = new User();
            $user->username = $this->username;
            $user->country_id = $this->country;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->registration_ip = Yii::$app->request->userIP;
            $user->timezone = Yii::$app->timezone->name;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $clientRole = $auth->getRole('client');
            $auth->assign($clientRole, $user->getId());

            try {
                Yii::$app->mailer->htmlLayout = "layouts/order";
                Yii::$app->mailer->compose('account-create', ['user' => $user])
                    ->setFrom([Yii::$app->params['noreplyEmail'] => Yii::$app->name . ' Accounts Manager'])
                    ->setTo($user->email)
                    ->setSubject('Welcome to Prefectword.com!')
                    ->send();
            } catch (\Swift_TransportException $e) {
                Yii::info($e);
            }

            return $user;
        }
        return null;
    }

}