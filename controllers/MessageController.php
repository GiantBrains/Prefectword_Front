<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;
use Yii;
use app\models\Message;
use app\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{
    public $layout = 'order';
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
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAjax()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $pending_count = Order::find()->where(['paid'=> 0])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
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
        $this->layout = 'order';
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        return $this->render('ajax');
    }


    public function actionTest()
    {
        if (Yii::$app->request->isAjax){
            if ($_POST['sendMessage'] == 'true'){
               $fname = $_POST['fname'];
               return json_encode($fname);
            }
        }
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
