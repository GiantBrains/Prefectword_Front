<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urgency".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 * @property Order[] $orders
 */
class Urgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urgency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontorders()
    {
        return $this->hasMany(Frontorder::className(), ['urgency_id' => 'id']);
    }

    public static function getUrgency()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['urgency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UrgencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UrgencyQuery(get_called_class());
    }

    public static function getOrderUrgency($urgency_id)
    {
        switch ($urgency_id) {
            case 1:
                $urgency = 3;
            break;
            case 2:
                $urgency = 6;
            break;
            case 3:
                $urgency = 12;
            break;
            case 4:
                $urgency = 24;
            break;
            case 5:
                $urgency = 48;
            break;
            case 6:
                $urgency = 72;
            break;
            case 7:
                $urgency = 96;
            break;
            case 8:
                $urgency = 120;
            break;
            case 9:
                $urgency = 144;
            break;
            case 10:
                $urgency = 168;
            break;
            case 11:
                $urgency = 192;
            break;
            case 12:
                $urgency = 240;
            break;
            case 13:
                $urgency = 336;
            break;
            case 14:
                $urgency = 672;
            break;
            case 15:
                $urgency = 1344;
            break;
            default:
                $urgency = 3;
        }

        return $urgency;
    }

    public static function getOrderDeadline($urgency_id)
    {
        switch ($urgency_id) {
            case 1:
                $deadline = 2.5;
            break;
            case 2:
                $deadline = 2.0;
            break;
            case 3:
                $deadline = 1.8;
            break;
            case 4:
                $deadline = 1.6;
            break;
            case 5:
                $deadline = 1.5;
            break;
            case 6:
                $deadline = 1.4;
            break;
            case 7:
                $deadline = 1.3;
            break;
            case 8:
                $deadline = 1.2;
            break;
            case 9:
                $deadline = 1.2;
            break;
            case 10:
                $deadline = 1.1;
            break;
            case 11:
                $deadline = 1.1;
            break;
            case 12:
                $deadline = 1.1;
            break;
            case 13:
            case 14:
            case 15:
                $deadline = 1.0;
            break;
            default:
                $deadline = 2.5;
        }

        return $deadline;
    }
}
