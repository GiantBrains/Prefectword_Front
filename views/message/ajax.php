<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/20/18
 * Time: 10:25 AM
 */
$messages = <<<JS
function reloadchat(button,sendMessage) {
    // if (sendMessage)
    //     $('#ajax-loader').show();
    $.ajax({
        url: '/message/test',
        type: "POST",
        data: {
            'sendMessage':sendMessage,
            'firstname': $('#fname').val(),
        },
        success: function (data) {
            if (sendMessage)
            {
                // $('#ajax-loader').hide();
              $('#thename').html(data);
               console.log(data);
            }
            $("#chat-box").html(data);
        }
    });
}
$('#send-message').click(function(){
    reloadchat(this,true);
});
// setInterval(function () { reloadchat(null,false); }, 5000 );
JS;
$this->registerJs($messages);
?>


<div class="row">
    <div class="col-md-6">
        <h1 id="thename"></h1>
        <form action="<?php Yii::$app->request->baseUrl?>/message/test">
            <input id="fname" name="firstname" value="" >
            <input id="send-message" class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
</div>
