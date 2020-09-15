<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 1/21/18
 * Time: 3:44 PM
 */
?>
<tr>
    <td><?= $paypal->narrative ?></td>
    <?php
    if ($paypal->deposit == 0){
        echo '<td></td>';
    }else{
        echo '<td> $'.number_format(floatval($paypal->deposit), 2, '.', ',') .'</td>';
    }
    ?>

    <?php
    if ($paypal->withdraw == 0){
        echo '<td></td>';
    }else{
      echo '<td> $'.number_format(floatval($paypal->withdraw), 2, '.', ',') .'</td>';
    }
    ?>
    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$paypal->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
    $ptime = $startTime->format("M d, Y g:i a");
    ?>
    <td><?= $ptime; ?></td>
</tr>
