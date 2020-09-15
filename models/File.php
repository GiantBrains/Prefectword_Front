<?php

namespace app\models;

use app\models\User;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $file_date
 * @property string $attached
 * @property string $file_extension
 * @property string $created_at
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id'], 'integer'],
            [['created_at'], 'safe'],
            [['attached'], 'file', 'maxSize' => 30000000, 'maxFiles' => 10],
            [['file_extension', 'file_date'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'file_date' => 'File Date',
            'attached' => 'Attached',
            'file_extension' => 'File Extension',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileQuery(get_called_class());
    }
}
