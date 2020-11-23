<?php
Route::get('/test_index', 'ViewFormController@index');
Route::get('/test_result', 'ViewFormController@result');

Route::get('/form_post', 'ViewFormController@Add');


Route::get('qr-code', function () {
    return QrCode::encoding('UTF-8')->size(100)->generate('https://google.com');
});

Route::get('/{vue_capture?}', function () {
    App::setLocale('ru');
    return view('index');
})->where('vue_capture', '[\/\w\.-]*');
//->middleware(['can:admin-panel'])

Route::post('/isauthenticated', 'Auth\IsAuthenticatedController@isAuthenticated');

Route::group(
    [
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {
//    Route::get('/', 'DashboardController@index')->name('dashboard');


        Route::post('/orders/get', 'Orders\OrderController@getData')->name('ajax');
        Route::post('/orders/add', 'Orders\OrderController@Add');
        Route::post('/orders/edit', 'Orders\OrderController@Edit');
        Route::post('/orders/addcompany', 'Orders\OrderController@AddCompany');

        Route::post('/companies/get', 'Companies\CompanyController@getData');
        Route::post('/companies/add', 'Companies\CompanyController@Add');
        Route::post('/companies/edit', 'Companies\CompanyController@Edit');
        Route::post('/companies/searchbyid', 'Companies\CompanyController@SearchByMemberId');
        Route::post('/companies/getactivitieslist', 'Companies\ActivitiesController@getList');
        Route::post('/companies/gettypeslist', 'Companies\TypesController@getList');

        Route::post('/members/get', 'Members\MemberController@getData');
        Route::post('/members/add', 'Members\MemberController@Add');
        Route::post('/members/edit', 'Members\MemberController@Edit');
        Route::post('/members/search', 'Members\MemberController@Search');
        Route::post('/members/connecttocompany', 'Members\MemberController@setRelationshipToCompany');

        Route::any('/city/get', 'Citys\CityController@getData');
        Route::post('/city/add', 'Citys\CityController@Add');
        Route::post('/city/edit', 'Citys\CityController@Edit');

        Route::post('/appeals/get', 'Appeals\AppealController@getData');
//    Route::post('/city/add/', 'Citys\CityController@Add');
//    Route::post('/city/edit/', 'Citys\CityController@Edit');

        Route::post('/departments/get', 'Departments\DepartmentController@getData');
        Route::post('/departments/add', 'Departments\DepartmentController@Add');
        Route::post('/departments/edit', 'Departments\DepartmentController@Edit');

        Route::post('/sectors/get', 'Sectors\SectorController@getData');
        Route::post('/sectors/add', 'Sectors\SectorController@Add');
        Route::post('/sectors/edit', 'Sectors\SectorController@Edit');
        Route::post('/sectors/get_qr', 'Sectors\SectorController@AddQR');

        Route::post('/config/get', 'ConfigController@getAllConfig');
    }
);

Auth::routes(['register' => false]);

