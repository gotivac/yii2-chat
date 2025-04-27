<div class="chat-default-index content p-4">
    <div class="row">

        <div class="col-sm-12">
            <div id="chat-box">
                <?= $this->render('_msgbox', compact('messages')) ?>
            </div>
        </div>

        <?php if (Yii::$app->user->isGuest) : ?>
            <div id="chat-box" class="col-sm-12">
                <h2><?= Yii::t('chat', 'Register to take part in chat') ?></h2>
            </div>
        <?php else : ?>


            <div class="input-group col-sm-12 mt-4">
                <input id="chat-message" class="form-control" aria-invalid="false"/>
                <button type="submit" id="send-message" class="btn btn-success" data-thread="<?= $thread; ?>"
                        data-id="<?= $user->id ?>" data-name="<?= $user->chatname ?>"
                        data-icon="<?= $user->chaticon ?>">
                    <i class="bi bi-send"></i>
                </button>
            </div>



        <?php endif; ?>
    </div>
</div>
<?php
$script = <<<SCRIPT
function reloadchat(button,sendMessage) {
    if (sendMessage)
        $('#send-message').addClass('button-loader');
    $.ajax({
        url: '/chat/default/send-message/?thread={$thread}',
        type: "POST",
        data: {
            'sendMessage':sendMessage,
            'ChatModel[user_id]': $(button).data('id'),
            'ChatModel[thread]': $(button).data('thread'),
            'ChatModel[name]': $(button).data('name'),
            'ChatModel[icon]': $(button).data('icon'),
            'ChatModel[message]': $('#chat-message').val(),
            
        },
        success: function (html) {
            if (sendMessage)
            {
                $('#send-message').removeClass('button-loader');
                $('#chat-message').val('')
            }
            
             $("#chat-box").html(html);
             setTimeout(function () {
             var chatBox = $('#chat-box');
             chatBox.scrollTop(chatBox[0].scrollHeight);
             
             },1);
             
            
                
        }
    });
}
$('#send-message').click(function(){
    if ($("#chat-message").val() == '') return;
    reloadchat(this,true);
});
setInterval(function () { reloadchat(null,false); }, 5000 );

$(document).ready(function(){
    var chatBox = $('#chat-box');
    chatBox.scrollTop(chatBox[0].scrollHeight);
    $('#chat-message').keyup(function(e){
        var code = e.key;
        if (code === 'Enter') {
            $('#send-message').trigger('click');
        }
    });
});


SCRIPT;
$this->registerJs($script, $this::POS_READY);
?>
