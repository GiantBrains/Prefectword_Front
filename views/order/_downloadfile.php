

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <?php
        $order_file =  $model->name.'-'.$model->file_date.'.'.$model->file_extension;
        Yii::setAlias('@adminsource', 'https://admin.doctorateessays.com');
        ?>
        <span><?= $model->name.'.'.$model->file_extension ?></span>
    </td>
    <td>
        <span><?= $model->file_type == 0 ? '<span>Draft</span>': '<span>Final Product</span>'?></span>
    </td>
    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
    $ptime = $startTime->format("M d, Y g:i a");
    ?>
    <td><span><?= $ptime; ?></span></td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a type="button" class="btn btn-xs btn-success" href="<?= \yii\helpers\Url::to(['order/download', 'file_name'=>$model->name, 'file_date'=>$model->file_date, 'file_extension'=>$model->file_extension])?>"> <i class="fa fa-download fa-2x" aria-hidden="true"></i></a></span>
    </td>
</tr>