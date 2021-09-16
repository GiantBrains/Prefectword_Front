<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 9/23/18
 * Time: 5:21 PM
 */
?>

<p style="font-size: 30px">PAYMENT CONFIRMATION</p>

<p style="text-transform: capitalize">Dear <?= $user->username ?>,</p>

<p>You have reserved $<?= $deposit ?>for order <?= $ordernumber ?> . please view your <a href="https://prefectword.com/order/view?oid=<?= $ordernumber?>">Order Page</a> to see the instructions.</p>

<p>Best Regards,</p>

<p>Support Team</p>