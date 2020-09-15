<?php
namespace app\controllers;

use app\models\Language;
use app\models\Level;
use app\models\Pages;
use app\models\PasswordResetRequestForm;
use app\models\Rating;
use app\models\Service;
use app\models\Sources;
use app\models\Spacing;
use app\models\Style;
use app\models\Subject;
use app\models\Type;
use app\models\Uniqueid;
use app\models\Urgency;
use app\models\User;
use Kakadu\Yii2JwtAuth\RefreshTokensAction;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: gits
 * Date: 5/25/18
 * Time: 3:55 PM
 */
class ApiController extends Controller
{

    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => JwtHttpBearerAuth::className(),
                'optional' => [
                    'user-login',
                ],
                'except' => ['user-login','user-register', 'calculator-details', 'general-details','request-password-reset']
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'PUT', 'GET', 'DELETE'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'user-register' => ['post'],
                    'user-login' => ['post'],
                    'request-password-reset'=> ['post']
                ],
            ],
        ];
    }
    // disable csrf
    public function beforeAction($action)
    {
        if (in_array($action->id, ['user-register', 'user-login','request-password-reset'])) {
            $this->enableCsrfValidation = false;
        }
        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            $e->getMessage();
        }

    }

    public function actionCalculatorDetails()
    {
        $services = Service::find()->all();
        $types = Type::find()->all();
        $urgencies = Urgency::find()->all();
        $pages = Pages::find()->all();
        $levels = Level::find()->all();
        $spacing = Spacing::find()->all();
        $subjects = Subject::find()->all();
        $styles = Style::find()->all();
        $sources = Sources::find()->all();
        $languages = Language::find()->all();
        $result = ['services' => $services, 'types' => $types, 'urgencies' => $urgencies,
            'pages' => $pages, 'levels' => $levels, 'spacing' => $spacing, 'languages' => $languages,
            'subjects' => $subjects, 'styles' => $styles, 'sources' => $sources];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionGeneralDetails()
    {
        $ratings = Rating::find()->orderBy('id DESC')->asArray()->limit(5)->all();
        $timezone = Yii::$app->timezone->name;
        $allorders = Uniqueid::findOne(1);
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        try {
            $totalrating = $command1->queryScalar();
        } catch (\yii\db\Exception $e) {
        }
        $count = Rating::find()->count();
        $avgrating = $totalrating / $count;

        $result = ['ratings' => $ratings, 'timezone' => $timezone, 'allorders' => $allorders->orderid,
            'totalrating' => $totalrating, 'count' => $count, 'avgrating' => $avgrating];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionUserLogin()
    {
        $post = Yii::$app->request->post();
        $email = $post['email'];
        $password = $post['password'];
        if ($email && $password) {
            $model = User::findOne(['email' => $email]);
            if ($model) {
                if (Yii::$app->security->validatePassword($password, $model->password_hash)) {
                    $username = $model->username;
                    $email = $model->email;

                    //generate access token
                    $token = User::generateToken($model->id);

                    //update the user with the new token
                    $model->access_token = $token;
                    $model->save(false);

                    $result = ['status' => '100', 'message' => 'Success! You have logged in successfully', 'username' => $username,
                        'email' => $email, 'token'=> (string)$token];
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return $result;
                } else {
                    $result = ['status' => '101', 'message' => 'Incorrect email or password.'];
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return $result;
                }
            } else {
                $result = ['status' => '101', 'message' => 'There is no user found for the credentials entered.'];
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            }

        } else {
            $result = ['status' => '101', 'message' => 'Please enter email and password'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }

    public function actionUserRegister()
    {
        $post = Yii::$app->request->post();
        $username = $post['username'];
        $email = $post['email'];
        $site_const = $post['site_code'];
        $timeZone = $post['timezone'];
        $password = $post['password'];

        //check if the username and email exist
        $checkUsername = User::findOne(['username' => $username]);
        $checkEmail = User::findOne(['email' => $email]);
        if ($username && $email && $password) {
            if (!$checkEmail) {
                if (!$checkUsername) {
                    //register new user
                    $user = new User();
                    $user->username = $username;
                    $user->email = $email;
                    $user->registration_ip = Yii::$app->request->userIP;
                    $user->timezone = $timeZone;
                    $user->site_code = $site_const;
                    $user->password_hash = Yii::$app->security->generatePasswordHash($password);
                    $user->auth_key = Yii::$app->security->generateRandomString();
                    if ($user->save()) {
                        //save the new user
                        $result = ['status' => '100', 'message' => 'Success! You have successfully created your account', 'username' => $username, 'email' => $email];
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return $result;

                    } else {
                        $result = ['status' => '101', 'message' => 'Something went wrong when trying to register the user'];
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return $result;
                    }
                } else {
                    $result = ['status' => '101', 'message' => 'The username is already taken. Please enter new username'];
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return $result;
                }

            } else {
                $result = ['status' => '101', 'message' => 'The email is already taken. Please enter new email'];
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            }
        } else {
            $result = ['status' => '101', 'message' => 'Please enter all fields in the form'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        }
    }

    public function actionRequestPasswordReset(){
        $post = Yii::$app->request->post();
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->sendEmail()) {
                $result = ['status' => '100', 'message' => 'An email with further instructions on resetting your password was sent on your email.'];
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            } else {
                $result = ['status' => '101', 'message' => 'There was a problem in sending the email'];
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $result;
            }

        }
        $result = ['status' => '101', 'message' => 'Please enter a valid email'];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;

    }
}
