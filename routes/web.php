<?php

require_once(app_path('helpers.php'));

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', 'ProjectsController');
Route::name('uploads.')->group(function () {
    Route::get('uploads', 'FileUploadController@index')->name('index');
    Route::post('uploads', 'FileUploadController@store')->name('store');
    Route::post('uploads/download', 'FileUploadController@download')->name('download');
});
