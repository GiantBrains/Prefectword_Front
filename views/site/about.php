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
    <h1 class="text-primary" style="text-align: center;"><?= Html::encode($this->title) ?></h1>
    <div class="site-about">
    <p>Verified Professors is a reliable partner for professional freelance writers with experience in
        students papers to provide high quality papers for our clients. We have an open reviews section
        where our customers give us feedback on their experience with us. It is easy to judge yourself
        from the reviews how satisfied our clients are with the service. You do not have to spend sleepless
        nights thinking of how you will improve your grade. Let us do it essay for you while you do other
        duties.
    </p>
    <p><strong class="text-primary">Vision</strong></p>
    <p>To be the one site that gives clients 100% value for money by offering the best essay writing services across the globe.</p>
    <p><strong class="text-primary">Mission</strong></p>
    <p>Our mission is to make sure that students have enough time to participate in other school activities by offering to help
      them complete their tasks on time while at the same time maintaining high-quality work that will improve their grades.</p>
    <p><strong class="text-primary">Our Core Values</strong></p>
    <p>We are a team that is devoted and guided by the following five core values.</p>
    <ol>
        <li>Quality Work</li>
        <li>100% Uniqueness</li>
        <li>Timely Delivery</li>
        <li>Zero Grammar Errors</li>
        <li>Professional Customer Support</li>
    </ol>
</div>
</div>
