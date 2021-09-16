<?php

namespace app\controllers;

use app\models\Article;
use app\models\Auth;
use app\models\AuthHandler;
use app\models\ChangePassword;
use app\models\File;
use app\models\Level;
use app\models\Order;
use app\models\Pages;
use app\models\PasswordResetRequestForm;
use app\models\Rating;
use app\models\ResetPasswordForm;
use app\models\Service;
use app\models\Settings;
use app\models\SignupForm;
use app\models\Spacing;
use app\models\Type;
use app\models\Uniqueid;
use \app\components\Notification;
use app\models\Urgency;
use app\models\User;
use Carbon\Carbon;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\InvalidParamException;
use yii\base\Model;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Frontorder;
use Gregwar\Image\Image;

class SiteController extends Controller
{
    public $layout = 'blog';

    /**
     * @inheritdoc
     */
    function behaviors()
    {
        return [
//            'pageCache' => [
//                'class' => 'yii\filters\PageCache',
//                'only' => [ 'index'],
//                'duration' => 60,
//                ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'timezone' => [
                'class' => 'yii2mod\timezone\TimezoneAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    function actionIndex()
    {
        $signup = new SignupForm();
        $settings = Settings::findOne(1);
        $model = new Order();
        $file = new File();
        $ratingCount = Rating::find()->count();
        $timezone = Yii::$app->timezone->name;
        $allorders = Uniqueid::findOne(1);
        $clients = $allorders->userid + $ratingCount;
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        $count == 0 ? $count = 1 : $count;
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('index', [
            'model' => $model,
            'settings' => $settings,
            'signup' => $signup,
            'clientCount' => $clients,
            'file' => $file,
            'ratings' => $ratings,
            'allorders' => $allorders->orderid,
            'timezone' => $timezone,
            'avgrating' => $avgrating
        ]);
    }

    function actionSampleArticles()
    {
        $model = new Order();
        $signup = new SignupForm();
        $fmodel = new Frontorder();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('sample-article', [
            'frontmodel' => $fmodel,
            'model' => $model,
            'signup' => $signup
        ]);
    }

    function actionSignup()
    {
        $this->layout = 'main';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['order/index']);
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    function actionSample()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('sample', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionCreateOrder()
    {
        $userModel = new SignupForm();
        $session = Yii::$app->session;
        $model = new Order();
        if ($userModel->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {

            // for service
            $service = Service::obtainService($model->service_id);

            //for order type
            $type = Type::getOrderType($model->type_id);

            // for order level
            $level = Level::getOrderLevel($model->level_id);

            // for pages
            $pages = Pages::getOrderPages($model->pages_id);

            // for urgency
            $urgency = Urgency::getOrderUrgency($model->urgency_id);

            // for deadline
            $deadline = Urgency::getOrderDeadline($model->urgency_id);

            //for spacing
            $spacing = Spacing::getOrderSpacing($model->spacing_id);

            // Promocode
            if ($model->promocode == Yii::$app->params['couponcode']) {
                $promo = Yii::$app->params['couponamt'];
            } else {
                $promo = 1;
            }

            $model->amount = number_format(floatval($spacing * $deadline * $service * $level * $pages * $type * $promo), 2, '.', '');

            //calculate the time in hours and days
            $seconds = $urgency * 3600;
            $dt1 = new \DateTime("@0");
            $dt2 = new \DateTime("@$seconds");
            $hrsanddays = $dt1->diff($dt2)->format('+%a day +%h hour');
            //get the time from the db in UTC and convert it client timezone
            $startTime = new \DateTime('' . $model->created_at . '', new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
            $ptime = $startTime->format("Y-m-d H:i:s");
            // calculate the future deadline and display it
            $cenvertedTime = date('Y-m-d H:i:s', strtotime('' . $hrsanddays . '', strtotime($ptime)));
            $model->deadline = $cenvertedTime;

            if (Yii::$app->user->isGuest) {
                $theuser = User::findOne(['email' => $userModel->email]);
                if ($theuser) {
                    Yii::$app->session->setFlash('danger', 'You already have an account with us, please login to create order. If you have forgotten your password, please reset.');
                    return $this->redirect(['login']);
                } else if ($user = $userModel->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        $model->created_by = Yii::$app->user->id;
                        $orderid = Uniqueid::find()->where(['id' => 1])->one();
                        $orderid->orderid = $orderid->orderid + 1;
                        $model->ordernumber = $orderid->orderid;
                        $connection = \Yii::$app->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            $orderid->save();
                            $model->save();
                            unset($session['service_id']);
                            unset($session['type_id']);
                            unset($session['urgency_id']);
                            unset($session['pages_id']);
                            unset($session['level_id']);
//                    Notification::success(Notification::KEY_NEW_ORDER, 1, $model->id);
                            Notification::success(Notification::KEY_NEW_ORDER, 919, $model->id);
                            $notifys = \app\models\Notification::find()->where(['key_id' => $model->id, 'seen' => 0])->all();
                            foreach ($notifys as $notify) {
                                $notify->order_number = $model->ordernumber;
                                $notify->save();
                            }
                            $transaction->commit();
                        } catch (\Exception $e) {
                            $transaction->rollBack();
                            throw new   $e;
                        }
                    } else {
                        Yii::$app->session->setFlash('danger', 'The order was not created. Please include all the order details.');
                        return $this->redirect(['/']);
                    }
                }
                return $this->redirect(['order/view', 'oid' => $model->ordernumber]);
            } else {
                if ($model->load(Yii::$app->request->post())) {

                    $model->created_by = Yii::$app->user->id;
                    $orderid = Uniqueid::find()->where(['id' => 1])->one();
                    $orderid->orderid = $orderid->orderid + 1;
                    $model->ordernumber = $orderid->orderid;
                    $connection = \Yii::$app->db;
                    $transaction = $connection->beginTransaction();
                    try {
                        $orderid->save();
                        $model->save();
                        unset($session['service_id']);
                        unset($session['type_id']);
                        unset($session['urgency_id']);
                        unset($session['pages_id']);
                        unset($session['level_id']);
//            Notification::success(Notification::KEY_NEW_ORDER, 1, $model->id);
                        Notification::success(Notification::KEY_NEW_ORDER, 919, $model->id);
                        $notifys = \app\models\Notification::find()->where(['key_id' => $model->id, 'seen' => 0])->all();
                        foreach ($notifys as $notify) {
                            $notify->order_number = $model->ordernumber;
                            $notify->save();
                        }

                        $transaction->commit();
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw new   $e;
                    }
                    return $this->redirect(['order/view', 'oid' => $model->ordernumber]);

                } else {
                    Yii::$app->session->setFlash('danger', 'The order was not created. Please include all the order details.');
                    return $this->redirect(['/']);
                }
            }
        } else {
            return $this->redirect(['/']);
        }
    }


    function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();

    }


    function actionTest()
    {
        $result = User::generateRandomPassword();

        return $result;
    }

    //...

    /**
     * Requests password reset.
     *
     * @return mixed
     */

    function actionRequestPasswordReset()
    {
        $this->layout = 'main';
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }

        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */

    function actionResetPassword($token)
    {
        $this->layout = 'main';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    function actionAccount()
    {
        $this->layout = 'order';
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $user_id = Yii::$app->user->id;
        $user = User::findOne($user_id);
        $model = ChangePassword::findOne($user_id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (User::ValidatePass($model->current_password, $user->password_hash)) {
                $user->setPassword($model->new_password);
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'The new password was updated');
                    return $this->redirect(['order/index']);
                } else {
                    Yii::$app->session->setFlash('danger', 'Opps! There was a problem');
                    return $this->redirect(['order/index']);
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Opps! Please enter the correct current password');
                return $this->redirect(['order/index']);
            }
        }
        //chaange password code here
        return $this->render('account', [
            'model' => $model
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */

    function actionLogin()
    {
        $this->layout = 'main';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['order/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    function actionTerms_and_conditions()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('terms_and_conditions', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionPrivacy_policy()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('privacy_policy', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionHow_it_works()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('how_it_works', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionApiLogin($email, $token)
    {

        $mytoken = Yii::$app->jwt->getParser()->parse((string)$token);
        $data = Yii::$app->jwt->getValidationData();
        $valid = $mytoken->validate($data);
        if ($valid) {
            $claimId = $mytoken->getClaim('uid');
            $user = User::findByEmail($email);
            if ($claimId == $user->getId()) {
                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                return Yii::$app->response->redirect(Url::to(['order/index']));
            } else {
                return Yii::$app->response->redirect(Yii::$app->params[$user->site_code]);
            }
        } else {
            $result = ['status' => '101', 'message' => 'Authentication token was invalid'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        }
    }


    function actionServices()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('services', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionBrit()
    {
        Image::open(Yii::getAlias('@webroot/images/slides/testimon.jpg'))
            ->sharp()
            ->save(Yii::getAlias('@webroot/images/slides/testimonials3.jpg'));
        return $this->redirect(['index']);

    }


    function actionFaq()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('faq', [
            'signup' => $signup,
            'model' => $model
        ]);
    }


    function actionBlogs()
    {
        return $this->render('blogs');
    }


    function actionReviews()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        $query = Rating::find()->orderBy('id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15]);
        $ratings = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('reviews', [
            'ratings' => $ratings,
            'pagination' => $pages
        ]);
    }


    function actionGuarantee()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('guarantee', [
            'signup' => $signup,
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */

    function actionLogout()
    {
        $user = User::findOne(Yii::$app->user->id);
        $siteCode = $user->site_code;
        if ($siteCode == 1) {
            Yii::$app->user->logout();
            return $this->goHome();
        } else {
            Yii::$app->user->logout();
            return $this->redirect('https://topratedprofessors.com');
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    function actionContact()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['supportEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    function actionArticle($slug)
    {
        $model = new Order();
        $signup = new SignupForm();
        $fmodel = new Frontorder();
        $article = Article::findOne(['slug' => $slug]);
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('article', [
            'frontmodel' => $fmodel,
            'article' => $article,
            'model' => $model,
            'signup' => $signup
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */

    function actionAbout()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating = $totalrating / $count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('about');
    }
}
