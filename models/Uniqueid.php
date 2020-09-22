<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uniqueid".
 *
 * @property integer $id
 * @property integer $orderid
 * @property integer $uuid
 */
class Uniqueid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uniqueid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderid'], 'required'],
            [['orderid', 'uuid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderid' => 'Orderid',
            'uuid' => 'UUID',
        ];
    }

    /**
     * @inheritdoc
     * @return UniqueidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniqueidQuery(get_called_class());
    }
}
