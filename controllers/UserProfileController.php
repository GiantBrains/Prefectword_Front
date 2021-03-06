<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;
use app\models\Withdraw;
use Yii;
use app\models\UserProfile;
use app\models\UserProfileSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller
{
    public $layout  = 'order';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','view','index', 'delete', 'update'],
                'rules' => [
                    [
                        'actions' => ['create','view', 'index', 'delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserProfile models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
//        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
//        $totaldeposit = $command1->queryScalar();
//        $totalwithdrawal = $command2->queryScalar();
//        $balance = $totaldeposit-$totalwithdrawal;
//        Yii::$app->view->params['balance'] = $balance;
//        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
//        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
//        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
//        Yii::$app->view->params['cancel_count'] = $cancel_count;
//        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
//        Yii::$app->view->params['available_count'] = $available_count;
//        $bids_count = Order::find()->where(['available'=> 1])->count();
//        Yii::$app->view->params['bids_count'] = $bids_count;
//        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
//        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
//        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
//        Yii::$app->view->params['confirmed_count'] = $confirmed_count;
//
//        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
//        Yii::$app->view->params['pending_count'] = $pending_count;
//        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
//        Yii::$app->view->params['active_count'] = $active_count;
//        $revision_count = Order::find()->where(['revision'=> 1])->count();
//        Yii::$app->view->params['revision_count'] = $revision_count;
//        $editing_count = Order::find()->where(['editing'=> 1])->count();
//        Yii::$app->view->params['editing_count'] = $editing_count;
//        $completed_count = Order::find()->where(['completed'=> 1])->count();
//        Yii::$app->view->params['completed_count'] = $completed_count;
//        $approved_count = Order::find()->where(['approved'=> 1])->count();
//        Yii::$app->view->params['approved_count'] = $approved_count;
//        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
//        Yii::$app->view->params['rejected_count'] = $rejected_count;
//        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
//        Yii::$app->view->params['disputed_count'] = $disputed_count;
//        $searchModel = new UserProfileSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user)
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $profile = UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        return $this->render('view', [
            'model' => $this->findModelByUser($user),
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $profile = UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();

        if ($profile){
            return $this->redirect(['view','user'=> $profile->user_id]);
        }else{
            $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $totaldeposit = $command1->queryScalar();
            $totalwithdrawal = $command2->queryScalar();
            $balance = $totaldeposit-$totalwithdrawal;
            Yii::$app->view->params['balance'] = $balance;
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
            $model = new UserProfile();
            $session = Yii::$app->session;
            if ($model->load(Yii::$app->request->post())) {
                $model->user_id = Yii::$app->user->id;
                $model->timezone = $session['timezone'];
                $model->save();
                return $this->redirect(['view', 'user' => $model->user_id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user)
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $model = $this->findModelByUser($user);

        if ($model->load(Yii::$app->request->post())){

            $model->save();
            return $this->redirect(['view', 'user' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfile model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByUser($user)
    {
        if (($model = UserProfile::findOne(['user_id' => $user])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
