<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About Us';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Read our high school, college, university and Phd Level writing services we give. 
    We are the best online custom essay writers available 24/7.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Term Paper Writing, Essay Writing Service, Research Paper writing, 
    Lab report writing, Admission essay writing, Custom Essay Writing, 
    Dissertation writing service, Personal statement writing, Book Reviews and Reports, 
    Business Plan writing, Editing and Proofreading services, Statistical projects'
]);
?>
<div class="container" style="background-color: #fff">
    <h1 class="text-success" style="text-align: center;"><?= Html::encode($this->title) ?></h1>
    <div class="site-about">
        <div class="col-md-8 col-md-offset-2">
            <p>Prefectword is a reliable partner for experienced freelance writers in
                academic papers who provide high quality papers for our students. We have an open reviews section
                where our clients rate and give feedback on the service and their experience with us. It is easy to
                judge for yourself
                how satisfied our clients are. You can also contact us in case you have queries about our service and
                writers. You do not have to spend sleepless
                nights thinking about you can manage your job and classes. We can help you with that.
            </p>
            <p><strong class="text-success">Vision</strong></p>
            <p>To be a leading professional essay writing provider with 100% value for money.</p>
            <p><strong class="text-success">Mission</strong></p>
            <p>Our mission is to make sure that students have enough time to participate in other things by offering to
                help
                them complete their tasks on time while at the same time maintaining high-quality work that will improve
                their grades.</p>
            <p><strong class="text-success">Our Core Values</strong></p>
            <p>We are a team that is devoted and guided by the following five core values.</p>
            <ol>
                <li>Quality Work</li>
                <li>100% Uniqueness</li>
                <li>Native English</li>
                <li>Timely Delivery</li>
                <li>Zero Grammatical Errors</li>
                <li>Professional Customer Support</li>
            </ol>
        </div>
    </div>
</div>
