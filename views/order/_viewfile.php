

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <?php
        $order_file =  $model->attached.'-'.$model->file_date.'.'.$model->file_extension;
        ?>
        <span><a href="<?= Yii::$app->request->baseUrl?>/images/order/<?=$order_file ?>"  download><?= $model->attached.'.'.$model->file_extension ?></a></span>
    </td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span> <?=\yii\helpers\Html::a('Delete', ['order/file-delete', 'order'=>$model->order_id, 'file'=>$model->attached, 'file_extension'=>$model->file_extension, 'file_date'=>$model->file_date], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this file?',
                    'method' => 'post',
                ],
            ]) ?></span>
    </td>
</tr>