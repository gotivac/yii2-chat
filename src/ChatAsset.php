<?php

namespace gotivac\chat;

use yii\web\AssetBundle;

/**
 * Module asset bundle
 */
class ChatAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@gotivac/chat/assets';

    public $css = [
        'images/images.css',

    ];

} 