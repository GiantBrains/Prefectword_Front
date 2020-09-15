<?php

namespace app\controllers;

use app\models\Article;
use app\models\Auth;
use app\models\AuthHandler;
use app\models\ChangePassword;
use app\models\Order;
use app\models\PasswordResetRequestForm;
use app\models\Rating;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\Uniqueid;
use \app\components\Notification;
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
    public function behaviors()
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
    public function actions()
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
    public function actionIndex()
    {
        $signup = new SignupForm();
        $model = new Order();
        $fmodel = new Frontorder();
        $timezone = Yii::$app->timezone->name;
        $allorders = Uniqueid::findOne(1);
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('index', [
            'fmodel' => $fmodel,
            'model' => $model,
            'signup'=> $signup,
            'ratings'=>$ratings,
            'allorders'=>$allorders->orderid,
            'timezone'=> $timezone,
            'avgrating'=>$avgrating
        ]);
    }

    public function actionSampleArticles()
    {
        $model = new Order();
        $signup = new SignupForm();
        $fmodel = new Frontorder();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('sample-article',[
            'frontmodel'=>$fmodel,
            'model'=>$model,
            'signup'=>$signup
        ]);
    }

    public function actionSignup()
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

    public function actionSample()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('sample',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }


    public function actionCreateOrder()
    {
        $userModel =new SignupForm();
        $session = Yii::$app->session;
        $model = new Order();
        if (Yii::$app->user->isGuest) {

        if ($userModel->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()))
        {
            $theuser = User::findOne(['email'=>$userModel->email]);
            if ($theuser) {
                Yii::$app->session->setFlash('danger','You already have an account with us, please login to create order. If you have forgotten your password, please reset.');
                return $this->redirect(['login']);
            }else if ($user = $userModel->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                    // for service
                    if($model->service_id==1){
                        $service = 8;
                    }else if($model->service_id==2){
                        $service=6;
                    }else if($model->service_id==3){
                        $service= 5;
                    }

                    //for order type
                    if($model->type_id==1){
                        $type = 1.2;
                    }else if ($model->type_id==2){
                        $type = 1.2;
                    }else if ($model->type_id==3){
                        $type = 1.2;
                    }else if ($model->type_id==4){
                        $type = 1.2;
                    }else if ($model->type_id==5){
                        $type = 1.2;
                    }else if ($model->type_id==6){
                        $type = 1.2;
                    }else if ($model->type_id==7){
                        $type = 1.2;
                    }else if ($model->type_id==8){
                        $type = 1.2;
                    }else if ($model->type_id==9){
                        $type = 1.2;
                    }else if ($model->type_id==10){
                        $type = 1.2;
                    }else if ($model->type_id==11){
                        $type = 1.2;
                    }else if ($model->type_id==12){
                        $type = 1.2;
                    }else if ($model->type_id==13){
                        $type = 1.2;
                    }else if ($model->type_id==14){
                        $type = 1.2;
                    }else if ($model->type_id==15){
                        $type = 1.2;
                    }else if ($model->type_id==16){
                        $type = 1.2;
                    }else if ($model->type_id==17){
                        $type = 1.2;
                    }else if ($model->type_id==18){
                        $type = 1.2;
                    }else if ($model->type_id==20){
                        $type = 1.2;
                    }else if ($model->type_id==22){
                        $type = 2.0;
                    }else if ($model->type_id==23){
                        $type = 2.2;
                    }else if ($model->type_id==24){
                        $type = 1.5;
                    }else if ($model->type_id==25){
                        $type = 1.2;
                    }else if ($model->type_id==26){
                        $type = 1.2;
                    }else if ($model->type_id==27){
                        $type = 0.7;
                    }else if ($model->type_id==28){
                        $type = 0.8;
                    }else if ($model->type_id==31){
                        $type = 1.2;
                    }else if ($model->type_id==32){
                        $type = 1.2;
                    }else if ($model->type_id==33){
                        $type = 1.2;
                    }else if ($model->type_id==34){
                        $type = 1.2;
                    }else if ($model->type_id==35){
                        $type = 2.2;
                    }else if ($model->type_id==36){
                        $type = 1.2;
                    }else if ($model->type_id==37){
                        $type = 1.2;
                    }else if ($model->type_id==38){
                        $type = 1.2;
                    }else if ($model->type_id==39){
                        $type = 1.5;
                    }else if ($model->type_id==40){
                        $type = 1.2;
                    }else if ($model->type_id==41){
                        $type = 1.4;
                    }else if ($model->type_id==42){
                        $type = 1.4;
                    }else if ($model->type_id==43){
                        $type = 1.4;
                    }else if ($model->type_id==44){
                        $type = 1.3;
                    }else if ($model->type_id==45){
                        $type = 1.2;
                    }

                    // for order level
                    if($model->level_id==1){
                        $level = 1;
                    }else if($model->level_id==2){
                        $level=1.2;
                    }else if($model->level_id==4){
                        $level= 1.3;
                    }else if($model->level_id==5){
                        $level= 1.5;
                    }

                    // for pages
                    if($model->pages_id==1){
                        $pages = 1;
                    }else if($model->pages_id==2){
                        $pages=2*0.95;
                    }else if($model->pages_id==3){
                        $pages= 3*0.95;
                    }else if($model->pages_id==4){
                        $pages=4*0.95;
                    }else if($model->pages_id==5){
                        $pages= 5*0.95;
                    }else if($model->pages_id==6){
                        $pages=6*0.925;
                    }else if($model->pages_id==7){
                        $pages= 7*0.925;
                    }else if($model->pages_id==8){
                        $pages=8*0.925;
                    }else if($model->pages_id==9){
                        $pages= 9*0.925;
                    }else if($model->pages_id==10){
                        $pages=10*0.9;
                    }else if($model->pages_id==11){
                        $pages= 11*0.9;
                    }else if($model->pages_id==12){
                        $pages=12*0.9;
                    }else if($model->pages_id==13){
                        $pages= 13*0.9;
                    }else if($model->pages_id==14){
                        $pages=14*0.9;
                    }else if($model->pages_id==15){
                        $pages= 15*0.9;
                    }else if($model->pages_id==16){
                        $pages=16*0.9;
                    }else if($model->pages_id==17){
                        $pages= 17*0.9;
                    }else if($model->pages_id==18){
                        $pages=18*0.9;
                    }else if($model->pages_id==19){
                        $pages= 19*0.9;
                    }else if($model->pages_id==20){
                        $pages=20*0.9;
                    }else if($model->pages_id==21){
                        $pages= 21*0.85;
                    }else if($model->pages_id==22){
                        $pages=22*0.85;
                    }else if($model->pages_id==23){
                        $pages= 23*0.85;
                    }else if($model->pages_id==24){
                        $pages=24*0.85;
                    }else if($model->pages_id==25){
                        $pages= 25*0.85;
                    }else if($model->pages_id==26){
                        $pages=26*0.85;
                    }else if($model->pages_id==27){
                        $pages= 27*0.85;
                    }else if($model->pages_id==28){
                        $pages=28*0.85;
                    }else if($model->pages_id==29){
                        $pages= 29*0.85;
                    }else if($model->pages_id==30){
                        $pages=30*0.85;
                    }else if($model->pages_id==31){
                        $pages= 31*0.85;
                    }else if($model->pages_id==32){
                        $pages=32*0.85;
                    }else if($model->pages_id==33){
                        $pages= 33*0.85;
                    }else if($model->pages_id==34){
                        $pages=34*0.85;
                    }else if($model->pages_id==35){
                        $pages= 35*0.85;
                    }else if($model->pages_id==36){
                        $pages=36*0.85;
                    }else if($model->pages_id==37){
                        $pages= 37*0.85;
                    }else if($model->pages_id==38){
                        $pages=38*0.85;
                    }else if($model->pages_id==39){
                        $pages= 39*0.85;
                    }else if($model->pages_id==40){
                        $pages=40*0.85;
                    }else if($model->pages_id==41){
                        $pages= 41*0.85;
                    }else if($model->pages_id==42){
                        $pages=42*0.85;
                    }else if($model->pages_id==43){
                        $pages= 43*0.85;
                    }else if($model->pages_id==44){
                        $pages=44*0.85;
                    }else if($model->pages_id==45){
                        $pages= 45*0.85;
                    }else if($model->pages_id==46){
                        $pages=46*0.85;
                    }else if($model->pages_id==47){
                        $pages=47*0.85;
                    }else if($model->pages_id==48){
                        $pages=48*0.85;
                    }else if($model->pages_id==49){
                        $pages= 49*0.85;
                    }else if($model->pages_id==50){
                        $pages=50*0.85;
                    }else if($model->pages_id==51){
                        $pages= 51*0.85;
                    }else if($model->pages_id==52){
                        $pages=52*0.85;
                    }else if($model->pages_id==53){
                        $pages= 53*0.85;
                    }else if($model->pages_id==54){
                        $pages=54*0.85;
                    }else if($model->pages_id==55){
                        $pages= 55*0.85;
                    }else if($model->pages_id==56){
                        $pages=56*0.85;
                    }else if($model->pages_id==57){
                        $pages= 57*0.85;
                    }else if($model->pages_id==58){
                        $pages=58*0.85;
                    }else if($model->pages_id==59){
                        $pages= 59*0.85;
                    }else if($model->pages_id==60){
                        $pages=60*0.85;
                    }else if($model->pages_id==61){
                        $pages= 61*0.85;
                    }else if($model->pages_id==62){
                        $pages=62*0.85;
                    }else if($model->pages_id==63){
                        $pages= 63*0.85;
                    }else if($model->pages_id==64){
                        $pages=64*0.85;
                    }else if($model->pages_id==65){
                        $pages= 65*0.85;
                    }else if($model->pages_id==66){
                        $pages=66*0.85;
                    }else if($model->pages_id==67){
                        $pages= 67*0.85;
                    }else if($model->pages_id==68){
                        $pages=68*0.85;
                    }else if($model->pages_id==69){
                        $pages= 69*0.85;
                    }else if($model->pages_id==70){
                        $pages=70*0.85;
                    }else if($model->pages_id==71){
                        $pages= 71*0.85;
                    }else if($model->pages_id==72){
                        $pages=72*0.85;
                    }else if($model->pages_id==73){
                        $pages= 73*0.85;
                    }else if($model->pages_id==74){
                        $pages=74*0.85;
                    }else if($model->pages_id==75){
                        $pages= 75*0.85;
                    }else if($model->pages_id==76){
                        $pages=76*0.85;
                    }else if($model->pages_id==77){
                        $pages= 77*0.85;
                    }else if($model->pages_id==78){
                        $pages=78*0.85;
                    }else if($model->pages_id==79){
                        $pages= 79*0.85;
                    }else if($model->pages_id==80){
                        $pages=80*0.85;
                    }else if($model->pages_id==81){
                        $pages= 81*0.85;
                    }else if($model->pages_id==82){
                        $pages=82*0.85;
                    }else if($model->pages_id==83){
                        $pages= 83*0.85;
                    }else if($model->pages_id==84){
                        $pages=84*0.85;
                    }else if($model->pages_id==85){
                        $pages= 85*0.85;
                    }else if($model->pages_id==86){
                        $pages=86*0.85;
                    }else if($model->pages_id==87){
                        $pages= 87*0.85;
                    }else if($model->pages_id==88){
                        $pages=88*0.85;
                    }else if($model->pages_id==89){
                        $pages= 89;
                    }else if($model->pages_id==90){
                        $pages=90*0.85;
                    }else if($model->pages_id==91){
                        $pages= 91*0.85;
                    }else if($model->pages_id==92){
                        $pages=92*0.85;
                    }else if($model->pages_id==93){
                        $pages= 93*0.85;
                    }else if($model->pages_id==94){
                        $pages=94*0.85;
                    }else if($model->pages_id==95){
                        $pages= 95*0.85;
                    }else if($model->pages_id==96){
                        $pages=96*0.85;
                    }else if($model->pages_id==97){
                        $pages= 97*0.85;
                    }else if($model->pages_id==98){
                        $pages=98*0.85;
                    }else if($model->pages_id==99){
                        $pages= 99*0.85;
                    }else if($model->pages_id==100){
                        $pages=100*0.85;
                    }else if($model->pages_id==101){
                        $pages= 101*0.85;
                    }else if($model->pages_id==102){
                        $pages=102*0.85;
                    }else if($model->pages_id==103){
                        $pages= 103*0.85;
                    }else if($model->pages_id==104){
                        $pages=104*0.85;
                    }else if($model->pages_id==105){
                        $pages= 105*0.85;
                    }else if($model->pages_id==106){
                        $pages=106*0.85;
                    }else if($model->pages_id==107){
                        $pages= 107*0.85;
                    }else if($model->pages_id==108){
                        $pages=108*0.85;
                    }else if($model->pages_id==109){
                        $pages= 109*0.85;
                    }else if($model->pages_id==110){
                        $pages=110*0.85;
                    }else if($model->pages_id==111){
                        $pages= 111*0.85;
                    }else if($model->pages_id==112){
                        $pages=112*0.85;
                    }else if($model->pages_id==113){
                        $pages= 113*0.85;
                    }else if($model->pages_id==114){
                        $pages=114*0.85;
                    }else if($model->pages_id==115){
                        $pages= 115*0.85;
                    }else if($model->pages_id==116){
                        $pages=116*0.85;
                    }else if($model->pages_id==117){
                        $pages= 117*0.85;
                    }else if($model->pages_id==118){
                        $pages=118*0.85;
                    }else if($model->pages_id==119){
                        $pages= 119*0.85;
                    }else if($model->pages_id==120){
                        $pages=120*0.85;
                    }else if($model->pages_id==121){
                        $pages= 121*0.85;
                    }else if($model->pages_id==122){
                        $pages=122*0.85;
                    }else if($model->pages_id==123){
                        $pages= 123*0.85;
                    }else if($model->pages_id==124){
                        $pages=124*0.85;
                    }else if($model->pages_id==125){
                        $pages= 125*0.85;
                    }else if($model->pages_id==126){
                        $pages=126*0.85;
                    }else if($model->pages_id==127){
                        $pages= 127*0.85;
                    }else if($model->pages_id==128){
                        $pages=128*0.85;
                    }else if($model->pages_id==129){
                        $pages= 129*0.85;
                    }else if($model->pages_id==130){
                        $pages=130*0.85;
                    }else if($model->pages_id==131){
                        $pages= 131*0.85;
                    }else if($model->pages_id==132){
                        $pages=132*0.85;
                    }else if($model->pages_id==133){
                        $pages= 133*0.85;
                    }else if($model->pages_id==134){
                        $pages=134*0.85;
                    }else if($model->pages_id==135){
                        $pages= 135*0.85;
                    }else if($model->pages_id==136){
                        $pages=136*0.85;
                    }else if($model->pages_id==137){
                        $pages= 137*0.85;
                    }else if($model->pages_id==138){
                        $pages=138*0.85;
                    }else if($model->pages_id==139){
                        $pages= 139*0.85;
                    }else if($model->pages_id==140){
                        $pages=140*0.85;
                    }else if($model->pages_id==141){
                        $pages= 141*0.85;
                    }else if($model->pages_id==142){
                        $pages=142*0.85;
                    }else if($model->pages_id==143){
                        $pages= 143*0.85;
                    }else if($model->pages_id==144){
                        $pages=144*0.85;
                    }else if($model->pages_id==145){
                        $pages= 145*0.85;
                    }else if($model->pages_id==146){
                        $pages=146*0.85;
                    }else if($model->pages_id==147){
                        $pages= 147*0.85;
                    }else if($model->pages_id==148){
                        $pages=148*0.85;
                    }else if($model->pages_id==149){
                        $pages= 149*0.85;
                    }else if($model->pages_id==150){
                        $pages=150*0.85;
                    }else if($model->pages_id==151){
                        $pages= 151*0.85;
                    }else if($model->pages_id==152){
                        $pages=152*0.85;
                    }else if($model->pages_id==153){
                        $pages= 153*0.85;
                    }else if($model->pages_id==154){
                        $pages=154*0.85;
                    }else if($model->pages_id==155){
                        $pages= 155*0.85;
                    }else if($model->pages_id==156){
                        $pages=156*0.85;
                    }else if($model->pages_id==157){
                        $pages= 157*0.85;
                    }else if($model->pages_id==158){
                        $pages=158*0.85;
                    }else if($model->pages_id==159){
                        $pages= 159*0.85;
                    }else if($model->pages_id==160){
                        $pages=160*0.85;
                    }else if($model->pages_id==161){
                        $pages= 161*0.85;
                    }else if($model->pages_id==162){
                        $pages=162*0.85;
                    }else if($model->pages_id==163){
                        $pages= 163*0.85;
                    }else if($model->pages_id==164){
                        $pages=164*0.85;
                    }else if($model->pages_id==165){
                        $pages= 165*0.85;
                    }else if($model->pages_id==166){
                        $pages=166*0.85;
                    }else if($model->pages_id==167){
                        $pages= 167*0.85;
                    }else if($model->pages_id==168){
                        $pages=168*0.85;
                    }else if($model->pages_id==169){
                        $pages= 169*0.85;
                    }else if($model->pages_id==170){
                        $pages=170*0.85;
                    }else if($model->pages_id==171){
                        $pages= 171*0.85;
                    }else if($model->pages_id==172){
                        $pages=172*0.85;
                    }else if($model->pages_id==173){
                        $pages= 173*0.85;
                    }else if($model->pages_id==174){
                        $pages=174*0.85;
                    }else if($model->pages_id==175){
                        $pages= 175*0.85;
                    }else if($model->pages_id==176){
                        $pages=176*0.85;
                    }else if($model->pages_id==177){
                        $pages= 177*0.85;
                    }else if($model->pages_id==178){
                        $pages=178*0.85;
                    }else if($model->pages_id==179){
                        $pages= 179*0.85;
                    }else if($model->pages_id==180){
                        $pages=180*0.85;
                    }else if($model->pages_id==181){
                        $pages= 181*0.85;
                    }else if($model->pages_id==182){
                        $pages=182*0.85;
                    }else if($model->pages_id==183){
                        $pages= 183*0.85;
                    }else if($model->pages_id==184){
                        $pages=184*0.85;
                    }else if($model->pages_id==185){
                        $pages= 185*0.85;
                    }else if($model->pages_id==186){
                        $pages=186*0.85;
                    }else if($model->pages_id==187){
                        $pages= 187*0.85;
                    }else if($model->pages_id==188){
                        $pages=188*0.85;
                    }else if($model->pages_id==189){
                        $pages= 189*0.85;
                    }else if($model->pages_id==190){
                        $pages=190*0.85;
                    }else if($model->pages_id==191){
                        $pages= 191*0.85;
                    }else if($model->pages_id==192){
                        $pages=192*0.85;
                    }else if($model->pages_id==193){
                        $pages= 193*0.85;
                    }else if($model->pages_id==194){
                        $pages=194*0.85;
                    }else if($model->pages_id==195){
                        $pages= 195*0.85;
                    }else if($model->pages_id==196){
                        $pages=196*0.85;
                    }else if($model->pages_id==197){
                        $pages= 197*0.85;
                    }else if($model->pages_id==198){
                        $pages=198*0.85;
                    }else if($model->pages_id==199){
                        $pages= 199*0.85;
                    }else if($model->pages_id==200){
                        $pages=200*0.85;
                    }

                    //single spaced
                    else if($model->pages_id==201){
                        $pages= 1;
                    }else if($model->pages_id==202){
                        $pages=2*0.95;
                    }else if($model->pages_id==203){
                        $pages= 3*0.95;
                    }else if($model->pages_id==204){
                        $pages= 4*0.95;
                    }else if($model->pages_id==205){
                        $pages= 5*0.95;
                    }else if($model->pages_id==206){
                        $pages=6*0.925;
                    }else if($model->pages_id==207){
                        $pages= 7*0.925;
                    }else if($model->pages_id==208){
                        $pages=8*0.925;
                    }else if($model->pages_id==209){
                        $pages= 9*0.925;
                    }else if($model->pages_id==210){
                        $pages=10*0.90;
                    }else if($model->pages_id==211){
                        $pages= 11*0.90;
                    }else if($model->pages_id==212){
                        $pages=12*0.90;
                    }else if($model->pages_id==213){
                        $pages= 13*0.90;
                    }else if($model->pages_id==214){
                        $pages=14*0.90;
                    }else if($model->pages_id==215){
                        $pages= 15*0.90;
                    }else if($model->pages_id==216){
                        $pages=16*0.90;
                    }else if($model->pages_id==217){
                        $pages= 17*0.90;
                    }else if($model->pages_id==218){
                        $pages=18*0.90;
                    }else if($model->pages_id==219){
                        $pages= 19*0.90;
                    }else if($model->pages_id==220){
                        $pages=20*0.90;
                    }else if($model->pages_id==221){
                        $pages= 21*0.85;
                    }else if($model->pages_id==222){
                        $pages=22*0.85;
                    }else if($model->pages_id==223){
                        $pages= 23*0.85;
                    }else if($model->pages_id==224){
                        $pages=24*0.85;
                    }else if($model->pages_id==225){
                        $pages= 25*0.85;
                    }else if($model->pages_id==226){
                        $pages=26*0.85;
                    }else if($model->pages_id==227){
                        $pages= 27*0.85;
                    }else if($model->pages_id==228){
                        $pages=28*0.85;
                    }else if($model->pages_id==229){
                        $pages= 29*0.85;
                    }else if($model->pages_id==230){
                        $pages=30*0.85;
                    }else if($model->pages_id==231){
                        $pages= 31*0.85;
                    }else if($model->pages_id==232){
                        $pages=32*0.85;
                    }else if($model->pages_id==233){
                        $pages= 33*0.85;
                    }else if($model->pages_id==234){
                        $pages=34*0.85;
                    }else if($model->pages_id==235){
                        $pages= 35*0.85;
                    }else if($model->pages_id==236){
                        $pages=36*0.85;
                    }else if($model->pages_id==237){
                        $pages= 37*0.85;
                    }else if($model->pages_id==238){
                        $pages=38*0.85;
                    }else if($model->pages_id==239){
                        $pages= 39*0.85;
                    }else if($model->pages_id==240){
                        $pages=40*0.85;
                    }else if($model->pages_id==241){
                        $pages= 41*0.85;
                    }else if($model->pages_id==242){
                        $pages=42*0.85;
                    }else if($model->pages_id==243){
                        $pages= 43*0.85;
                    }else if($model->pages_id==244){
                        $pages=44*0.85;
                    }else if($model->pages_id==245){
                        $pages= 45*0.85;
                    }else if($model->pages_id==246){
                        $pages=46*0.85;
                    }else if($model->pages_id==247){
                        $pages= 47*0.85;
                    }else if($model->pages_id==248){
                        $pages=48*0.85;
                    }else if($model->pages_id==249){
                        $pages= 49*0.85;
                    }else if($model->pages_id==250){
                        $pages=50*0.85;
                    }else if($model->pages_id==251){
                        $pages= 51*0.85;
                    }else if($model->pages_id==252){
                        $pages=52*0.85;
                    }else if($model->pages_id==253){
                        $pages= 53*0.85;
                    }else if($model->pages_id==254){
                        $pages=54*0.85;
                    }else if($model->pages_id==255){
                        $pages= 55*0.85;
                    }else if($model->pages_id==256){
                        $pages=56*0.85;
                    }else if($model->pages_id==257){
                        $pages= 57*0.85;
                    }else if($model->pages_id==258){
                        $pages=58*0.85;
                    }else if($model->pages_id==259){
                        $pages= 59*0.85;
                    }else if($model->pages_id==260){
                        $pages=60*0.85;
                    }else if($model->pages_id==261){
                        $pages= 61*0.85;
                    }else if($model->pages_id==262){
                        $pages=62*0.85;
                    }else if($model->pages_id==263){
                        $pages= 63*0.85;
                    }else if($model->pages_id==264){
                        $pages=64*0.85;
                    }else if($model->pages_id==265){
                        $pages= 65*0.85;
                    }else if($model->pages_id==266){
                        $pages=66*0.85;
                    }else if($model->pages_id==267){
                        $pages= 67*0.85;
                    }else if($model->pages_id==268){
                        $pages=68*0.85;
                    }else if($model->pages_id==269){
                        $pages= 69*0.85;
                    }else if($model->pages_id==270){
                        $pages=70*0.85;
                    }else if($model->pages_id==271){
                        $pages= 71*0.85;
                    }else if($model->pages_id==272){
                        $pages=72*0.85;
                    }else if($model->pages_id==273){
                        $pages= 73*0.85;
                    }else if($model->pages_id==274){
                        $pages=74*0.85;
                    }else if($model->pages_id==275){
                        $pages= 75*0.85;
                    }else if($model->pages_id==276){
                        $pages=76*0.85;
                    }else if($model->pages_id==277){
                        $pages= 77*0.85;
                    }else if($model->pages_id==278){
                        $pages=78*0.85;
                    }else if($model->pages_id==279){
                        $pages= 79*0.85;
                    }else if($model->pages_id==280){
                        $pages=80*0.85;
                    }else if($model->pages_id==281){
                        $pages= 81*0.85;
                    }else if($model->pages_id==282){
                        $pages=82*0.85;
                    }else if($model->pages_id==283){
                        $pages= 83*0.85;
                    }else if($model->pages_id==284){
                        $pages=84*0.85;
                    }else if($model->pages_id==285){
                        $pages= 85*0.85;
                    }else if($model->pages_id==286){
                        $pages=86*0.85;
                    }else if($model->pages_id==287){
                        $pages= 87*0.85;
                    }else if($model->pages_id==288){
                        $pages=88*0.85;
                    }else if($model->pages_id==289){
                        $pages= 89*0.85;
                    }else if($model->pages_id==290){
                        $pages=90*0.85;
                    }else if($model->pages_id==291){
                        $pages= 91*0.85;
                    }else if($model->pages_id==292){
                        $pages=92*0.85;
                    }else if($model->pages_id==293){
                        $pages= 93*0.85;
                    }else if($model->pages_id==294){
                        $pages=94*0.85;
                    }else if($model->pages_id==295){
                        $pages= 95*0.85;
                    }else if($model->pages_id==296){
                        $pages=96*0.85;
                    }else if($model->pages_id==297){
                        $pages= 97*0.85;
                    }else if($model->pages_id==298){
                        $pages=98*0.85;
                    }else if($model->pages_id==299){
                        $pages= 99*0.85;
                    }else if($model->pages_id==300){
                        $pages=100*0.85;
                    }

                    // for urgency
                    if ($model->urgency_id == 1) {
                        $urgency = 3;
                    } elseif ($model->urgency_id == 2) {
                        $urgency = 6;
                    } elseif ($model->urgency_id == 3) {
                        $urgency = 12;
                    } elseif ($model->urgency_id == 4) {
                        $urgency = 24;
                    } elseif ($model->urgency_id == 5) {
                        $urgency = 48;
                    } elseif ($model->urgency_id == 6) {
                        $urgency = 72;
                    } elseif ($model->urgency_id == 7) {
                        $urgency = 96;
                    } elseif ($model->urgency_id == 8) {
                        $urgency = 120;
                    } elseif ($model->urgency_id == 9) {
                        $urgency = 144;
                    } elseif ($model->urgency_id == 10) {
                        $urgency = 168;
                    } elseif ($model->urgency_id == 11) {
                        $urgency = 192;
                    } elseif ($model->urgency_id == 12) {
                        $urgency = 240;
                    } elseif ($model->urgency_id == 13) {
                        $urgency = 336;
                    } elseif ($model->urgency_id == 14) {
                        $urgency = 672;
                    } elseif ($model->urgency_id == 15) {
                        $urgency = 1344;
                    }

                    if($model->urgency_id==1){
                        $deadline = 2.5;
                    }else if ($model->urgency_id==2){
                        $deadline = 2.0;
                    }else if ($model->urgency_id==3){
                        $deadline = 1.8;
                    }else if ($model->urgency_id==4){
                        $deadline = 1.6;
                    }else if ($model->urgency_id==5){
                        $deadline = 1.5;
                    }else if ($model->urgency_id==6){
                        $deadline = 1.4;
                    }else if ($model->urgency_id==7){
                        $deadline = 1.3;
                    }else if ($model->urgency_id==8){
                        $deadline = 1.2;
                    }else if ($model->urgency_id==9){
                        $deadline = 1.2;
                    }else if ($model->urgency_id==10){
                        $deadline= 1.1;
                    }else if ($model->urgency_id==11){
                        $deadline = 1.1;
                    }else if ($model->urgency_id==12){
                        $deadline = 1.1;
                    }else if ($model->urgency_id==13){
                        $deadline = 1.0;
                    }else if ($model->urgency_id==14){
                        $deadline = 1.0;
                    }else if ($model->urgency_id==15){
                        $deadline = 1.0;
                    }

                    //for spacing
                    if ($model->spacing_id == 1) {
                        $spacing = 1;
                    } elseif ($model->spacing_id == 2) {
                        $spacing = 2;
                    }

                    // Promocode
                    if ($model->promocode == Yii::$app->params['couponcode']){
                        $promo = Yii::$app->params['couponamt'];
                    }else{
                        $promo = 1;
                    }

                    $model->amount = number_format(floatval($spacing*$deadline*$service*$level*$pages*$type*$promo), 2, '.', ',');
                    //calculate the time in hours and days
                    $seconds = $urgency*3600;
                    $dt1 = new \DateTime("@0");
                    $dt2 = new \DateTime("@$seconds");
                    $hrsanddays = $dt1->diff($dt2)->format('+%a day +%h hour');
                    //get the time from the db in UTC and convert it client timezone
                    $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
                    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
                    $ptime = $startTime->format("Y-m-d H:i:s");
                    // calculate the future deadline and display it
                    $cenvertedTime = date('Y-m-d H:i:s',strtotime(''.$hrsanddays.'',strtotime($ptime)));
                    $model->deadline = $cenvertedTime;
                    $model->created_by = Yii::$app->user->id;
                    $orderid = Uniqueid::find()->where(['id'=>1])->one();
                    $orderid->orderid = $orderid->orderid+1;
                    $model->ordernumber = $orderid->orderid;
                    $orderid->save();
                    $model->save();
                    unset($session['service_id']);
                    unset($session['type_id']);
                    unset($session['urgency_id']);
                    unset($session['pages_id']);
                    unset($session['level_id']);
//                    Notification::success(Notification::KEY_NEW_ORDER, 1, $model->id);
                    Notification::success(Notification::KEY_NEW_ORDER, 7, $model->id);
                    $notifys = \app\models\Notification::find()->where(['key_id'=> $model->id, 'seen'=>0])->all();
                    foreach ($notifys as $notify) {
                        $notify->order_number = $model->ordernumber;
                        $notify->save();
                    }
                }else{
                    Yii::$app->session->setFlash('danger','The order was not created. Please include all the order details.');
                    return $this->redirect(['/']);
                }
            }
            return $this->redirect(['order/view', 'oid' => $model->ordernumber]);
        } else {
           return $this->redirect(['/']);
        }
    } else{
        if ($model->load(Yii::$app->request->post())) {
            // for service
            if ($model->service_id == 1) {
                $service = 8;
            } else if ($model->service_id == 2) {
                $service = 6;
            } else if ($model->service_id == 3) {
                $service = 5;
            }

            //for order type
            if ($model->type_id == 1) {
                $type = 1.2;
            } else if ($model->type_id == 2) {
                $type = 1.2;
            } else if ($model->type_id == 3) {
                $type = 1.2;
            } else if ($model->type_id == 4) {
                $type = 1.2;
            } else if ($model->type_id == 5) {
                $type = 1.2;
            } else if ($model->type_id == 6) {
                $type = 1.2;
            } else if ($model->type_id == 7) {
                $type = 1.2;
            } else if ($model->type_id == 8) {
                $type = 1.2;
            } else if ($model->type_id == 9) {
                $type = 1.2;
            } else if ($model->type_id == 10) {
                $type = 1.2;
            } else if ($model->type_id == 11) {
                $type = 1.2;
            } else if ($model->type_id == 12) {
                $type = 1.2;
            } else if ($model->type_id == 13) {
                $type = 1.2;
            } else if ($model->type_id == 14) {
                $type = 1.2;
            } else if ($model->type_id == 15) {
                $type = 1.2;
            } else if ($model->type_id == 16) {
                $type = 1.2;
            } else if ($model->type_id == 17) {
                $type = 1.2;
            } else if ($model->type_id == 18) {
                $type = 1.2;
            } else if ($model->type_id == 20) {
                $type = 1.2;
            } else if ($model->type_id == 22) {
                $type = 2.0;
            } else if ($model->type_id == 23) {
                $type = 2.2;
            } else if ($model->type_id == 24) {
                $type = 1.5;
            } else if ($model->type_id == 25) {
                $type = 1.2;
            } else if ($model->type_id == 26) {
                $type = 1.2;
            } else if ($model->type_id == 27) {
                $type = 0.7;
            } else if ($model->type_id == 28) {
                $type = 0.8;
            } else if ($model->type_id == 31) {
                $type = 1.2;
            } else if ($model->type_id == 32) {
                $type = 1.2;
            } else if ($model->type_id == 33) {
                $type = 1.2;
            } else if ($model->type_id == 34) {
                $type = 1.2;
            } else if ($model->type_id == 35) {
                $type = 2.2;
            } else if ($model->type_id == 36) {
                $type = 1.2;
            } else if ($model->type_id == 37) {
                $type = 1.2;
            } else if ($model->type_id == 38) {
                $type = 1.2;
            } else if ($model->type_id == 39) {
                $type = 1.5;
            } else if ($model->type_id == 40) {
                $type = 1.2;
            } else if ($model->type_id == 41) {
                $type = 1.4;
            } else if ($model->type_id == 42) {
                $type = 1.4;
            } else if ($model->type_id == 43) {
                $type = 1.4;
            } else if ($model->type_id == 44) {
                $type = 1.3;
            } else if ($model->type_id == 45) {
                $type = 1.2;
            }

            // for order level
            if ($model->level_id == 1) {
                $level = 1;
            } else if ($model->level_id == 2) {
                $level = 1.2;
            } else if ($model->level_id == 4) {
                $level = 1.3;
            } else if ($model->level_id == 5) {
                $level = 1.5;
            }

            // for pages
            if ($model->pages_id == 1) {
                $pages = 1;
            } else if ($model->pages_id == 2) {
                $pages = 2 * 0.95;
            } else if ($model->pages_id == 3) {
                $pages = 3 * 0.95;
            } else if ($model->pages_id == 4) {
                $pages = 4 * 0.95;
            } else if ($model->pages_id == 5) {
                $pages = 5 * 0.95;
            } else if ($model->pages_id == 6) {
                $pages = 6 * 0.925;
            } else if ($model->pages_id == 7) {
                $pages = 7 * 0.925;
            } else if ($model->pages_id == 8) {
                $pages = 8 * 0.925;
            } else if ($model->pages_id == 9) {
                $pages = 9 * 0.925;
            } else if ($model->pages_id == 10) {
                $pages = 10 * 0.9;
            } else if ($model->pages_id == 11) {
                $pages = 11 * 0.9;
            } else if ($model->pages_id == 12) {
                $pages = 12 * 0.9;
            } else if ($model->pages_id == 13) {
                $pages = 13 * 0.9;
            } else if ($model->pages_id == 14) {
                $pages = 14 * 0.9;
            } else if ($model->pages_id == 15) {
                $pages = 15 * 0.9;
            } else if ($model->pages_id == 16) {
                $pages = 16 * 0.9;
            } else if ($model->pages_id == 17) {
                $pages = 17 * 0.9;
            } else if ($model->pages_id == 18) {
                $pages = 18 * 0.9;
            } else if ($model->pages_id == 19) {
                $pages = 19 * 0.9;
            } else if ($model->pages_id == 20) {
                $pages = 20 * 0.9;
            } else if ($model->pages_id == 21) {
                $pages = 21 * 0.85;
            } else if ($model->pages_id == 22) {
                $pages = 22 * 0.85;
            } else if ($model->pages_id == 23) {
                $pages = 23 * 0.85;
            } else if ($model->pages_id == 24) {
                $pages = 24 * 0.85;
            } else if ($model->pages_id == 25) {
                $pages = 25 * 0.85;
            } else if ($model->pages_id == 26) {
                $pages = 26 * 0.85;
            } else if ($model->pages_id == 27) {
                $pages = 27 * 0.85;
            } else if ($model->pages_id == 28) {
                $pages = 28 * 0.85;
            } else if ($model->pages_id == 29) {
                $pages = 29 * 0.85;
            } else if ($model->pages_id == 30) {
                $pages = 30 * 0.85;
            } else if ($model->pages_id == 31) {
                $pages = 31 * 0.85;
            } else if ($model->pages_id == 32) {
                $pages = 32 * 0.85;
            } else if ($model->pages_id == 33) {
                $pages = 33 * 0.85;
            } else if ($model->pages_id == 34) {
                $pages = 34 * 0.85;
            } else if ($model->pages_id == 35) {
                $pages = 35 * 0.85;
            } else if ($model->pages_id == 36) {
                $pages = 36 * 0.85;
            } else if ($model->pages_id == 37) {
                $pages = 37 * 0.85;
            } else if ($model->pages_id == 38) {
                $pages = 38 * 0.85;
            } else if ($model->pages_id == 39) {
                $pages = 39 * 0.85;
            } else if ($model->pages_id == 40) {
                $pages = 40 * 0.85;
            } else if ($model->pages_id == 41) {
                $pages = 41 * 0.85;
            } else if ($model->pages_id == 42) {
                $pages = 42 * 0.85;
            } else if ($model->pages_id == 43) {
                $pages = 43 * 0.85;
            } else if ($model->pages_id == 44) {
                $pages = 44 * 0.85;
            } else if ($model->pages_id == 45) {
                $pages = 45 * 0.85;
            } else if ($model->pages_id == 46) {
                $pages = 46 * 0.85;
            } else if ($model->pages_id == 47) {
                $pages = 47 * 0.85;
            } else if ($model->pages_id == 48) {
                $pages = 48 * 0.85;
            } else if ($model->pages_id == 49) {
                $pages = 49 * 0.85;
            } else if ($model->pages_id == 50) {
                $pages = 50 * 0.85;
            } else if ($model->pages_id == 51) {
                $pages = 51 * 0.85;
            } else if ($model->pages_id == 52) {
                $pages = 52 * 0.85;
            } else if ($model->pages_id == 53) {
                $pages = 53 * 0.85;
            } else if ($model->pages_id == 54) {
                $pages = 54 * 0.85;
            } else if ($model->pages_id == 55) {
                $pages = 55 * 0.85;
            } else if ($model->pages_id == 56) {
                $pages = 56 * 0.85;
            } else if ($model->pages_id == 57) {
                $pages = 57 * 0.85;
            } else if ($model->pages_id == 58) {
                $pages = 58 * 0.85;
            } else if ($model->pages_id == 59) {
                $pages = 59 * 0.85;
            } else if ($model->pages_id == 60) {
                $pages = 60 * 0.85;
            } else if ($model->pages_id == 61) {
                $pages = 61 * 0.85;
            } else if ($model->pages_id == 62) {
                $pages = 62 * 0.85;
            } else if ($model->pages_id == 63) {
                $pages = 63 * 0.85;
            } else if ($model->pages_id == 64) {
                $pages = 64 * 0.85;
            } else if ($model->pages_id == 65) {
                $pages = 65 * 0.85;
            } else if ($model->pages_id == 66) {
                $pages = 66 * 0.85;
            } else if ($model->pages_id == 67) {
                $pages = 67 * 0.85;
            } else if ($model->pages_id == 68) {
                $pages = 68 * 0.85;
            } else if ($model->pages_id == 69) {
                $pages = 69 * 0.85;
            } else if ($model->pages_id == 70) {
                $pages = 70 * 0.85;
            } else if ($model->pages_id == 71) {
                $pages = 71 * 0.85;
            } else if ($model->pages_id == 72) {
                $pages = 72 * 0.85;
            } else if ($model->pages_id == 73) {
                $pages = 73 * 0.85;
            } else if ($model->pages_id == 74) {
                $pages = 74 * 0.85;
            } else if ($model->pages_id == 75) {
                $pages = 75 * 0.85;
            } else if ($model->pages_id == 76) {
                $pages = 76 * 0.85;
            } else if ($model->pages_id == 77) {
                $pages = 77 * 0.85;
            } else if ($model->pages_id == 78) {
                $pages = 78 * 0.85;
            } else if ($model->pages_id == 79) {
                $pages = 79 * 0.85;
            } else if ($model->pages_id == 80) {
                $pages = 80 * 0.85;
            } else if ($model->pages_id == 81) {
                $pages = 81 * 0.85;
            } else if ($model->pages_id == 82) {
                $pages = 82 * 0.85;
            } else if ($model->pages_id == 83) {
                $pages = 83 * 0.85;
            } else if ($model->pages_id == 84) {
                $pages = 84 * 0.85;
            } else if ($model->pages_id == 85) {
                $pages = 85 * 0.85;
            } else if ($model->pages_id == 86) {
                $pages = 86 * 0.85;
            } else if ($model->pages_id == 87) {
                $pages = 87 * 0.85;
            } else if ($model->pages_id == 88) {
                $pages = 88 * 0.85;
            } else if ($model->pages_id == 89) {
                $pages = 89;
            } else if ($model->pages_id == 90) {
                $pages = 90 * 0.85;
            } else if ($model->pages_id == 91) {
                $pages = 91 * 0.85;
            } else if ($model->pages_id == 92) {
                $pages = 92 * 0.85;
            } else if ($model->pages_id == 93) {
                $pages = 93 * 0.85;
            } else if ($model->pages_id == 94) {
                $pages = 94 * 0.85;
            } else if ($model->pages_id == 95) {
                $pages = 95 * 0.85;
            } else if ($model->pages_id == 96) {
                $pages = 96 * 0.85;
            } else if ($model->pages_id == 97) {
                $pages = 97 * 0.85;
            } else if ($model->pages_id == 98) {
                $pages = 98 * 0.85;
            } else if ($model->pages_id == 99) {
                $pages = 99 * 0.85;
            } else if ($model->pages_id == 100) {
                $pages = 100 * 0.85;
            } else if ($model->pages_id == 101) {
                $pages = 101 * 0.85;
            } else if ($model->pages_id == 102) {
                $pages = 102 * 0.85;
            } else if ($model->pages_id == 103) {
                $pages = 103 * 0.85;
            } else if ($model->pages_id == 104) {
                $pages = 104 * 0.85;
            } else if ($model->pages_id == 105) {
                $pages = 105 * 0.85;
            } else if ($model->pages_id == 106) {
                $pages = 106 * 0.85;
            } else if ($model->pages_id == 107) {
                $pages = 107 * 0.85;
            } else if ($model->pages_id == 108) {
                $pages = 108 * 0.85;
            } else if ($model->pages_id == 109) {
                $pages = 109 * 0.85;
            } else if ($model->pages_id == 110) {
                $pages = 110 * 0.85;
            } else if ($model->pages_id == 111) {
                $pages = 111 * 0.85;
            } else if ($model->pages_id == 112) {
                $pages = 112 * 0.85;
            } else if ($model->pages_id == 113) {
                $pages = 113 * 0.85;
            } else if ($model->pages_id == 114) {
                $pages = 114 * 0.85;
            } else if ($model->pages_id == 115) {
                $pages = 115 * 0.85;
            } else if ($model->pages_id == 116) {
                $pages = 116 * 0.85;
            } else if ($model->pages_id == 117) {
                $pages = 117 * 0.85;
            } else if ($model->pages_id == 118) {
                $pages = 118 * 0.85;
            } else if ($model->pages_id == 119) {
                $pages = 119 * 0.85;
            } else if ($model->pages_id == 120) {
                $pages = 120 * 0.85;
            } else if ($model->pages_id == 121) {
                $pages = 121 * 0.85;
            } else if ($model->pages_id == 122) {
                $pages = 122 * 0.85;
            } else if ($model->pages_id == 123) {
                $pages = 123 * 0.85;
            } else if ($model->pages_id == 124) {
                $pages = 124 * 0.85;
            } else if ($model->pages_id == 125) {
                $pages = 125 * 0.85;
            } else if ($model->pages_id == 126) {
                $pages = 126 * 0.85;
            } else if ($model->pages_id == 127) {
                $pages = 127 * 0.85;
            } else if ($model->pages_id == 128) {
                $pages = 128 * 0.85;
            } else if ($model->pages_id == 129) {
                $pages = 129 * 0.85;
            } else if ($model->pages_id == 130) {
                $pages = 130 * 0.85;
            } else if ($model->pages_id == 131) {
                $pages = 131 * 0.85;
            } else if ($model->pages_id == 132) {
                $pages = 132 * 0.85;
            } else if ($model->pages_id == 133) {
                $pages = 133 * 0.85;
            } else if ($model->pages_id == 134) {
                $pages = 134 * 0.85;
            } else if ($model->pages_id == 135) {
                $pages = 135 * 0.85;
            } else if ($model->pages_id == 136) {
                $pages = 136 * 0.85;
            } else if ($model->pages_id == 137) {
                $pages = 137 * 0.85;
            } else if ($model->pages_id == 138) {
                $pages = 138 * 0.85;
            } else if ($model->pages_id == 139) {
                $pages = 139 * 0.85;
            } else if ($model->pages_id == 140) {
                $pages = 140 * 0.85;
            } else if ($model->pages_id == 141) {
                $pages = 141 * 0.85;
            } else if ($model->pages_id == 142) {
                $pages = 142 * 0.85;
            } else if ($model->pages_id == 143) {
                $pages = 143 * 0.85;
            } else if ($model->pages_id == 144) {
                $pages = 144 * 0.85;
            } else if ($model->pages_id == 145) {
                $pages = 145 * 0.85;
            } else if ($model->pages_id == 146) {
                $pages = 146 * 0.85;
            } else if ($model->pages_id == 147) {
                $pages = 147 * 0.85;
            } else if ($model->pages_id == 148) {
                $pages = 148 * 0.85;
            } else if ($model->pages_id == 149) {
                $pages = 149 * 0.85;
            } else if ($model->pages_id == 150) {
                $pages = 150 * 0.85;
            } else if ($model->pages_id == 151) {
                $pages = 151 * 0.85;
            } else if ($model->pages_id == 152) {
                $pages = 152 * 0.85;
            } else if ($model->pages_id == 153) {
                $pages = 153 * 0.85;
            } else if ($model->pages_id == 154) {
                $pages = 154 * 0.85;
            } else if ($model->pages_id == 155) {
                $pages = 155 * 0.85;
            } else if ($model->pages_id == 156) {
                $pages = 156 * 0.85;
            } else if ($model->pages_id == 157) {
                $pages = 157 * 0.85;
            } else if ($model->pages_id == 158) {
                $pages = 158 * 0.85;
            } else if ($model->pages_id == 159) {
                $pages = 159 * 0.85;
            } else if ($model->pages_id == 160) {
                $pages = 160 * 0.85;
            } else if ($model->pages_id == 161) {
                $pages = 161 * 0.85;
            } else if ($model->pages_id == 162) {
                $pages = 162 * 0.85;
            } else if ($model->pages_id == 163) {
                $pages = 163 * 0.85;
            } else if ($model->pages_id == 164) {
                $pages = 164 * 0.85;
            } else if ($model->pages_id == 165) {
                $pages = 165 * 0.85;
            } else if ($model->pages_id == 166) {
                $pages = 166 * 0.85;
            } else if ($model->pages_id == 167) {
                $pages = 167 * 0.85;
            } else if ($model->pages_id == 168) {
                $pages = 168 * 0.85;
            } else if ($model->pages_id == 169) {
                $pages = 169 * 0.85;
            } else if ($model->pages_id == 170) {
                $pages = 170 * 0.85;
            } else if ($model->pages_id == 171) {
                $pages = 171 * 0.85;
            } else if ($model->pages_id == 172) {
                $pages = 172 * 0.85;
            } else if ($model->pages_id == 173) {
                $pages = 173 * 0.85;
            } else if ($model->pages_id == 174) {
                $pages = 174 * 0.85;
            } else if ($model->pages_id == 175) {
                $pages = 175 * 0.85;
            } else if ($model->pages_id == 176) {
                $pages = 176 * 0.85;
            } else if ($model->pages_id == 177) {
                $pages = 177 * 0.85;
            } else if ($model->pages_id == 178) {
                $pages = 178 * 0.85;
            } else if ($model->pages_id == 179) {
                $pages = 179 * 0.85;
            } else if ($model->pages_id == 180) {
                $pages = 180 * 0.85;
            } else if ($model->pages_id == 181) {
                $pages = 181 * 0.85;
            } else if ($model->pages_id == 182) {
                $pages = 182 * 0.85;
            } else if ($model->pages_id == 183) {
                $pages = 183 * 0.85;
            } else if ($model->pages_id == 184) {
                $pages = 184 * 0.85;
            } else if ($model->pages_id == 185) {
                $pages = 185 * 0.85;
            } else if ($model->pages_id == 186) {
                $pages = 186 * 0.85;
            } else if ($model->pages_id == 187) {
                $pages = 187 * 0.85;
            } else if ($model->pages_id == 188) {
                $pages = 188 * 0.85;
            } else if ($model->pages_id == 189) {
                $pages = 189 * 0.85;
            } else if ($model->pages_id == 190) {
                $pages = 190 * 0.85;
            } else if ($model->pages_id == 191) {
                $pages = 191 * 0.85;
            } else if ($model->pages_id == 192) {
                $pages = 192 * 0.85;
            } else if ($model->pages_id == 193) {
                $pages = 193 * 0.85;
            } else if ($model->pages_id == 194) {
                $pages = 194 * 0.85;
            } else if ($model->pages_id == 195) {
                $pages = 195 * 0.85;
            } else if ($model->pages_id == 196) {
                $pages = 196 * 0.85;
            } else if ($model->pages_id == 197) {
                $pages = 197 * 0.85;
            } else if ($model->pages_id == 198) {
                $pages = 198 * 0.85;
            } else if ($model->pages_id == 199) {
                $pages = 199 * 0.85;
            } else if ($model->pages_id == 200) {
                $pages = 200 * 0.85;
            } //single spaced
            else if ($model->pages_id == 201) {
                $pages = 1;
            } else if ($model->pages_id == 202) {
                $pages = 2 * 0.95;
            } else if ($model->pages_id == 203) {
                $pages = 3 * 0.95;
            } else if ($model->pages_id == 204) {
                $pages = 4 * 0.95;
            } else if ($model->pages_id == 205) {
                $pages = 5 * 0.95;
            } else if ($model->pages_id == 206) {
                $pages = 6 * 0.925;
            } else if ($model->pages_id == 207) {
                $pages = 7 * 0.925;
            } else if ($model->pages_id == 208) {
                $pages = 8 * 0.925;
            } else if ($model->pages_id == 209) {
                $pages = 9 * 0.925;
            } else if ($model->pages_id == 210) {
                $pages = 10 * 0.90;
            } else if ($model->pages_id == 211) {
                $pages = 11 * 0.90;
            } else if ($model->pages_id == 212) {
                $pages = 12 * 0.90;
            } else if ($model->pages_id == 213) {
                $pages = 13 * 0.90;
            } else if ($model->pages_id == 214) {
                $pages = 14 * 0.90;
            } else if ($model->pages_id == 215) {
                $pages = 15 * 0.90;
            } else if ($model->pages_id == 216) {
                $pages = 16 * 0.90;
            } else if ($model->pages_id == 217) {
                $pages = 17 * 0.90;
            } else if ($model->pages_id == 218) {
                $pages = 18 * 0.90;
            } else if ($model->pages_id == 219) {
                $pages = 19 * 0.90;
            } else if ($model->pages_id == 220) {
                $pages = 20 * 0.90;
            } else if ($model->pages_id == 221) {
                $pages = 21 * 0.85;
            } else if ($model->pages_id == 222) {
                $pages = 22 * 0.85;
            } else if ($model->pages_id == 223) {
                $pages = 23 * 0.85;
            } else if ($model->pages_id == 224) {
                $pages = 24 * 0.85;
            } else if ($model->pages_id == 225) {
                $pages = 25 * 0.85;
            } else if ($model->pages_id == 226) {
                $pages = 26 * 0.85;
            } else if ($model->pages_id == 227) {
                $pages = 27 * 0.85;
            } else if ($model->pages_id == 228) {
                $pages = 28 * 0.85;
            } else if ($model->pages_id == 229) {
                $pages = 29 * 0.85;
            } else if ($model->pages_id == 230) {
                $pages = 30 * 0.85;
            } else if ($model->pages_id == 231) {
                $pages = 31 * 0.85;
            } else if ($model->pages_id == 232) {
                $pages = 32 * 0.85;
            } else if ($model->pages_id == 233) {
                $pages = 33 * 0.85;
            } else if ($model->pages_id == 234) {
                $pages = 34 * 0.85;
            } else if ($model->pages_id == 235) {
                $pages = 35 * 0.85;
            } else if ($model->pages_id == 236) {
                $pages = 36 * 0.85;
            } else if ($model->pages_id == 237) {
                $pages = 37 * 0.85;
            } else if ($model->pages_id == 238) {
                $pages = 38 * 0.85;
            } else if ($model->pages_id == 239) {
                $pages = 39 * 0.85;
            } else if ($model->pages_id == 240) {
                $pages = 40 * 0.85;
            } else if ($model->pages_id == 241) {
                $pages = 41 * 0.85;
            } else if ($model->pages_id == 242) {
                $pages = 42 * 0.85;
            } else if ($model->pages_id == 243) {
                $pages = 43 * 0.85;
            } else if ($model->pages_id == 244) {
                $pages = 44 * 0.85;
            } else if ($model->pages_id == 245) {
                $pages = 45 * 0.85;
            } else if ($model->pages_id == 246) {
                $pages = 46 * 0.85;
            } else if ($model->pages_id == 247) {
                $pages = 47 * 0.85;
            } else if ($model->pages_id == 248) {
                $pages = 48 * 0.85;
            } else if ($model->pages_id == 249) {
                $pages = 49 * 0.85;
            } else if ($model->pages_id == 250) {
                $pages = 50 * 0.85;
            } else if ($model->pages_id == 251) {
                $pages = 51 * 0.85;
            } else if ($model->pages_id == 252) {
                $pages = 52 * 0.85;
            } else if ($model->pages_id == 253) {
                $pages = 53 * 0.85;
            } else if ($model->pages_id == 254) {
                $pages = 54 * 0.85;
            } else if ($model->pages_id == 255) {
                $pages = 55 * 0.85;
            } else if ($model->pages_id == 256) {
                $pages = 56 * 0.85;
            } else if ($model->pages_id == 257) {
                $pages = 57 * 0.85;
            } else if ($model->pages_id == 258) {
                $pages = 58 * 0.85;
            } else if ($model->pages_id == 259) {
                $pages = 59 * 0.85;
            } else if ($model->pages_id == 260) {
                $pages = 60 * 0.85;
            } else if ($model->pages_id == 261) {
                $pages = 61 * 0.85;
            } else if ($model->pages_id == 262) {
                $pages = 62 * 0.85;
            } else if ($model->pages_id == 263) {
                $pages = 63 * 0.85;
            } else if ($model->pages_id == 264) {
                $pages = 64 * 0.85;
            } else if ($model->pages_id == 265) {
                $pages = 65 * 0.85;
            } else if ($model->pages_id == 266) {
                $pages = 66 * 0.85;
            } else if ($model->pages_id == 267) {
                $pages = 67 * 0.85;
            } else if ($model->pages_id == 268) {
                $pages = 68 * 0.85;
            } else if ($model->pages_id == 269) {
                $pages = 69 * 0.85;
            } else if ($model->pages_id == 270) {
                $pages = 70 * 0.85;
            } else if ($model->pages_id == 271) {
                $pages = 71 * 0.85;
            } else if ($model->pages_id == 272) {
                $pages = 72 * 0.85;
            } else if ($model->pages_id == 273) {
                $pages = 73 * 0.85;
            } else if ($model->pages_id == 274) {
                $pages = 74 * 0.85;
            } else if ($model->pages_id == 275) {
                $pages = 75 * 0.85;
            } else if ($model->pages_id == 276) {
                $pages = 76 * 0.85;
            } else if ($model->pages_id == 277) {
                $pages = 77 * 0.85;
            } else if ($model->pages_id == 278) {
                $pages = 78 * 0.85;
            } else if ($model->pages_id == 279) {
                $pages = 79 * 0.85;
            } else if ($model->pages_id == 280) {
                $pages = 80 * 0.85;
            } else if ($model->pages_id == 281) {
                $pages = 81 * 0.85;
            } else if ($model->pages_id == 282) {
                $pages = 82 * 0.85;
            } else if ($model->pages_id == 283) {
                $pages = 83 * 0.85;
            } else if ($model->pages_id == 284) {
                $pages = 84 * 0.85;
            } else if ($model->pages_id == 285) {
                $pages = 85 * 0.85;
            } else if ($model->pages_id == 286) {
                $pages = 86 * 0.85;
            } else if ($model->pages_id == 287) {
                $pages = 87 * 0.85;
            } else if ($model->pages_id == 288) {
                $pages = 88 * 0.85;
            } else if ($model->pages_id == 289) {
                $pages = 89 * 0.85;
            } else if ($model->pages_id == 290) {
                $pages = 90 * 0.85;
            } else if ($model->pages_id == 291) {
                $pages = 91 * 0.85;
            } else if ($model->pages_id == 292) {
                $pages = 92 * 0.85;
            } else if ($model->pages_id == 293) {
                $pages = 93 * 0.85;
            } else if ($model->pages_id == 294) {
                $pages = 94 * 0.85;
            } else if ($model->pages_id == 295) {
                $pages = 95 * 0.85;
            } else if ($model->pages_id == 296) {
                $pages = 96 * 0.85;
            } else if ($model->pages_id == 297) {
                $pages = 97 * 0.85;
            } else if ($model->pages_id == 298) {
                $pages = 98 * 0.85;
            } else if ($model->pages_id == 299) {
                $pages = 99 * 0.85;
            } else if ($model->pages_id == 300) {
                $pages = 100 * 0.85;
            }

            // for urgency
            if ($model->urgency_id == 1) {
                $urgency = 3;
            } elseif ($model->urgency_id == 2) {
                $urgency = 6;
            } elseif ($model->urgency_id == 3) {
                $urgency = 12;
            } elseif ($model->urgency_id == 4) {
                $urgency = 24;
            } elseif ($model->urgency_id == 5) {
                $urgency = 48;
            } elseif ($model->urgency_id == 6) {
                $urgency = 72;
            } elseif ($model->urgency_id == 7) {
                $urgency = 96;
            } elseif ($model->urgency_id == 8) {
                $urgency = 120;
            } elseif ($model->urgency_id == 9) {
                $urgency = 144;
            } elseif ($model->urgency_id == 10) {
                $urgency = 168;
            } elseif ($model->urgency_id == 11) {
                $urgency = 192;
            } elseif ($model->urgency_id == 12) {
                $urgency = 240;
            } elseif ($model->urgency_id == 13) {
                $urgency = 336;
            } elseif ($model->urgency_id == 14) {
                $urgency = 672;
            } elseif ($model->urgency_id == 15) {
                $urgency = 1344;
            }

            if ($model->urgency_id == 1) {
                $deadline = 2.5;
            } else if ($model->urgency_id == 2) {
                $deadline = 2.0;
            } else if ($model->urgency_id == 3) {
                $deadline = 1.8;
            } else if ($model->urgency_id == 4) {
                $deadline = 1.6;
            } else if ($model->urgency_id == 5) {
                $deadline = 1.5;
            } else if ($model->urgency_id == 6) {
                $deadline = 1.4;
            } else if ($model->urgency_id == 7) {
                $deadline = 1.3;
            } else if ($model->urgency_id == 8) {
                $deadline = 1.2;
            } else if ($model->urgency_id == 9) {
                $deadline = 1.2;
            } else if ($model->urgency_id == 10) {
                $deadline = 1.1;
            } else if ($model->urgency_id == 11) {
                $deadline = 1.1;
            } else if ($model->urgency_id == 12) {
                $deadline = 1.1;
            } else if ($model->urgency_id == 13) {
                $deadline = 1.0;
            } else if ($model->urgency_id == 14) {
                $deadline = 1.0;
            } else if ($model->urgency_id == 15) {
                $deadline = 1.0;
            }

            //for spacing
            if ($model->spacing_id == 1) {
                $spacing = 1;
            } elseif ($model->spacing_id == 2) {
                $spacing = 2;
            }

            // Promocode
            if ($model->promocode == Yii::$app->params['couponcode']) {
                $promo = Yii::$app->params['couponamt'];
            } else {
                $promo = 1;
            }

            $model->amount = number_format(floatval($spacing * $deadline * $service * $level * $pages * $type * $promo), 2, '.', ',');
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
            $model->created_by = Yii::$app->user->id;
            $orderid = Uniqueid::find()->where(['id' => 1])->one();
            $orderid->orderid = $orderid->orderid + 1;
            $model->ordernumber = $orderid->orderid;
            $orderid->save();
            $model->save();
            unset($session['service_id']);
            unset($session['type_id']);
            unset($session['urgency_id']);
            unset($session['pages_id']);
            unset($session['level_id']);
//            Notification::success(Notification::KEY_NEW_ORDER, 1, $model->id);
            Notification::success(Notification::KEY_NEW_ORDER, 7, $model->id);
            $notifys = \app\models\Notification::find()->where(['key_id' => $model->id, 'seen' => 0])->all();
            foreach ($notifys as $notify) {
                $notify->order_number = $model->ordernumber;
                $notify->save();
            }

            return $this->redirect(['order/view', 'oid' => $model->ordernumber]);

        } else {
            Yii::$app->session->setFlash('danger', 'The order was not created. Please include all the order details.');
            return $this->redirect(['/']);
        }
    }
 }


    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();

    }

    public function actionTest()
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
    public function actionRequestPasswordReset()
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
    public function actionResetPassword($token)
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

    public function actionAccount(){
        $this->layout = 'order';
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $cancel_count = Order::find()->where(['cancelled'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $user_id = Yii::$app->user->id;
        $user = User::findOne($user_id);
        $model = ChangePassword::findOne($user_id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if (User::ValidatePass($model->current_password, Yii::$app->user->identity->password_hash)){
                $user->setPassword($model->new_password);
                if ($user->save()){
                    Yii::$app->session->setFlash('success','The new password was updated');
                    return $this->redirect(['order/index']);
                }else{
                    Yii::$app->session->setFlash('danger','Opps! There was a problem');
                    return $this->redirect(['order/index']);
                }
            }else{
                Yii::$app->session->setFlash('danger','Opps! Please enter the correct current password');
                return $this->redirect(['order/index']);
            }
        }
        //chaange password code here
        return $this->render('account',[
            'model'=>$model
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
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

    public function actionTerms_and_conditions()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('terms_and_conditions',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }

    public function actionPrivacy_policy()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('privacy_policy',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }


    public function actionHow_it_works()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('how_it_works',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }

    public function actionApiLogin($email, $token){

        $mytoken = Yii::$app->jwt->getParser()->parse((string) $token);
        $data = Yii::$app->jwt->getValidationData();
        $valid = $mytoken->validate($data);
        if ($valid){
            $claimId =  $mytoken->getClaim('uid');
            $user = User::findByEmail($email);
            if ($claimId == $user->getId() ){
                Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                return Yii::$app->response->redirect(Url::to(['order/index']));
            }else{
                return Yii::$app->response->redirect(Yii::$app->params[$user->site_code]);
            }
        } else{
            $result = ['status' => '101', 'message' => 'Authentication token was invalid'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        }
    }

    public function actionServices()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('services',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }

    public function actionBrit()
    {
        Image::open(Yii::getAlias('@webroot/images/slides/testimon.jpg'))
            ->sharp()
            ->save(Yii::getAlias('@webroot/images/slides/testimonials3.jpg'));
        return $this->redirect(['index']);

    }

    public function actionFaq()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('faq',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }

    public function actionBlogs()
    {
        return $this->render('blogs');
    }

    public function actionReviews()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        $query = Rating::find()->orderBy('id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>15]);
        $ratings = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('reviews',[
            'ratings'=>$ratings,
            'pagination'=>$pages
        ]);
    }

    public function actionGuarantee()
    {
        $signup = new SignupForm();
        $model = new Order();
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('guarantee',[
            'signup'=> $signup,
            'model'=>$model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $user = User::findOne(Yii::$app->user->id);
        $siteCode = $user->site_code;
        if ($siteCode == 1){
            Yii::$app->user->logout();
             return $this->goHome();
        }else{
            Yii::$app->user->logout();
            return $this->redirect('https://topratedprofessors.com');
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
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

    public function actionArticle($slug){
        $model = new Order();
        $signup = new SignupForm();
        $fmodel = new Frontorder();
        $article = Article::findOne(['slug'=>$slug]);
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('article',[
            'frontmodel'=>$fmodel,
            'article'=>$article,
            'model'=>$model,
            'signup'=>$signup
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $ratings = Rating::find()->orderBy('id DESC')->limit(5)->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(value) FROM rating');
        $totalrating = $command1->queryScalar();
        $count = Rating::find()->count();
        Yii::$app->view->params['count'] = $count;
        $avgrating =  $totalrating/$count;
        Yii::$app->view->params['avgrating'] = $avgrating;
        return $this->render('about');
    }
}
