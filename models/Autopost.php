<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 5/16/18
 * Time: 4:50 PM
 */

namespace app\models;

use Yii;
use  yii\base\BaseObject;
use  app\models\Order;
use yii\queue\JobInterface;

class Autopost extends BaseObject implements JobInterface
{

    public $title;
    public $body;

    public function execute($queue)
    {
      $faker = \Faker\Factory::create();
      $post = new Post();
      for ($i=1; $i <= 50; $i++){
          $post->setIsNewRecord(true);
          $post->id = null;
          $post->title = $faker->words(random_int(10,20), true);
          $post->body = $faker->paragraph(random_int(5, 50));
          $post->save();
      }
    }
}