<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/28/18
 * Time: 4:45 PM
 */
$this->title = 'Money Back Guarantee';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'We are legit and give your money back whenever you are not satisfied with our service. Read our money back policy.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Trusted custom essays, Legit essay writers, Trusted online writing'
]);
?>
<div class="container">
    <h1 class="text-primary" ><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <div class="row" style="background-color:#f5f5f5; border-color: #ddd;">
    <div class="col-md-8">
        <p>Are you afraid that you might lose money by paying for an essay that does not meet your expectations?
        You do not need to worry anymore. We have made sure to take care of this in our Money Back Guarantee policy.
        We are a legitimate company offering the best essay writing service to more than 1 million students from across the globe.
        Due to the trust that these clients have in us,
            we make sure we maintain the trust by giving the best services them and refunding when necessary.</p>
        <p>There are several incidences where we are obliged to refund back our customers’ money.</p>
        <ol>
            <li>In the case the customer creates a duplicate order and wishes to cancel one of the order,
                the customer can cancel the order and claim a refund of the amount paid for the order.</li>
            <li>The customer can change his/her mind concerning an order for which he/she has already reserved money.
                In this case, the customer has the right to cancel the order and request a refund.
                However, we recommend that the customer be careful when placing an order such that he/she is sure about
                the order to avoid cancellations. If a customer cancels an order that had already been assigned to a writer,
                we reserve the right to hold back some money to compensate the writer for the time consumed working on the order.
                This is in case the customer cancels the work more than an hour after the writer has been assigned.
                If the customer cancels the order after half of the time allocated for the order is gone, he/she is
                entitled to a refund of not more than 50% of the total order cost. We, therefore, recommend that our customers
                confirm their order details before assigning the order to the writer.</li>
            <li>If the writer delivers low quality or plagiarized work to the customer,
                the customer reserves the right to cancel the order and request for a refund of the total order cost.
                We, therefore, recommend that as a customer, you should check and review the work delivered to you
                immediately after downloading it and before releasing the funds to the writer.
                Releasing the funds to the writer means that you have gone through the work and that you are satisfied with it.
                Therefore you confirm that you will not bring any other claim regarding the quality of the work under the same order.
                However, we allow customers to bring back some claims at our own discretion, especially in cases where the writer has plagiarized the work.
                All types of refund requests are processed within 24 hours after requesting, except on weekends.
                The refunds are made to your <a href="<?= Yii::$app->request->baseUrl?>/">www.doctorateessays.com</a> wallet.</li>
            <li>If a customer deposits money in their wallet and wishes to withdraw it without creating an order,
                we allow them to do so. We take 2 working days to process such withdraw requests.</li>
        </ol>
    </div>
    </div>
</div>
