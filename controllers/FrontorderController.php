<?php

namespace app\controllers;

use app\components\Notification;
use app\models\File;
use app\models\Level;
use app\models\Order;
use app\models\Pages;
use app\models\Service;
use app\models\Settings;
use app\models\SignupForm;
use app\models\Spacing;
use app\models\Type;
use app\models\Uniqueid;
use app\models\Urgency;
use app\models\User;
use Yii;
use app\models\Frontorder;
use app\models\FrontorderSearch;
use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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

    public function actionDetails()
    {
        //create user
        $settings = Settings::findOne(1);
        $signup = new SignupForm();
        if ($signup->load(Yii::$app->request->post())) {
            $existingUser = User::findByEmail(['email' => $signup->email]);
            if ($existingUser) {
                Yii::$app->session->setFlash('danger', 'user already exists. Please login');
                return $this->redirect(['/site/login']);
            }
            if ($user = $signup->signup()) {
                if (!$user) {
                    Yii::$app->session->setFlash('danger', 'user not created');
                    return $this->redirect(['/site']);
                }
                if (Yii::$app->getUser()->login($user)) {
                    Order::getLogoName();
                    Order::getOrdersCount();
                    Order::getBalance();
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
                        $model->created_by = $user->id;
                        $orderid = Uniqueid::find()->where(['id' => 1])->one();
                        $orderid->orderid = $orderid->orderid + 1;
                        $model->ordernumber = $orderid->orderid;

                        $connection = \Yii::$app->db;
                        $transaction = $connection->beginTransaction();
                        try {
                            $orderid->save();
                            if (!$model->save()) {
                                Yii::$app->session->setFlash('danger', json_encode($model->getErrors()));
                                return $this->redirect(['/site']);
                            }

                            if (isset($_FILES)) {
                                //save files if any
                                $myFile = new File();;
                                $myFile->attached = UploadedFile::getInstances($myFile, 'attached');
                                $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
                                if (!is_dir($directory)) {
                                    FileHelper::createDirectory($directory);
                                }
                                foreach ($myFile->attached as $key => $file) {
                                    $file->saveAs($directory . $file->baseName . '-' . date('His') . '.' . $file->extension); //Upload files to server
                                    $sfile = new File();
                                    $sfile->user_id = $user->id;
                                    $sfile->order_id = $model->id;
                                    $sfile->attached = $file->size;
                                    $sfile->file_date = date('His');
                                    $sfile->file_extension = $file->extension;
                                    $sfile->attached = $file->baseName; //Save file names in database- '**' is for separating images
                                    if (!$sfile->save()) {
                                        Yii::$app->session->setFlash('danger', json_encode($sfile->getErrors()));
                                        return $this->redirect(['/site']);
                                    }
                                }
                            }
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
                        return $this->redirect(['wallet/reserve', 'oid' => $model->ordernumber, 'amount' => $model->amount]);
                    }
                }
            }
        }

        return $this->redirect(['/site']);
    }

    /**
     * Updates an existing Frontorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
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
    public
    function actionDelete($id)
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
    protected
    function findModel($id)
    {
        if (($model = Frontorder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
