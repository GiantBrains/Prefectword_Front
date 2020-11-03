<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;
use app\models\Withdraw;
use \app\components\Notification;
use Yii;
use app\models\Paypal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use app\models\Wallet;
use app\models\WalletSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WalletController implements the CRUD actions for Wallet model.
 */
class WalletController extends Controller
{
    public $layout = 'finance';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'index', 'view', 'update', 'deposit', 'paypal', 'transactions', 'withdraw', 'card-payment', 'card-callback'],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'view', 'update', 'deposit', 'paypal', 'transactions', 'withdraw', 'card-payment', 'card-callback'],
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
     * Lists all Wallet models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $deposit = 'active';
        Yii::$app->view->params['deposit'] = $deposit;
        $withdraw = 'not';
        Yii::$app->view->params['withdraw'] = $withdraw;
        $active1 = 'active';
        Yii::$app->view->params['active'] = $active1;
        $active2 = 'not';
        Yii::$app->view->params['active'] = $active2;
        $active3 = 'not';
        Yii::$app->view->params['active'] = $active3;
        $model = Wallet::find()->Where(['customer_id' => Yii::$app->user->id])->all();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit - $totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        return $this->render('index', [
            'model' => $model,
            'balance' => $balance,
            'active1' => $active1,
            'active2' => $active2,
            'active3' => $active3,
        ]);
    }

    public function actionWithdrawRequest($amount)
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        if (is_numeric($amount)) {
            $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
            $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
            $totaldeposit = $command1->queryScalar();
            $totalwithdrawal = $command2->queryScalar();
            $balance = $totaldeposit - $totalwithdrawal;
            if ($balance > 0 && $balance >= $amount) {

                // send the request
                $withdraw = new Withdraw();
                $withdraw->user_id = Yii::$app->user->id;
                $withdraw->status = 0;
                $withdraw->uniqueid = date('His');
                $withdraw->amount = $amount;
                $withdraw->save();

                Notification::warning(Notification::KEY_WITHDRAWAL_REQUEST, 7, $withdraw->id);
                $notify = \app\models\Notification::find()->where(['key_id' => $withdraw->id])->andWhere(['seen' => 0])->one();
                $notify->order_number = $withdraw->user_id;
                $notify->save();

                Yii::$app->session->setFlash('success', 'The withdrawal request has been sent and will be approved within 2 days. Thank you');
                return $this->redirect(['wallet/withdraw']);
            } else {
                Yii::$app->session->setFlash('danger', 'The amount you entered is invalid. Your balance may be zero or the balance is less than amount requested');
                return $this->redirect(['withdraw']);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'The amount you entered is  invalid. The amount must be numeric.');
            return $this->redirect(['withdraw']);
        }
    }

    /**
     * Displays a single Wallet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTransactions()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit - $totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $deposit = 'not';
        Yii::$app->view->params['deposit'] = $deposit;
        $withdraw = 'not';
        Yii::$app->view->params['withdraw'] = $withdraw;
        $active1 = 'not';
        Yii::$app->view->params['active1'] = $active1;
        $active2 = 'active';
        Yii::$app->view->params['active2'] = $active2;
        $active3 = 'not';
        Yii::$app->view->params['active2'] = $active3;
        $wallet = Wallet::find()->where(['customer_id' => Yii::$app->user->id])->orderBy('id DESC');
        // get the total number of articles (but do not fetch the article data yet)
        $count = $wallet->count();
        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 8;
        // limit the query using the pagination and retrieve the articles
        $articles = $wallet->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('transactions', [
            'paypals' => $articles,
            'totaldeposit' => $totaldeposit,
            'totalwithdrawal' => $totalwithdrawal,
            'pagination' => $pagination,
            'active1' => $active1,
            'active2' => $active2,
            'active3' => $active3,
        ]);
    }

    public function actionWithdraw()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit - $totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $deposit = 'not';
        Yii::$app->view->params['deposit'] = $deposit;
        $withdraw = 'active';
        Yii::$app->view->params['withdraw'] = $withdraw;
        $active1 = 'not';
        Yii::$app->view->params['active1'] = $active1;
        $active2 = 'not';
        Yii::$app->view->params['active2'] = $active2;
        $active3 = 'active';
        Yii::$app->view->params['active2'] = $active3;
        $withdraw_trasc = Withdraw::find()->Where(['user_id' => Yii::$app->user->id])->orderBy('id DESC')->all();
        return $this->render('withdraw', [
            'active1' => $active1,
            'withdraws' => $withdraw_trasc,
            'active2' => $active2,
            'active3' => $active3,
        ]);
    }

    /**
     * Creates a new Wallet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wallet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeposit($amount)
    {
        if (is_numeric($amount)) {
            // process paypal transaction
            $session = Yii::$app->session;
            $session->open();
            $session['user_id'] = Yii::$app->user->getId();
            $apiContext = $this->apiContext();

            //set payer
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            // ### Itemized information
            // (Optional) Lets you specify item wise
            // information
            $item = new Item();
            $item->setName('Client #' . Yii::$app->user->id)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($amount);
            $itemList = new ItemList();
            $itemList->setItems([$item]);
            //        // ### Transaction
            //        // A transaction defines the contract of a
            //        // payment - what is the payment for and who
            //        // is fulfilling it.

            $amnt = new \PayPal\Api\Amount();
            $amnt->setTotal($amount);
            $amnt->setCurrency('USD');

            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amnt);
            $transaction->setItemList($itemList);
            $transaction->setDescription('Deposit for client #' . Yii::$app->user->id);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(Yii::$app->params['successUrl'] . "?success=true")
                ->setCancelUrl(Yii::$app->params['cancelUrl']);

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent set to 'sale'

            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            // For Sample Purposes Only.
            // $request = clone $payment;
            // ### Create Payment
            // Create a payment by calling the 'create' method
            // passing it a valid apiContext.
            // (See bootstrap.php for more on `ApiContext`)
            // The return object contains the state and the
            // url to which the buyer must be redirect

            try {
                $payment->create($apiContext);
                //hash the payment
                $hash = md5($payment->getId());
                $session['paypal_hash'] = $hash;

                $connection = Yii::$app->db;
                $connection->createCommand()->insert('paypal', [
                    'user_id' => $session['user_id'],
                    'payment_id' => $payment->getId(),
                    'amount_paid' => ($amount),
                    'hash' => $hash,
                    'complete' => 0
                ])->execute();


            } catch (PayPalConnectionException $e) {
                echo $e->getData();
            }
            $approvalUrl = $payment->getApprovalLink();

            return $this->redirect($approvalUrl);
        } else {
            Yii::$app->session->setFlash('invalidAmt', 'The amount you entered is  invalid. The amount must be numeric.');
            return $this->redirect(['index']);
        }
    }

    public function actionCardPayment($amount)
    {
        if (is_numeric($amount)) {
            // process card payment transaction
            $session = Yii::$app->session;
            $session->open();
            $session['user_id'] = Yii::$app->user->getId();

            //Init curl
            $curl = new curl\Curl();
            //post http://example.com/
            $response = $curl->setRawPostData(
                CURLOPT_POSTFIELDS,
                http_build_query(array(
                        '<?xml version="1.0" encoding="utf-8"?>
                    <API3G>
                        <CompanyToken>9F416C11-127B-4DE2-AC7F-D5710E4C5E0A</CompanyToken>
                        <Request>createToken</Request>
                        <Transaction>
                        <PaymentAmount>'.$amount.'</PaymentAmount>
                        <PaymentCurrency>USD</PaymentCurrency>
                        <CompanyRef>client#'.$session['user_id'].'</CompanyRef>
                        <RedirectURL>https://verifiedprofessors.com/wallet/card-callback</RedirectURL>
                        <BackURL>https://verifiedprofessors.com/wallet/index </BackURL>
                        <CompanyRefUnique>Deposit from Card Payment</CompanyRefUnique>
                        <PTL>5</PTL>
                        </Transaction>
                        <Services>
                          <Service>
                            <ServiceType>3854</ServiceType>
                            <ServiceDescription>Test Product</ServiceDescription>
                            <ServiceDate>2013/12/20 19:00</ServiceDate>
                          </Service>
                        </Services>
                    </API3G>'
                    )
                ))->setHeaders([
                'Content-Type' => 'application/xml',
            ])
                ->post(env('TOKEN_URL'));
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return print_r($response);
        }
    }

    public function actionCardCallback(){
        Yii::$app->session->setFlash('success', 'Payment was successful');
        return $this->redirect(['/wallet/index']);
    }

    public function actionPaypal()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if ($request->get('success') == true && Yii::$app->user->id == $session['user_id']) {
            $payerid = $request->get('PayerID');
            $paymentId = $request->get('paymentId');

            $paypal = Paypal::find()->where(['hash' => $session['paypal_hash']])->one();

            if ($paypal->payment_id == $paymentId) {
                $apiContext = $this->apiContext();
                $payment = \PayPal\Api\Payment::get($paypal->payment_id, $apiContext);

                $execute = new \PayPal\Api\PaymentExecution();
                $execute->setPayerId($payerid);
                try {
                    $payment->execute($execute, $apiContext);
                    //Update the payment status
                    $customer = Paypal::find()->where(['payment_id' => $paypal->payment_id])->one();
                    $customer->complete = 1;
                    $customer->save();
                    //send confirmation email
                    $user_id = Yii::$app->user->id;
                    $user = User::findOne($user_id);
                    Yii::$app->supportMailer->htmlLayout = "layouts/order";
                    Yii::$app->supportMailer->compose('wallet-deposit', [
                        'deposit' => $customer->amount_paid,
                        'user' => $user
                    ])->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' support'])
                        ->setTo($user->email)
                        ->setSubject('Payment Completed')
                        ->send();
                    //set amount to deposit table
                    $wallet = new Wallet();
                    $wallet->deposit = $customer->amount_paid;
                    $wallet->customer_id = Yii::$app->user->id;
                    $wallet->narrative = 'Deposit via Paypal';
                    $wallet->save();

                    //unset the hash
                    unset($session['paypal_hash']);
                    unset($session['user_id']);

                    //set flash
                    Yii::$app->session->setFlash('success', "Payment Successful, Your wallet balance has been updated. Thank you");
                    $session->close();
                    return $this->redirect(['wallet/index']);

                } catch (PayPalConnectionException $e) {
                    $this->refresh();
                    echo $e->getData();
                }
            } else {
                echo 'Errorneous transaction';
            }
        } else {
            Yii::$app->session->setFlash('danger', 'The deposit was not successful.');
            return $this->redirect(['index']);
        }
        return null;
    }

    public function actionCancel($success)
    {
        Yii::$app->session->setFlash('notpaid', 'The deposit was not successful.');
        return $this->redirect(['index']);
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['paypal', 'cancel', 'pay', 'order-canel'])) {

            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionReserve($oid, $amount)
    {
        if (is_numeric($amount)) {
            // process paypal transaction
            $session = Yii::$app->session;
            $session->open();
            $session['oid'] = $oid;
            $session['user_id2'] = Yii::$app->user->getId();
            $apiContext = $this->apiContext();

            //set payer
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            // ### Itemized information
            // (Optional) Lets you specify item wise
            // information
            $item = new Item();
            $item->setName('order #' . $oid)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($amount);
            $itemList = new ItemList();
            $itemList->setItems([$item]);
            //        // ### Transaction
            //        // A transaction defines the contract of a
            //        // payment - what is the payment for and who
            //        // is fulfilling it.

            $amnt = new \PayPal\Api\Amount();
            $amnt->setTotal($amount);
            $amnt->setCurrency('USD');

            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amnt);
            $transaction->setItemList($itemList);
            $transaction->setDescription('Reserve for order #' . $oid);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(Yii::$app->params['successUrl2'] . "?success=true")
                ->setCancelUrl(Yii::$app->params['cancelUrl2']);

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent set to 'sale'

            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            // For Sample Purposes Only.
            // $request = clone $payment;
            // ### Create Payment
            // Create a payment by calling the 'create' method
            // passing it a valid apiContext.
            // (See bootstrap.php for more on `ApiContext`)
            // The return object contains the state and the
            // url to which the buyer must be redirect

            try {
                $payment->create($apiContext);
                //hash the payment
                $hash = md5($payment->getId());
                $session['paypal_hash2'] = $hash;

                $connection = Yii::$app->db;
                $connection->createCommand()->insert('paypal', [
                    'user_id' => $session['user_id2'],
                    'payment_id' => $payment->getId(),
                    'amount_paid' => ($amount),
                    'order_number' => $oid,
                    'hash' => $session['paypal_hash2'],
                    'complete' => 0
                ])->execute();


            } catch (PayPalConnectionException $e) {
                echo $e->getData();
            }
            $approvalUrl = $payment->getApprovalLink();

            return $this->redirect($approvalUrl);
        } else {
            Yii::$app->session->setFlash('invalidAmt', 'The amount you entered is  invalid. The amount must be numeric.');
            return $this->redirect(['index']);
        }
    }

    public function actionPay()
    {
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if ($request->get('success') == true && Yii::$app->user->id == $session['user_id2']) {
            $payerid = $request->get('PayerID');
            $paymentId = $request->get('paymentId');

            $paypal2 = Paypal::find()->where(['hash' => $session['paypal_hash2']])->one();

            if ($paypal2->payment_id == $paymentId) {
                $apiContext = $this->apiContext();
                $payment = \PayPal\Api\Payment::get($paypal2->payment_id, $apiContext);

                $execute = new \PayPal\Api\PaymentExecution();
                $execute->setPayerId($payerid);
                try {
                    $payment->execute($execute, $apiContext);
                    //Update the payment status
                    $customer = Paypal::find()->where(['payment_id' => $paypal2->payment_id])->one();
                    $customer->complete = 1;
                    $customer->order_number = $session['oid'];
                    $customer->save();
                    //send confirmation email
                    $user_id = Yii::$app->user->id;
                    $user = User::findOne($user_id);
                    Yii::$app->supportMailer->htmlLayout = "layouts/order";
                    Yii::$app->supportMailer->compose('wallet-deposit', [
                        'deposit' => $customer->amount_paid,
                        'ordernumber' => $session['oid'],
                        'user' => $user
                    ])->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' support'])
                        ->setTo($user->email)
                        ->setSubject('Payment Completed')
                        ->send();
                    //mark the ordr as paid
                    $model = Order::find()->where(['ordernumber' => $session['oid']])->one();
                    $model->paid = 1;
                    $model->available = 1;
                    $model->save();
                    //unset the hash
                    unset($session['oid']);
                    unset($session['paypal_hash2']);
                    unset($session['user_id2']);
                    Yii::$app->session->setFlash('reserved', 'The payment has been reserved. 
                     Your order will be submitted within the deadline and you will have the chance to review the order before releasing the funds.');
                    $session->close();
                    return $this->redirect(['order/view', 'oid' => $session['oid']]);

                } catch (PayPalConnectionException $e) {
                    $this->refresh();
                    echo $e->getData();
                }
            } else {
                echo 'Errorneous transaction';
            }
        } else {
            Yii::$app->session->setFlash('danger', 'The deposit was not successful.');
            return $this->redirect(['index']);
        }
        return null;
    }

    public function actionOrderCancel($success)
    {
        $session = Yii::$app->session;
        Yii::$app->session->setFlash('notpaid', 'The deposit was not successful.');
        return $this->redirect(['order/view', 'oid' => $session['oid']]);
    }

    /**
     * Updates an existing Wallet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Wallet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function apiContext()
    {
        // After Step 1
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                Yii::$app->params['clientId'],     // ClientID
                Yii::$app->params['clientSecret']      // ClientSecret
            )
        );
        $apiContext->setConfig(
            array(
                'mode' => Yii::$app->params['mode'],
                'http.ConnectionTimeOut' => 30,
                'http.Retry' => 1,
                'log.FileName' => Yii::getAlias('@app/runtime/logs/paypal.log'),
                'log.LogLevel' => 'FINE',
                'validation.level' => 'log',
            )
        );
        return $apiContext;
    }

    /**
     * Finds the Wallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wallet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
