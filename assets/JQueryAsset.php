<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JQueryAsset extends AssetBundle
{
    public function init() {
        $this->jsOptions['position'] = View::POS_BEGIN;
        parent::init();
    }

    public $js = [
        'js/jquery-3.2.1.min.js'
    ];
}