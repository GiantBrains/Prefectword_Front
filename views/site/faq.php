<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/6/18
 * Time: 2:26 PM
 */
$this->title = 'Frequently Asked Questions(FAQs)';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Got very urgent questions regarding assignment or essay help? Read our FAQ for quick answers. We also have agents available 24/7.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Urgent questions, Essay help, Please help'
]);
?>

<div class="container" style="background-color:white; border-color: #ddd;">
    <div class="col-md-8 col-md-offset-2">
    <h1 class="text-success" ><?= \yii\helpers\Html::encode($this->title) ?></h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" style="min-height: 60px" >
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. How long does it take to complete my assignment?
                        </a>
                    </h4>
                </div>
                <div style="min-height: 60px" id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        We work with the deadline you provide. However, we make sure that we deliver the work on time so that you have enough time to review it.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div style="min-height: 60px"  class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. How do I place an order?
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        It's simple. Just log in, and you will be automatically directed to the place order page. Read <a href="<?= Yii::$app->request->baseUrl?>/site/how_it_works">HOW IT WORKS</a> page.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. Can I get updates on my order?
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        Yes. Our writers send drafts as often as the client needs them. This helps the client to be assured that we are working on their paper and that the writer is doing the right thing. In case the writer doesn't provide you with a draft after asking for it, you can contact the customer support team.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                            4. What if the writer did not follow instructions?
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class="panel-body">
                        We strive to deliver the best quality work to our clients. In the case where a writer delivers bad quality work, the client has the right to reject the order and request for a refund for the money. However, you can only do this before 72 hours after the deadline or after downloading the paper.
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingFive">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                            5. When can I contact you?
                        </a>
                    </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                    <div class="panel-body">
                        We are available 24/7. Therefore you can always contact us at any time of the day, and we will promptly respond.
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingSix">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                            6. Can I withdraw my money back to my PayPal account?
                        </a>
                    </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                    <div class="panel-body">
                        Yes you can. You just need to send a withdraw request, and we will process it within 2 days.
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingSeven">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">
                            7. Do you provide a plagiarism reports for your papers?
                        </a>
                    </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                    <div class="panel-body">
                        We provide FREE plagiarism reports to our customers. However, you must ask for it in the order instructions before we provide since we handle so many papers.
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div style="min-height: 60px" class="panel-heading" role="tab" id="headingEight">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseThree">
                            8. What if a writer did my paper and I failed the paper?
                        </a>
                    </h4>
                </div>
                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                    <div class="panel-body">
                        We handle such incidences on a case by case basis. You can report to us, and we will consider whether to refund or not, depending on how genuine your claim is. However, we recommend that you check your paper before releasing the funds to the writer to avoid such instances.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
