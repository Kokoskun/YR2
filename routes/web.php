<?php
//Auth Social
Route::get('login/auth/facebook','SocialAuthController@facebookRedirectToProvider');
Route::get('login/auth/facebook/callback','SocialAuthController@facebookHandleProviderCallback');
Route::get('login/auth/google','SocialAuthController@googleRedirectToProvider');
Route::get('login/auth/google/callback','SocialAuthController@googleHandleProviderCallback');
Auth::routes();

//Home
Route::get('/home','HomeController@index')->name('home');
Route::get('/','HomeController@index')->name('home');

//Defect
Route::get('/defect/{id}','DefectController@index');



//Manage Defect
Route::get('/manage-defect','ManageDefectController@index')->middleware('inspector');
Route::get('/manage-defect/group/{id}','ManageDefectController@view')->middleware('inspector');
Route::get('/manage-defect/group/{id}/defect/add','ManageDefectController@viewDefectAdd')->middleware('inspector');
Route::post('/manage-defect/group/{id}/create','ManageDefectController@create')->middleware('inspector');
Route::post('/manage-defect/group/{id}/report','ManageDefectController@getReportPDF')->middleware('inspector');
Route::delete('/manage-defect/group/{id}/delete','ManageDefectController@destroyDefect')->middleware('inspector');

//Floor
Route::get('/manage-defect/group/{id}/view/floor','FloorController@inspector')->middleware('inspector');
Route::get('/view-defect/group/{id}/view/floor','FloorController@contractor')->middleware('contractor');

//Contractor Defect
Route::get('/view-defect','ContractorDefectController@index')->middleware('contractor');
Route::get('/view-defect/group/{id}','ContractorDefectController@view')->middleware('contractor');
Route::post('/view-defect/group/{id}/report','ContractorDefectController@getReportPDF')->middleware('contractor');
Route::post('/view-defect/group/{id}/start','ContractorDefectController@getStartTime')->middleware('contractor');
Route::post('/view-defect/group/{idGroup}/defect/{idDefect}/update','ContractorDefectController@updateDefect')->middleware('contractor');






//Mange Group
Route::get('/manage-group','ManageGroupAdminController@index')->middleware('admin');
Route::post('/manage-group/create','ManageGroupAdminController@create')->middleware('admin');
Route::post('/manage-group/update','ManageGroupAdminController@updateGroup')->middleware('admin');
Route::delete('/manage-group/delete','ManageGroupAdminController@destroyGroup')->middleware('admin');

Route::get('/manage-group/{id}/manage-person','ManageGroupAdminController@viewManagePerson')->middleware('admin');
Route::post('/manage-group/{id}/manage-person/confirm','ManageGroupAdminController@confirmPerson')->middleware('admin');
Route::delete('/manage-group/{id}/manage-person/dismiss','ManageGroupAdminController@dismissPerson')->middleware('admin');


Route::get('/manage-group/{id}/manage-floor/','ManageGroupAdminController@viewMangeFloor')->middleware('admin');
Route::post('/manage-group/{id}/manage-floor/create','ManageGroupAdminController@createFloor')->middleware('admin');
Route::delete('/manage-group/{id}/manage-floor/dismiss','ManageGroupAdminController@dismissFloor')->middleware('admin');

Route::get('/manage-group/{id}/manage-status-defect/','ManageGroupAdminController@viewMangeStatusDefect')->middleware('admin');


//Manage User
Route::get('/manage-user','ManageUserController@index')->middleware('admin');
Route::put('/manage-user/update/permission','ManageUserController@updatePermission')->middleware('admin');
Route::delete('/manage-user/delete/user','ManageUserController@destroyUser')->middleware('admin');
Route::get('/manage-user/update/user','ManageUserController@updateUser')->middleware('admin');
Route::post('/manage-user/update/user/{id}','ManageUserController@updateUser')->middleware('admin');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/test',function(){
    return view('index');
});