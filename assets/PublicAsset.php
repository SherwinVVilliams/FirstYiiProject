<?php 

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "web/public/css/bootstrap.min.css",
        "web/public/css/font-awesome.min.css",
        "web/public/css/animate.min.css",
        "web/public/css/owl.carousel.css",
        "web/public/css/owl.theme.css",
        "web/public/css/owl.transitions.css",
        "web/public/css/style.css",
        "web/public/css/responsive.css",
    ];
    public $js = [
    	//"web/public/js/jquery-1.11.3.min.js",
    	"web/public/js/bootstrap.min.js",
    	"web/public/js/owl.carousel.min.js",
    	"web/public/js/jquery.stickit.min.js",
    	"web/public/js/menu.js",
    	"web/public/js/scripts.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}


?>