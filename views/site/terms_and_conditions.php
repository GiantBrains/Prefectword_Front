<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/28/18
 * Time: 3:35 PM
 */
$this->title = 'Terms and Conditions';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Read our strict plagiarism, privacy, and copyright policy to give you the best service as you order for assignment help.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Plagiarism free, Most confidential'
]);

?>
<div class="container" style="background-color: #fff">
    <h1 class="text-success" style="text-align: center;"><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <div class="site-terms">
        <div class="col-md-8 col-md-offset-2">
        <h3><strong>Terms and Conditions</strong></h3>
   <p>We reserve the right to change the Terms and Conditions stated above at any given time if the need arises.
        As such, we recommend that you read the Terms and Conditions often as using our services binds you to them at all times.</p>
        </div>
    </div>
</div>



