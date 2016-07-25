<?php
namespace c006\user\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class AssetGridView
 * @package c006\cms\assets
 */
class AssetGridView extends AssetBundle
{

    /**
     * @inheritdoc
     */
//    public $sourcePath = '@frontend/web/';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/grid-view.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}
