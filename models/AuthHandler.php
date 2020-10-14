<?php
namespace app\models;

use Yii;
use yii\authclient\ClientInterface;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->setData();
        try {
            $email = ArrayHelper::getValue($attributes, 'email');
        } catch (\Exception $e) {
        }
        try {
            $id = ArrayHelper::getValue($attributes, 'id');
        } catch (\Exception $e) {
        }
        try {
            $nickname = ArrayHelper::getValue($attributes, 'username');
        } catch (\Exception $e) {
        }
        /* @var Auth $auth */
        $myuser = User::findOne(['email'=> $email]);

        if (Yii::$app->user->isGuest) {
            if ($myuser){
                $auth = Auth::find()->where([
                    'source' => $this->client->getId(),
                    'user_id' =>  $myuser->id
                ])->one();
                if ($auth) { // login
                    /* @var User $user */
                    $user = $auth->user;
                    $auth->source_id = (string)$id;
                    $auth->save();
                    $this->updateUserInfo($user);
                    Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                    return Yii::$app->response->redirect(Url::to(['order/index']));
                }else {
                    //register new client
                    if ($email !== null && User::find()->where(['email' => $email])->exists()) {
                        $newauth = new Auth();
                        $newauth->source = $this->client->getId();
                        $newauth->source_id = (string)$id;
                        $newauth->user_id = $myuser->id;
                        $newauth->save();
                        $user = $newauth->user;
                        Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                       return Yii::$app->response->redirect(Url::to(['order/index']));
                    }
                }
            }else {
                //register new user
                try {
                    $password = Yii::$app->security->generateRandomString(6);
                } catch (Exception $e) {
                }
                $user = new User();
                $user->username = $nickname;
                $user->email = $email;
                $user->registration_ip = Yii::$app->request->userIP;
                $user->timezone = Yii::$app->timezone->name;
                $user->setPassword($password);
                $user->generateAuthKey();

                $transaction = User::getDb()->beginTransaction();

                if ($user->save()) {
                    $auth = new Auth([
                        'user_id' => $user->id,
                        'source' => $this->client->getId(),
                        'source_id' => (string)$id,
                    ]);
                    if ($auth->save()) {
                        try {
                            $transaction->commit();
                        } catch (\yii\db\Exception $e) {
                        }
                        $assignment = User::getUserAssignment($user->id);
                        if (empty($assignment)){
                            // the following three lines were added:
                            $auth = \Yii::$app->authManager;
                            $clientRole = $auth->getRole('client');
                            try {
                                $auth->assign($clientRole, $user->getId());
                            } catch (\Exception $e) {
                            }
                        }
                        Yii::$app->user->login($user, Yii::$app->params['user.rememberMeDuration']);
                        return Yii::$app->response->redirect(Url::to(['order/index']));
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save {client} account: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($auth->getErrors()),
                            ]),
                        ]);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to save user: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($user->getErrors()),
                        ]),
                    ]);
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    $this->updateUserInfo($user);
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->setData();
        try {
            $username = ArrayHelper::getValue($attributes, 'username');
        } catch (\Exception $e) {
        }
        if ($user->username == null && $username) {
            $user->username = $username;
            $user->save();
        }
    }


    public function setData()
    {
        $attributes = $this->client->getUserAttributes();
        $uniqueID = Uniqueid::findOne(1);
        $uuid = $uniqueID->uuid + 2;
        $data = [];
        if ($this->client->getId() == 'facebook') {
            try {
                $data['email'] = ArrayHelper::getValue($attributes, 'email');
            } catch (\Exception $e) {
            }
            try {
                $data['id'] = ArrayHelper::getValue($attributes, 'id');
            } catch (\Exception $e) {
            }
            $uuid = $uniqueID->uuid + 2;
            try {
                $data['username'] = strtolower(ArrayHelper::getValue($attributes, 'name')) . $uuid;
            } catch (\Exception $e) {
            }

        } elseif ($this->client->getId() == 'twitter') {
            try {
                $data['email'] = ArrayHelper::getValue($attributes, 'email');
            } catch (\Exception $e) {
            }
            try {
                $data['id'] = ArrayHelper::getValue($attributes, 'id');
            } catch (\Exception $e) {
            }
            try {
                $data['first_name'] = ArrayHelper::getValue($attributes, 'first_name');
            } catch (\Exception $e) {
            }
            try {
                $data['last_name'] = ArrayHelper::getValue($attributes, 'last_name');
            } catch (\Exception $e) {
            }
            $data['username'] = strtolower($data['first_name']) . $uuid;

        } elseif ($this->client->getId() == 'google') {
            $data['email'] = $attributes['email'];
            try {
                $data['id'] = ArrayHelper::getValue($attributes, 'id');
            } catch (\Exception $e) {
            }
            $data['last_name'] = !empty($attributes['family_name']) ? $attributes['family_name'] : null;
            $data['first_name'] = !empty($attributes['given_name']) ? $attributes['given_name'] : null;
            $data['username'] = strtolower($data['first_name']) . $uuid;
        }

        $uniqueID->uuid = $uuid;
        $uniqueID->save();

        return $data;
    }
}