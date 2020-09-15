<?php
foreach ($order_messages as $order_message) {
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$order_message->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    $ptime = $startTime->format("M d, Y H:i");
    echo '<div class="mymessage row" style="height: auto; padding: 5px 10px 5px 10px">';
    if ($order_message->sender_id != Yii::$app->user->id){
        echo '<div  class="col-md-7" style="text-align: left; border-radius: 5px; background-color: #ECEFF4">';
        echo '<div>'.$order_message->message.'</div>';
        echo '<div style="text-decoration: underline"><span style="font-style: italic; font-size: small">'.$ptime.'</span></div>';
        echo '</div>';
    }else{
        echo '<div  class="col-md-7 col-md-push-5" style="border-radius: 5px; background-color: #e2e9e4">';
        echo '<div style="text-align: left">'.$order_message->message.'</div>';
        echo '<div style="text-decoration: underline; text-align: left"><span style="font-style: italic; font-size: small">'.$ptime.'</span></div>';
        echo '</div>';
    }
    echo '</div>';
}
?>