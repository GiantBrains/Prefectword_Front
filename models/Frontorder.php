<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frontorder".
 *
 * @property int $id
 * @property int $service_id
 * @property int $type_id
 * @property int $urgency_id
 * @property int $pages_id
 * @property int $level_id
 * @property string $created_at
 *
 * @property Service $service
 * @property Type $type
 * @property Pages $pages
 * @property Level $level
 * @property Urgency $urgency
 */
class Frontorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frontorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'type_id', 'urgency_id', 'pages_id', 'level_id'], 'integer'],
            [['created_at'], 'safe'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['pages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['pages_id' => 'id']],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'id']],
            [['urgency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Urgency::className(), 'targetAttribute' => ['urgency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service',
            'type_id' => 'Type',
            'urgency_id' => 'Urgency',
            'pages_id' => 'Pages',
            'level_id' => 'Level',
            'created_at' => 'Created At',
        ];
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
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
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
    public function getUrgency()
    {
        return $this->hasOne(Urgency::className(), ['id' => 'urgency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @inheritdoc
     * @return FrontorderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FrontorderQuery(get_called_class());
    }
}
