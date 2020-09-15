<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property double $value
 * @property integer $client_id
 * @property integer $order_number
 * @property string $description
 * @property string $created_at
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'client_id', 'order_number'], 'required'],
            [['value'], 'number'],
            [['client_id', 'order_number'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'client_id' => 'Client ID',
            'order_number' => 'Order Number',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return RatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RatingQuery(get_called_class());
    }
}
