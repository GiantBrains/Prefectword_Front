<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $footer
 * @property string $blog
 * @property string $keywords
 * @property string $created_by
 * @property string $updated_by
 * @property string $slug
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'footer', 'blog', 'keywords', 'slug'], 'required'],
            [['blog'], 'string'],
            [['created_by', 'updated_by'], 'safe'],
            [['title', 'footer'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['keywords'], 'string', 'max' => 300],
            [['slug'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'footer' => 'Footer',
            'blog' => 'Blog',
            'keywords' => 'Keywords',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'slug' => 'Slug',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
