<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 *
 * @property Order[] $orders
 * @property Frontorder[] $frontorders
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
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
        return $this->hasMany(Frontorder::className(), ['type_id' => 'id']);
    }

    public static function getTypes()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->orderBy('name ASC')->column();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypeQuery(get_called_class());
    }

    public static function getOrderType($type_id)
    {
        switch ($type_id) {
            case 1:
                $type = 1.2;
            break;
            case 2:
                $type = 1.2;
            break;
            case 3:
                $type = 1.2;
            break;
            case 4:
                $type = 1.2;
            break;
            case 5:
                $type = 1.2;
            break;
            case 6:
                $type = 1.2;
            break;
            case 7:
                $type = 1.2;
            break;
            case 8:
                $type = 1.2;
            break;
            case 9:
                $type = 1.2;
            break;
            case 10:
                $type = 1.2;
            break;
            case 11:
                $type = 1.2;
            break;
            case 12:
                $type = 1.2;
            break;
            case 13:
                $type = 1.2;
            break;
            case 14:
                $type = 1.2;
            break;
            case 15:
                $type = 1.2;
            break;
            case 16:
                $type = 1.2;
            break;
            case 17:
                $type = 1.2;
            break;
            case 18:
                $type = 1.2;
            break;
            case 19:
                $type = 1.2;
            break;
            case 20:
                $type = 2.9;
            break;
            case 22:
                $type = 2.0;
            break;
            case 23:
                $type = 2.2;
            break;
            case 24:
                $type = 1.5;
            break;
            case 25:
                $type = 1.2;
            break;
            case 26:
                $type = 1.2;
            break;
            case 27:
                $type = 0.7;
            break;
            case 28:
                $type = 0.8;
            break;
            case 31:
                $type = 1.2;
            break;
            case 32:
                $type = 1.2;
            break;
            case 33:
                $type = 1.2;
            break;
            case 34:
                $type = 1.2;
            break;
            case 35:
                $type = 2.2;
            break;
            case 36:
                $type = 1.2;
            break;
            case 37:
                $type = 1.2;
            break;
            case 38:
                $type = 1.2;
            break;
            case 39:
                $type = 1.5;
            break;
            case 40:
                $type = 1.2;
            break;
            case 41:
                $type = 1.4;
            break;
            case 42:
                $type = 1.4;
            break;
            case 43:
                $type = 1.4;
            break;
            case 44:
                $type = 1.3;
            break;
            case 45:
                $type = 1.2;
            break;
            default:
                $type = 1.2;
        }
        return $type;
    }
}