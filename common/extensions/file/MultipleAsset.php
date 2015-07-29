<?php

namespace common\extensions\file;

use yii\web\AssetBundle;

/**
 * Multiple upload asset bundle.
 */
class MultipleAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
	public $sourcePath = '@common/extensions/file/assets';

    /**
     * @inheritdoc
     */
	public $css = [
	    'css/multiple.css'
	];

    /**
     * @inheritdoc
     */
	public $depends = [
		'common\extensions\file\Asset'
	];
}
