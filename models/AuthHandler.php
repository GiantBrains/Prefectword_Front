<?php
namespace app\models;

use Yii;
use yii\authclient\ClientInterface;
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
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $nickname = ArrayHelper::getValue($attributes, 'username');
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
                $password = Yii::$app->security->generateRandomString(6);
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
                        $transaction->commit();
                        $assignment = User::getUserAssignment($user->id);
                        if (!empty($assignment)){
                            // the following three lines were added:
                            $auth = \Yii::$app->authManager;
                            $clientRole = $auth->getRole('client');
                            $auth->assign($clientRole, $user->getId());
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
        $username = ArrayHelper::getValue($attributes, 'username');
        if ($user->username == null && $username) {
            $user->username = $username;
            $user->save();
        }
    }


    public function setData()
    {
        $attributes = $this->client->getUserAttributes();
        $data = [];
        if ($this->client->getId()== 'facebook'){
            $data['email']= ArrayHelper::getValue($attributes, 'email');
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['username']= ArrayHelper::getValue($attributes, 'name');;

        } elseif ($this->client->getId()== 'twitter'){
            $data['email']= ArrayHelper::getValue($attributes, 'email');
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['first_name']= ArrayHelper::getValue($attributes, 'first_name');
            $data['last_name']= ArrayHelper::getValue($attributes, 'last_name');
            $data['username']= $data['first_name'];

        }elseif ($this->client->getId() == 'google'){
            $data['email'] = $attributes['emails'][0]['value'];
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['last_name'] = !empty($attributes['name']['familyName']) ? $attributes['name']['familyName'] : null;
            $data['first_name'] = !empty($attributes['name']['givenName']) ? $attributes['name']['givenName'] : null;
            $data['username']= $data['first_name'];
        }

        return $data;
    }
}