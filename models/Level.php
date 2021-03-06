<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
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
        return $this->hasMany(Frontorder::className(), ['level_id' => 'id']);
    }

    public static function getLevels()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    /**
     * @inheritdoc
     * @return LevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LevelQuery(get_called_class());
    }

    public static function getOrderLevel($level_id)
    {
        switch ($level_id) {
            case 1:
                $level = 1;
            break;
            case 2:
                $level = 1.2;
            break;
            case 4:
                $level = 1.3;
            break;
            case 5:
                $level = 1.5;
            break;
            default:
                $level = 1;
        }

        return $level;
    }
}
