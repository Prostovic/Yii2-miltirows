<?php

/**
 * @package   yii2-multirows
 * @author    Victor Kozmin <promcalc@gmail.com>
 * @copyright Copyright &copy; Victor Kozmin, 2015
 * @version   1.0.0
 */

namespace prostovic\yii2multirows;

use yii\web\AssetBundle; 

/**
 * Asset bundle for Yii2-multirow Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class MultirowsAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ]; 

    public $js = [
        'assets/js/multirows.js',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
