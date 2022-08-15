<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/all.min.css',
        'code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'css/tempusdominus-bootstrap-4.min.css',
        'css/icheck-bootstrap.min.css',
        'css/jqvmap.min.css',
        'css/adminlte.min.css',
        'css/OverlayScrollbars.min.css',
        'css/daterangepicker.css',
        'css/bootstrap.min.css',
        'css/site.css',
        'css/summernote-bs4.min.css',
        'css/bootstrap.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/main.js',
        'js/adminlte.js',
        'js/bootstrap.bundle.min.js',
        'js/Chart.bundle.min.js',
        'js/dashboard.js',
        'js/daterangepicker.js',
        'js/demo.js',
        'js/jquery.js',
        'js/jquery.knob.min.js',
        'js/jquery.min.js',
        'js/jquery.overlayScrollbars.min.js',
        'js/jquery.vmap.js',
        'js/jquery.vmap.min.js',
        'js/jquery.vmap.usa.js',
        'js/jquery-ui.min.js',
        'js/moment.min.js',
        'js/sparkline.js',
        'js/summernote-bs4.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
