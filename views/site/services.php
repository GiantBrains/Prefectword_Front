<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/2/18
 * Time: 2:36 PM
 */
$this->title = 'Our Services';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'If you need help with your assignment or extra credit paper that is due, you need the best online essay writer for the task. Get a custom paper with free cover page, free work cited page, free plagiarism report among other offers.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Custom essay,essay help, research paper, free essays, write my essay, best essay writers,extra credit paper, plagiarism free, online essay writing,great paper, cheap, best writing website'
]);
?>
<div class="container">
    <div class="col-md-10">
        <h1 class="text-primary" style="text-align: center" ><?= \yii\helpers\Html::encode($this->title) ?></h1>
        <div style="font-size: 16px">
            <p>Are you running out of time? Do you feel the task is too tough for you to handle?
                Are your hands all full that you can't get the time to handle your class assignment at the same time?
                We are here for you.
                We handle all kind of papers across all fields of study. Our professional freelance writers have a vast experience that will guarantee quality work.
                We also promise to deliver the work on time regardless of how tight the deadline might be.
                Whenever you come to us like "Someone, please help me complete my assignment,
                I'm running out of time and Ideas," we promise to hear your call and come to your help.</p>
            <p>Our professional writers hold PhDs in various fields and depending on the level of writing you need, we will do exactly that.
                We offer essay help services to students across the globe, and our custom essays have helped more than
                one million students to achieve their academic goals.</p>
            <p>Some students come to us like “I need someone to write my project/research proposal, essay, lab report, admission essay, etc.
                Can someone please write it for me?” We always are there for such students.
                We receive referrals from students who have seen a significant improvement in their grades as a result of using our services.
                The sweeter part about all this is that the services are at a low price as compared to other websites that try to offer the same services.</p>
            <strong>Our services include but not limited to the following:</strong>
            <ol>
                <li>Term Paper Writing</li>
                <li>Essay Writing Service</li>
                <li>Research Paper writing</li>
                <li>Lab report writing</li>
                <li>Admission essay writing</li>
                <li>Custom Essay Writing</li>
                <li>Dissertation writing service</li>
                <li>Personal statement writing</li>
                <li>Book Reviews and Reports</li>
                <li>Business Plan writing</li>
                <li>Editing and Proofreading services</li>
                <li>Statistical projects</li>
            </ol>
            Try us today, and we promise quality work. Get the maximum value for your money with

            <a href="<?= Yii::$app->request->baseUrl?>/site/services">doctorateessays.com</a>
        </div>
    </div>
</div>
