<?php

use FastVolt\Router\Route;

Route::mixed(['GET', 'POST'],'/', 'HomeController@index', name: 'home');

Route::post('/compress', 'HomeController@upload_image', name: 'compress_image');

Route::get('/test', function () { 
    $file = 'hello.jsjjs.jjdd.jpg';
    echo preg_replace('/(.jpg)/', '', $file);
});

Route::get('/test2', function () {
    $url = resources_path('images/test.jpg', false);
    $save_to = resources_path('images/resize/', false);
    $font_file = resources_path('fonts/Ginger Cat.ttf', false);
    $width = 590;
    $height = 590;

    $save = \FastVolt\Helper\Image::build($url);
    $save->outputFormat('jpg');
    $save->resize($width, $height);
    $save->setQuality(100);
    $save->addTextWatermark('waploaded.com', 20, 'white', opacity: 100, position: 'bottom-right', fontFile: $font_file);
    $save->show();
});