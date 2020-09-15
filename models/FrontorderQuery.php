<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Frontorder]].
 *
 * @see Frontorder
 */
class FrontorderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Frontorder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Frontorder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
