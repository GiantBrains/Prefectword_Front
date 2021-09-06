<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use Yii;
use app\models\Frontorder;
use app\models\FrontorderSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FrontorderController implements the CRUD actions for Frontorder model.
 */
class FrontorderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'details' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Frontorder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FrontorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Frontorder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Frontorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Frontorder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public static function ValidateFrontOrderForm()
    {

    }

    public function actionDetails()
    {
        $model = new Frontorder();
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
            //check if values are set
            if (!isset($post['email'])) {
                Yii::$app->session->setFlash('danger', 'Email is a required field');
                return $this->redirect(['/site']);
            }
            $email = trim($post['email']);
            if (!isset($post['username'])) {
                Yii::$app->session->setFlash('danger', 'Username is a required field');
                return $this->redirect(['/site']);
            }

            $username = trim($post['username']);
            if (!isset($post['password'])) {
                Yii::$app->session->setFlash('danger', 'Password is a required field');
                return $this->redirect(['/site']);
            }

            $password = trim($post['password']);
            if (!isset($post['confirm_password'])) {
                Yii::$app->session->setFlash('danger', 'Confirm password is a required field');
                return $this->redirect(['/site']);
            }

            $confirmPassword = trim($post['confirm_password']);
            //check username availability
            $user = User::findOne(['username' => $username]);
            if ($user) {
                Yii::$app->session->setFlash('danger', 'Username already exists, please use another username');
                return $this->redirect(['/site']);
            }
            //compare passwords
            if ($password != $confirmPassword) {
                Yii::$app->session->setFlash('danger', 'Password and confirm passwords do not match');
                return $this->redirect(['/site']);
            }

            //create user
            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->phone = null;
            $user->registration_ip = Yii::$app->request->userIP;
            $user->timezone = Yii::$app->timezone->name;
            $user->setPassword($password);
            $user->generateAuthKey();
            $user->save();

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $clientRole = $auth->getRole('client');
            $auth->assign($clientRole, $user->getId());

            Yii::$app->mailer->htmlLayout = "layouts/order";
            Yii::$app->mailer->compose('account-create', [
                'user' => $user
            ])->setFrom([Yii::$app->params['noreplyEmail'] => Yii::$app->name . ' Accounts Manager'])
                ->setTo($user->email)
                ->setSubject('Welcome to VerifiedProfessors.com!')
                ->send();

            //create order and redirect to payments
            $session['service_id'] = $model->service_id;
            $session['type_id'] = $model->type_id;
            $session['urgency_id'] = $model->urgency_id;
            $session['pages_id'] = $model->pages_id;
            $session['level_id'] = $model->level_id;
            $session['spacing_id'] = 1;

            $identity = User::findOne(['username' => $username]);

            if (Yii::$app->user->login($identity)) {
                Yii::info('reached here');
                return $this->redirect(['order/create']);
            }
        }
        return $this->redirect(['site']);
    }

    /**
     * Updates an existing Frontorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Frontorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Frontorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Frontorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Frontorder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
