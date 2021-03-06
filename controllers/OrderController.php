<?php

namespace app\controllers;

use app\models\Autoapprove;
use app\models\Autopost;
use app\models\Autoredirect;
use app\models\Cancel;
use app\models\Paypal;
use app\models\Rating;
use app\models\Reject;
use app\models\Revision;
use app\models\Settings;
use app\models\Uploaded;
use app\models\User;
use app\models\Wallet;
use \app\components\Notification;
use Yii;
use app\models\Message;
use app\models\MessageSearch;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use app\models\File;
use app\models\Uniqueid;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\Service;
use app\models\Type;
use app\models\Level;
use app\models\Pages;
use app\models\Urgency;
use app\models\Spacing;
use app\models\Order;
use app\models\OrderSearch;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public $layout = 'order';


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'create', 'index', 'cancel', 'update', 'attached', 'file-delete', 'file-upload',
                    'send-message', 'messages', 'image-upload', 'file-view', 'image-delete', 'cancel',
                    'pending', 'active', 'revision', 'editing', 'completed', 'rejected', 'download-review',
                    'rating', 'disputed', 'view', 'available', 'approved', 'reserve', 'message-count',
                    'order-revision', 'order-approve', 'order-reject'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'create', 'index', 'cancel', 'update', 'attached', 'file-delete', 'file-upload',
                            'send-message', 'messages', 'image-upload', 'file-view', 'image-delete', 'cancel', 'view',
                            'pending', 'active', 'revision', 'editing', 'completed', 'rejected', 'disputed',
                            'download-review', 'rating', 'approved', 'available', 'reserve', 'message-count',
                            'order-revision', 'order-approve', 'order-reject'
                        ],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['paid' => 0]);
        $dataProvider->query->andFilterWhere(['cancelled' => 0]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAvailable()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['available' => 1]);
        $dataProvider->query->andFilterWhere(['cancelled' => 0]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('available', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActive()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['active' => 1]);
        $dataProvider->query->andFilterWhere(['cancelled' => 0]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('active', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCancelled()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['cancelled' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('cancelled', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRevision()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['revision' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('revision', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEditing()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['editing' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('editing', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCompleted()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['completed' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('completed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['approved' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('approved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRejected()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['rejected' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('rejected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDisputed()
    {
        Order::getLogoName();
        Order::getBalance();
        Order::getOrdersCount();
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['disputed' => 1]);
        $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
        return $this->render('disputed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSendMessage()
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('send-message', [
                'model' => $model,
            ]);
        }
    }

    public function actionReserve($oid)
    {
        Order::getLogoName();
        $model = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $model->created_by) {
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                //deduct payment
                Order::getBalance();
                if ($model->amount > Order::getBalance()) {
                    Yii::$app->session->setFlash('balance', 'The balance in your wallet is less than the amount you want to pay. Please reload your wallet.');
                    return $this->redirect(['view', 'oid' => $oid]);
                } else {
                    $withdraw = new Wallet();
                    $withdraw->order_id = $oid;
                    $withdraw->withdraw = $model->amount;
                    $withdraw->narrative = 'reserve for order #' . $oid . '';
                    $withdraw->customer_id = Yii::$app->user->id;
                    $withdraw->save();
                }
                $model->paid = 1;
                $model->available = 1;
                $model->save();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new   $e;
            }
            Yii::$app->session->setFlash('reserved', 'The payment has been reserved. 
        Your order will be submitted within the deadline and you will have the chance to review the order before releasing the funds.');
            return $this->redirect(['view', 'oid' => $oid]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionMessages($oid)
    {
        Order::getLogoName();
        $message = new Message();
        $order_messages = Message::find()->where(['order_number' => $oid])->orderBy('id ASC')->all();
        $supaorder = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $supaorder->created_by) {

//            $connection = \Yii::$app->db;
//            $transaction = $connection->beginTransaction();
//            try {
            $writter = Order::find()->where(['ordernumber' => $oid])->one();
            if ($message->load(Yii::$app->request->post())) {
                $message->order_number = $oid;
                $message->sender_id = Yii::$app->user->id;
                if ($supaorder->written_by == null) {
                    $message->receiver_id = intval(env('NOTIFICATION_USER_ID'));
                } else {
                    $message->receiver_id = $supaorder->written_by;
                }

                $message->status = false;
                $message->save(false);
                // $message was just created by the logged in user, and sent to $recipient_id
                Notification::warning(Notification::KEY_NEW_MESSAGE, $message->receiver_id, $message->id);
                $notifys = \app\models\Notification::find()->where(['key_id' => $message->id])->all();
                foreach ($notifys as $notify) {
                    $notify->order_number = $oid;
                    $notify->save();
                }

                return $this->redirect(['messages', 'oid' => $oid]);
            }
            Order::getOrdersCount();
            Order::getBalance();
            $model = $this->findModelByNumber($oid);
            $messages = Message::find()->where(['order_number' => $oid])->one();
            $searchModel = new MessageSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andFilterWhere(['sender_id' => Yii::$app->user->id])->orFilterWhere(['receiver_id' => Yii::$app->user->id]);
            $mymessages = Message::find()->where(['order_number' => $oid])->andFilterWhere(['receiver_id' => Yii::$app->user->id])->all();
            foreach ($mymessages as $mymessage) {
                if ($mymessage->status == false) {
                    $mymessage->status = true;
                    $mymessage->save(false);
                }
            }
            $notifications = \app\models\Notification::find()->where(['order_number' => $oid])->andWhere(['seen' => false])->andFilterWhere(['user_id' => Yii::$app->user->id])->all();
            foreach ($notifications as $notification) {
                $notification->seen = true;
                $notification->save(false);
            }

//                $transaction->commit();
//            } catch (\Exception $e) {
//                $transaction->rollBack();
//                throw new   $e;
//            }
            return $this->render('messages', [
                'searchModel' => $searchModel,
                'order_messages' => $order_messages,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'messages' => $messages,
                'message' => $message
            ]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['message-count'])) {

            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionMessageCount()
    {
        $active_count = Order::find()->where(['active' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        return json_encode($active_count);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($oid)
    {
        Order::getLogoName();
        Order::getOrdersCount();
        $model = $this->findModelByNumber($oid);
        $this->layout = 'order';
        if (Yii::$app->user->id == $model->created_by) {
            Order::getBalance();
            $cancel = new Cancel();
            return $this->render('view', [
                'model' => $model,
                'cancel' => $cancel
            ]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $settings = Settings::findOne(1);
        $session = Yii::$app->session;
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
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
            if ($model->promocode == $settings->coupon1) {
                $promo = (1 - ($settings->coupon_value1 / 100));
            } else if ($model->promocode == $settings->coupon2) {
                $promo = (1 - ($settings->coupon_value2 / 100));
            } else if ($model->promocode == $settings->coupon3) {
                $promo = (1 - ($settings->coupon_value3 / 100));
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
            try {
                $startTime = new \DateTime('' . $model->created_at . '', new \DateTimeZone('UTC'));
            } catch (\Exception $e) {
            }
            $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
            $ptime = $startTime->format("Y-m-d H:i:s");
            // calculate the future deadline and display it
            $cenvertedTime = date('Y-m-d H:i:s', strtotime('' . $hrsanddays . '', strtotime($ptime)));
            $model->deadline = $cenvertedTime;
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
                Notification::success(Notification::KEY_NEW_ORDER, intval(env('NOTIFICATION_USER_ID')), $model->id);
                $notifys = \app\models\Notification::find()->where(['key_id' => $model->id, 'seen' => 0])->all();
                foreach ($notifys as $notify) {
                    $notify->order_number = $model->ordernumber;
                    $notify->save();
                }
                //send email to client
                $user = User::findOne($model->created_by);
                try {
                    Yii::$app->supportMailer->htmlLayout = "layouts/order";
                    Yii::$app->supportMailer->compose('order-create', ['model' => $model, 'user' => $user])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' support'])
                        ->setTo($user->email)
                        ->setSubject('Order ' . $model->ordernumber . ' created')
                        ->send();
                } catch (\Swift_TransportException $e) {
                    Yii::info($e);
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new   $e;
            }
            //redirect  to view order
            return $this->redirect(['attached', 'oid' => $model->ordernumber]);
        }
        return $this->render('create', [
            'model' => $model,
            'settings' => $settings
        ]);
    }

    public function actionDownloadReview($oid)
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $rating = new Rating();
        $model = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $model->created_by) {
            $submittedfile = Uploaded::find()->where(['order_number' => $model->id])->all();
            if ($submittedfile) {
                $revision = new Revision();
                $reject = new Reject();
                $this->layout = 'order';
                $models = Uploaded::find()->where(['order_number' => $model->id])->orderBy('id DESC')->all();
                return $this->render('download-review', [
                    'model' => $model,
                    'rating' => $rating,
                    'models' => $models,
                    'revision' => $revision,
                    'id' => $model->id,
                    'reject' => $reject
                ]);
            } else {
                return $this->redirect(['order/view', 'oid' => $oid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionOrderRevision($oid)
    {
        Order::getLogoName();
        $model = new Revision();
        $order = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $order->created_by) {
            if ($model->load(Yii::$app->request->post())) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $order->revision = 1;
                    $order->completed = 0;
                    $order->save();
                    $model->order_number = $oid;
                    $model->save();

                    Notification::warning(Notification::KEY_ORDER_REVISION, $order->written_by, $model->id);
                    $notify = \app\models\Notification::find()->where(['key_id' => $model->id])->andWhere(['seen' => 0])->one();
                    $notify->order_number = $oid;
                    $notify->save();
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw new   $e;
                }
                Yii::$app->session->setFlash('revision-sent', 'You have successfully made a revision request. Thank you');
                return $this->redirect(['order/download-review', 'oid' => $oid]);
            } else {
                return $this->redirect(['order/download-review', 'oid' => $oid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionApproverun($oid)
    {
        Order::getLogoName();
        $order = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $order->created_by) {
            if ($order->approved == 0) {
                $order->completed = 0;
                $order->active = 0;
                $order->revision = 0;
                $order->approved = 1;
                $order->save();
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionRating($oid)
    {
        Order::getLogoName();
        $rating = new Rating();
        $order = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $order->created_by) {
            if ($rating->load(Yii::$app->request->post())) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    //save the status of the order
                    $order->completed = 0;
                    $order->active = 0;
                    $order->revision = 0;
                    $order->approved = 1;
                    $order->save();

                    //Save the rating of the order
                    $rating->order_number = $oid;
                    $rating->client_id = Yii::$app->user->id;
                    $rating->save();
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw new   $e;
                }
                Notification::success(Notification::KEY_ORDER_APPROVED, $order->written_by, $order->id);
                $supernote = \app\models\Notification::find()->where(['key' => 'order_approved'])->andWhere(['key_id' => $order->id])->one();
                if (empty($supernote)) {
                    $notify = \app\models\Notification::find()->where(['key_id' => $order->id])->andWhere(['seen' => 0])->one();
                    $notify->order_number = $oid;
                    $notify->save();
                }
                Yii::$app->session->setFlash('rating', 'Review submitted successfully. Thank you');
                return $this->redirect(['download-review', 'oid' => $oid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionOrderReject($oid)
    {
        Order::getLogoName();
        $order = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $order->created_by) {
            $reject = new Reject();
            if ($reject->load(Yii::$app->request->post())) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    //save new order status
                    $order->rejected = 1;
                    $order->completed = 0;
                    $order->active = 0;
                    $order->revision = 0;
                    $order->save();

                    //save the reason for rejecting
                    $reject->order_number = $oid;
                    $reject->save();

                    Notification::warning(Notification::KEY_ORDER_REJECTED, $order->written_by, $order->id);
                    $supernote = \app\models\Notification::find()->where(['key' => 'order_rejected'])->andWhere(['key_id' => $order->id])->one();
                    if (empty($supernote)) {
                        $notify = \app\models\Notification::find()->where(['key_id' => $order->id])->andWhere(['seen' => 0])->one();
                        $notify->order_number = $oid;
                        $notify->save();
                    }
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw new   $e;
                }
                return $this->redirect(['order/download-review', 'oid' => $oid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionAttached($oid)
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $model = Order::find()->where(['ordernumber' => $oid])->one();
        if (Yii::$app->user->id == $model->created_by) {
            $file = new File();
            $models = File::find()->where(['order_id' => $model->id])->orderBy('id DESC')->all();
            return $this->render('attached', [
                'file' => $file,
                'model' => $model,
                'models' => $models,
                'id' => $model->id
            ]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionFileDelete($order, $file, $file_date, $file_extension)
    {
        $user = Yii::$app->user->id;
        $myorder = Order::find()->where(['id' => $order])->one();
        $myfile = File::find()->Where(['order_id' => $order])->andFilterWhere(['attached' => $file])
            ->andFilterWhere(['file_date' => $file_date])->andFilterWhere(['file_extension' => $file_extension])->one();
        $myfile->delete();
        $order_file = $file . '-' . $file_date . '.' . $file_extension;
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $order_file)) {
            unlink($directory . DIRECTORY_SEPARATOR . $order_file);
        }
        return $this->redirect(['attached', 'oid' => $myorder->ordernumber]);
    }

    public function actionSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents)) {
                $spacing_id = $parents[0];
                $out = Pages::getSpacingList($spacing_id);

                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

    public function actionFileUpload($id)
    {
        $user = Yii::$app->user->id;
        $model = new File();
        $order = Order::find()->where(['id' => $id])->one();
        if (Yii::$app->user->id == $order->created_by) {
            $model->attached = UploadedFile::getInstances($model, 'attached');
            $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }
            foreach ($model->attached as $key => $file) {
                $file->saveAs($directory . $file->baseName . '-' . date('His') . '.' . $file->extension); //Upload files to server
                $sfile = new File();
                $sfile->user_id = $user;
                $sfile->order_id = $id;
                $sfile->attached = $file->size;
                $sfile->file_date = date('His');
                $sfile->file_extension = $file->extension;
                $sfile->attached = $file->baseName; //Save file names in database- '**' is for separating images
                $sfile->save();
            }
            return $this->redirect(['order/attached', 'oid' => $order->ordernumber]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    // action examples
    public function actionImageUpload($id)
    {
        $model = new File();
        $user = Yii::$app->user->id;
        $order = Order::findOne($id);
        if (Yii::$app->user->id == $order->created_by) {
            $imageFile = UploadedFile::getInstance($model, 'attached');
            $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                try {
                    FileHelper::createDirectory($directory);
                } catch (Exception $e) {
                }
            }
            if ($imageFile) {
                $uid = $imageFile->baseName . '-' . $user . '-' . $order->id;
                $fileName = $uid . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
                //
                $file = new File();
                $file->user_id = Yii::$app->user->id;
                $file->order_id = $order->id;
                $file->attached = $fileName;
                $file->save();
                //
                if ($imageFile->saveAs($filePath)) {
                    $path = Yii::$app->request->baseUrl . '/images/order/' . $imageFile->baseName . '-' . $user . '-' . $order->id . '.' . $imageFile->extension;
                    return Json::encode([
                        'files' => [
                            [
                                'name' => $fileName,
                                'size' => $imageFile->size,
                                'url' => $path,
                                'deleteUrl' => 'image-delete?name=' . $fileName,
                                'deleteType' => 'POST'
                            ],
                        ],
                    ]);
                }
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionFileView($id)
    {
        Order::getLogoName();
        $models = File::find()->where(['order_id' => $id])->all();
        return $this->render('file-view', [
            'models' => $models
        ]);
    }

    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        $sfiles = File::find()->where(['attached' => $name])->one();
        $sfiles->delete();
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = Yii::$app->request->baseUrl . '/images/order/' . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($oid)
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $model = $this->findModelByNumber($oid);
        if (Yii::$app->user->id == $model->created_by) {
            if ($model->load(Yii::$app->request->post())) {
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

                $model->amount = number_format(floatval($spacing * $deadline * $service * $level * $pages * $type), 2, '.', ',');
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
                $model->save();

                return $this->redirect(['view', 'oid' => $model->ordernumber]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have permission to view this order. Thank you');
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionResubmit($oid)
    {
        $order = $this->findModelByNumber($oid);
        if (Yii::$app->user->id == $order->created_by) {
            $order->cancelled = 0;
            if ($order->paid == 1) {
                $order->available = 1;
            }
            $order->save();
            $mycancelled = Cancel::find()->where(['order_number' => $oid])->one();
            if ($mycancelled) {
                $mycancelled->delete();
            }
            return $this->redirect(['order/view', 'oid' => $oid]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionCancel($oid)
    {
        $cancel = new Cancel();
        $order = $this->findModelByNumber($oid);
        if (Yii::$app->user->id == $order->created_by) {
            if ($cancel->load(Yii::$app->request->post())) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    //update order
                    $order->cancelled = 1;
                    $order->active = 0;
                    $order->available = 0;
                    $order->save();

                    //save reason for cancel
                    $cancel->order_number = $oid;
                    $cancel->save();

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw new   $e;
                }
                return $this->redirect(['order/view', 'oid' => $oid]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByNumber($oid)
    {
        if (($model = Order::findOne(['ordernumber' => $oid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function actionRevisionView($oid)
    {
        Order::getLogoName();
        Order::getOrdersCount();
        Order::getBalance();
        $model = $this->findModelByNumber($oid);
        if (Yii::$app->user->id == $model->created_by) {
            return $this->render('revision-view', [
                'model' => $model
            ]);
        } else {
            Yii::$app->session->setFlash('danger', 'You do not have the permission to perform this function');
            return $this->redirect(['index']);
        }
    }

    public function actionDownload($file_name, $file_date, $file_extension)
    {
        $file = Uploaded::find()->where(['name' => $file_name])->andWhere(['file_date' => $file_date])
            ->andWhere(['file_extension' => $file_extension])->one();
        if ($file) {
            //get the time from the db in UTC and convert it client timezone
            $today = date('Y-m-d H:i:s');
            $startTime = new \DateTime('' . $today . '');
            $startTime->setTimezone(new \DateTimeZone('UTC'));
            $dowtime = $startTime->format('Y-m-d H:i:s');
            //            Yii::$app->queue->delay(10080*60)->push(new Autoapprove([
            //                'id' => $file->order_number,
            //            ]));
            $file->dowload_date = $dowtime;
            $file->save();
            Yii::setAlias('@adminsource', env('ADMIN_SITE'));

            $path = Url::to('@adminsource') . '/images/uploads/' . $file_name . '-' . $file_date . '.' . $file_extension;

            return $this->redirect($path);
        }
    }

    public function actionHere($oid)
    {
        $order = Order::find()->where(['ordernumber' => $oid])->one();
        $order->topic = 'This is the new topic, i said so';
        $order->save();
    }

    public function actionNewurl()
    {
        if (Yii::$app->queue->push(new Autoredirect([
            'oid' => 120278,
            'url' => Url::to(['ordr/here', 'oid' => 120278])
        ]))) {
            echo '<h1>Successful</h1>';
        } else {
            echo 'Ok, may be not';
        }
    }

    public function actionPost()
    {
        if (Yii::$app->queue->delay(10)->push(new Autopost())) {
            echo '<h1>Successful</h1>';
        } else {
            echo 'Ok, may be not';
        }
    }

    public function apiContext()
    {
        // After Step 1
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),     // ClientID
                env('PAYPAL_CLIENT_SECRET')      // ClientSecret
            )
        );
        return $apiContext;
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
