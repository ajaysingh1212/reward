<?php

use App\Http\Controllers\RewardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default Route → Reward Page
|--------------------------------------------------------------------------
*/
Route::get('/', [RewardController::class, 'index'])->name('reward.page');

/*
|--------------------------------------------------------------------------
| Login Route → Only when /login is typed
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Home Route → After Login (Admin Dashboard)
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')
            ->with('status', session('status'));
    }

    return redirect()->route('admin.home');
})->middleware('auth');


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/row-data', [\App\Http\Controllers\Admin\HomeController::class, 'rowDataAjax'])
        ->name('dashboard.rowData');

    Route::get('/dashboard/winner-data', [\App\Http\Controllers\Admin\HomeController::class, 'winnerDataAjax'])
        ->name('dashboard.winnerData');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Row Data
    Route::delete('row-datas/destroy', 'RowDataController@massDestroy')->name('row-datas.massDestroy');
    Route::post('row-datas/parse-csv-import', 'RowDataController@parseCsvImport')->name('row-datas.parseCsvImport');
    Route::post('row-datas/process-csv-import', 'RowDataController@processCsvImport')->name('row-datas.processCsvImport');
    Route::resource('row-datas', 'RowDataController');

    // Winner
    Route::delete('winners/destroy', 'WinnerController@massDestroy')->name('winners.massDestroy');
    Route::post('winners/media', 'WinnerController@storeMedia')->name('winners.storeMedia');
    Route::post('winners/ckmedia', 'WinnerController@storeCKEditorImages')->name('winners.storeCKEditorImages');
    Route::post('winners/parse-csv-import', 'WinnerController@parseCsvImport')->name('winners.parseCsvImport');
    Route::post('winners/process-csv-import', 'WinnerController@processCsvImport')->name('winners.processCsvImport');
    Route::resource('winners', 'WinnerController');

    // Campaign
    Route::delete('campaigns/destroy', 'CampaignController@massDestroy')->name('campaigns.massDestroy');
    Route::post('campaigns/parse-csv-import', 'CampaignController@parseCsvImport')->name('campaigns.parseCsvImport');
    Route::post('campaigns/process-csv-import', 'CampaignController@processCsvImport')->name('campaigns.processCsvImport');
    Route::resource('campaigns', 'CampaignController');

    // Web Page
    Route::delete('web-pages/destroy', 'WebPageController@massDestroy')->name('web-pages.massDestroy');
    Route::post('web-pages/media', 'WebPageController@storeMedia')->name('web-pages.storeMedia');
    Route::post('web-pages/ckmedia', 'WebPageController@storeCKEditorImages')->name('web-pages.storeCKEditorImages');
    Route::post('web-pages/parse-csv-import', 'WebPageController@parseCsvImport')->name('web-pages.parseCsvImport');
    Route::post('web-pages/process-csv-import', 'WebPageController@processCsvImport')->name('web-pages.processCsvImport');
    Route::resource('web-pages', 'WebPageController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::get('reward/check',[RewardController::class,'check'])->name('reward.check');
Route::post('reward/claim',[RewardController::class,'claim'])->name('reward.claim');
Route::get('/thank-you', function () {
    return view('thankyou');
})->name('thankyou');
Route::get('/reward/status/{coupon}', [RewardController::class, 'status'])
    ->name('reward.status');
