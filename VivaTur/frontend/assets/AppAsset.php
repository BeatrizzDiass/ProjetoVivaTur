<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'lib/animate/animate.min.css',
        'lib/owlcarousel/assets/owl.carousel.min.css',
        'lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
        'css/bootstrap.min.css',
        'css/style.css',
    ];
    
    public $js = [
        'lib/wow/wow.min.js',
        'lib/easing/easing.min.js',
        'lib/waypoints/waypoints.min.js',
        'lib/owlcarousel/owl.carousel.min.js',
        'lib/tempusdominus/js/moment.min.js',
        'lib/tempusdominus/js/moment-timezone.min.js',
        'lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
        'js/main.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_END
    ];
}