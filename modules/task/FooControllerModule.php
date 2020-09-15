<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 5/16/18
 * Time: 7:23 PM
 */


class FooControllerModule extends UrbanIndo\Yii2\Queue\Worker\Controller
{
    public $title;
    public $body;

    public function actionBar()
    {
        try {
            $faker = \Faker\Factory::create();
            $post = new \app\models\Post();
            for ($i=1; $i <= 50; $i++){
                $post->setIsNewRecord(true);
                $post->id = null;
                $post->title = $faker->words(random_int(10,20), true);
                $post->body = $faker->paragraph(random_int(5, 50));
                $post->save();
            }
        } catch (\Exception $ex) {
            \Yii::error('Ouch something just happened');
            return false;
        }
    }
}