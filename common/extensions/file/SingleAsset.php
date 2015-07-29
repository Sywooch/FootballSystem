<?php

namespace common\extensions\file;

use yii\web\AssetBundle;

/**
 * Single upload asset bundle.
 */
class SingleAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
	public $sourcePath = '@common/extensions/file/assets';

    /**
     * @inheritdoc
     */
	public $css = [
	    'css/single.css'
	];

    /**
     * @inheritdoc
     */
	public $depends = [
		'common\extensions\file\Asset'
	];
}
