<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reject".
 *
 * @property integer $id
 * @property integer $order_number
 * @property integer $reason_id
 * @property string $description
 * @property string $created_at
 *
 * @property Reason $reason
 */
class Reject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'description','reason_id'], 'required'],
            [['order_number', 'reason_id'], 'integer'],
            [['description'], 'string',  'max' => 150],
            [['created_at'], 'safe'],
            [['reason_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reason::className(), 'targetAttribute' => ['reason_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => 'Order Number',
            'reason_id' => 'Reason',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(Reason::className(), ['id' => 'reason_id']);
    }

    /**
     * @inheritdoc
     * @return RejectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RejectQuery(get_called_class());
    }
}
