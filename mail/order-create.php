<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 9/22/18
 * Time: 8:50 PM
 */
?>
<p style="font-size: 30px">ORDER CREATE CONFIRMATION</p>

<p style="text-transform: capitalize">Dear <?= $user->username ?>,</p>

<p>You have created order <?= $model->ordernumber ?> "<?= $model->topic?>".</p>

<p>Support will assign your order to the most qualified writer.</p>

<p>Communicate with the writer and provide all necessary information</p>

<p>Download drafts and the completed paper</p>

<p>Note: it is completely secure and confidential to use the prefectword.com freelance board as long as you do not share your personal information with other users.</p>

Please go to the <a href="https://prefectword.com/order/view?oid=<?= $model->ordernumber ?>">Order Page</a> to proceed.


<p>Best Regards,</p>

<p>Support Team</p>
