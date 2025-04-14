
    <?php foreach ($messages as $time => $message) :?>
    <?php
    if ($message['user_id'] === Yii::$app->user->identity->id) {
        $colorStyle = 'color:blue;';
    } else {
        $colorStyle = '';
    }
    ?>
    <div style="<?=$colorStyle;?>">[<?=date("H:i:s",$time);?>] <b><?=$message['name'];?>:</b> <?=$message['message'];?></div>
    <?php endforeach; ?>


