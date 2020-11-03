<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_payments".
 *
 * @property int $id
 * @property string $transaction_token
 * @property string $transaction_ref
 * @property double $amount
 * @property int $user_id
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class CardPayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_token', 'transaction_ref', 'amount', 'user_id'], 'required'],
            [['amount'], 'number'],
            [['user_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['transaction_token'], 'string', 'max' => 300],
            [['transaction_ref'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_token' => 'Transaction Token',
            'transaction_ref' => 'Transaction Ref',
            'amount' => 'Amount',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
