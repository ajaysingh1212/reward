<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Row Data
    Route::apiResource('row-datas', 'RowDataApiController');

    // Winner
    Route::post('winners/media', 'WinnerApiController@storeMedia')->name('winners.storeMedia');
    Route::apiResource('winners', 'WinnerApiController');

    // Campaign
    Route::apiResource('campaigns', 'CampaignApiController');

    // Web Page
    Route::post('web-pages/media', 'WebPageApiController@storeMedia')->name('web-pages.storeMedia');
    Route::apiResource('web-pages', 'WebPageApiController');
});
