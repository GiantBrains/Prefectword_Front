<?php

namespace app\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $service_id
 * @property int $type_id
 * @property integer $active
 * @property int $revision
 * @property integer $completed
 * @property integer $approved
 * @property integer $cancelled
 * @property int $urgency_id
 * @property integer $ordernumber
 * @property integer $created_by
 * @property integer $written_by
 * @property integer $edited_by
 * @property int $spacing_id
 * @property int $pages_id
 * @property string $deadline
 * @property int $level_id
 * @property int $subject_id
 * @property int $style_id
 * @property int $sources_id
 * @property int $language_id
 * @property int $pagesummary
 * @property int $plagreport
 * @property int $initialdraft
 * @property string $topic
 * @property string $instructions
 * @property int $qualitycheck
 * @property int $topwriter
 * @property string $phone
 * @property string $promocode
 * @property double $amount
 * @property string $created_at
 *
 * @property Message[] $messages
 * @property User $createdBy
 * @property User $writtenBy
 * @property User $editedBy
 * @property Sources $service
 * @property Language $language
 * @property Type $type
 * @property Urgency $urgency
 * @property Pages $pages
 * @property Level $level
 * @property Subject $subject
 * @property Style $style
 * @property Sources $sources
 * @property Spacing $spacing
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'cancelled', 'ordernumber', 'created_by', 'written_by', 'edited_by', 'type_id', 'urgency_id', 'spacing_id', 'pages_id', 'level_id', 'subject_id', 'style_id', 'sources_id', 'language_id', 'pagesummary', 'plagreport', 'initialdraft', 'qualitycheck', 'topwriter'], 'integer'],
            [['topic', 'instructions','spacing_id', 'pages_id', 'service_id', 'type_id', 'urgency_id', 'level_id', 'subject_id', 'style_id', 'sources_id',], 'required'],
            [['instructions'], 'string'],
            [['created_at'], 'safe'],
            [['active', 'paid', 'completed', 'disputed', 'approved', 'rejected', 'editing', 'revision', 'available', 'confirmed',], 'boolean'],
            [['topic'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 255],
            [['amount'], 'number'],
            [['promocode'], 'string', 'max' => 100],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['written_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['written_by' => 'id']],
            [['edited_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['edited_by' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['urgency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Urgency::className(), 'targetAttribute' => ['urgency_id' => 'id']],
            [['pages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['pages_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['style_id'], 'exist', 'skipOnError' => true, 'targetClass' => Style::className(), 'targetAttribute' => ['style_id' => 'id']],
            [['sources_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::className(), 'targetAttribute' => ['sources_id' => 'id']],
            [['spacing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spacing::className(), 'targetAttribute' => ['spacing_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordernumber' => 'Order ID',
            'created_by' => 'Client',
            'written_by' => 'Writer',
            'edited_by' => 'Editor',
            'service_id' => 'Service',
            'deadline' => 'Deadline',
            'type_id' => 'Type',
            'urgency_id' => 'Urgency',
            'spacing_id' => 'Spacing',
            'pages_id' => 'Pages',
            'level_id' => 'Level',
            'subject_id' => 'Subject',
            'style_id' => 'Style',
            'sources_id' => 'Sources',
            'language_id' => 'Language',
            'pagesummary' => 'Pagesummary',
            'plagreport' => 'Plagreport',
            'initialdraft' => 'Initialdraft',
            'topic' => 'Topic',
            'instructions' => 'Instructions',
            'qualitycheck' => 'Qualitycheck',
            'topwriter' => 'Topwriter',
            'phone' => 'Phone',
            'promocode' => 'Promocode',
            'amount' => 'Amount',
            'cancelled' => 'Cancelled',
            'created_at' => 'Created At',
        ];
    }

    public static function allCompletedOrders()
    {
        $command = \Yii::$app->db->createCommand("SELECT doctorateessays.order.id as id, 
            doctorateessays.order.ordernumber as ordernumber, 
            doctorateessays.order.completed as completed, 
            doctorateessays.order.approved as approved, 
            uploaded.dowload_date as download_date, 
            DATE_ADD(uploaded.dowload_date, INTERVAL 3 DAY) as approval_date, 
            doctorateessays.order.revision as revision, 
            doctorateessays.order.active as active
            FROM doctorateessays.order LEFT JOIN uploaded ON doctorateessays.order.id = uploaded.order_number 
            WHERE doctorateessays.order.completed = 1 
            AND doctorateessays.order.approved = 0 
            AND doctorateessays.order.active = 0 
            AND doctorateessays.order.revision = 0 
            AND uploaded.dowload_date=(SELECT max(dowload_date) 
            FROM uploaded WHERE uploaded.order_number = doctorateessays.order.id) 
            ORDER BY download_date ASC");
        $result = $command->queryAll();
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWrittenBy()
    {
        return $this->hasOne(User::className(), ['id' => 'written_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'edited_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrgency()
    {
        return $this->hasOne(Urgency::className(), ['id' => 'urgency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasOne(Pages::className(), ['id' => 'pages_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStyle()
    {
        return $this->hasOne(Style::className(), ['id' => 'style_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSources()
    {
        return $this->hasOne(Sources::className(), ['id' => 'sources_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpacing()
    {
        return $this->hasOne(Spacing::className(), ['id' => 'spacing_id']);
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public static function getLogoName()
    {
        Yii::$app->view->params['logo'] = User::getSiteLogo();
        Yii::$app->view->params['name'] = User::getSiteName();
    }

    public static function getBalance()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id =' . Yii::$app->user->id . '');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit - $totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
    }

    public static function getOrdersCount()
    {
        $cancel_count = Order::find()->where(['cancelled' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available' => 1])->andWhere(['cancelled' => 0])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $pending_count = Order::find()->where(['paid' => 0])->andWhere(['cancelled' => 0])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active' => 1])->andWhere(['cancelled' => 0])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed' => 1])->andFilterWhere(['created_by' => Yii::$app->user->id])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
    }

}
