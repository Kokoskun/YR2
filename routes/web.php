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
//Mange Group
Route::get('/manage-group','ManageGroupAdminController@index')->middleware('admin');
Route::post('/manage-group/create','ManageGroupAdminController@create')->middleware('admin');
Route::post('/manage-group/update','ManageGroupAdminController@updateGroup')->middleware('admin');
Route::delete('/manage-group/delete','ManageGroupAdminController@destroyGroup')->middleware('admin');
Route::get('/manage-group/{id}/manage-person','ManageGroupAdminController@viewManagePerson')->middleware('admin');
Route::post('/manage-group/{id}/manage-person/confirm','ManageGroupAdminController@confirmPerson')->middleware('admin');
Route::delete('/manage-group/{id}/manage-person/dismiss','ManageGroupAdminController@dismissPerson')->middleware('admin');
//Manage User
Route::get('/manage-user','ManageUserController@index')->middleware('admin');
Route::put('/manage-user/update/permission','ManageUserController@updatePermission')->middleware('admin');
Route::delete('/manage-user/delete/user','ManageUserController@destroyUser')->middleware('admin');
Route::get('/manage-user/update/user','ManageUserController@updateUser')->middleware('admin');
Route::post('/manage-user/update/user/{id}','ManageUserController@updateUser')->middleware('admin');
Route::get('/welcome', function () {
	return view('welcome');
});
Route::get('/import',function(){
	$layoutLocat = 'manage-group';
	return view('import', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form',function(){
	$layoutLocat = 'form';
	return view('form', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form-project',function(){
	$layoutLocat = 'form';
	return view('form.form-project', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_camp',function(){
	$layoutLocat = 'form';
	return view('form.form_camp', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_children',function(){
	$layoutLocat = 'form';
	return view('form.form_children', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_contract',function(){
	$layoutLocat = 'form';
	return view('form.form_contract', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_follower',function(){
	$layoutLocat = 'form';
	return view('form.form_follower', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_labor',function(){
	$layoutLocat = 'form';
	return view('form.form_labor', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/form_vaccine-log',function(){
	$layoutLocat = 'form';
	return view('form.form_vaccine-log', ['layoutLocat'=>$layoutLocat]);
});
Route::get('/form/vaccine-history',function(){
	$layoutLocat = 'form';
	return view('form.vaccine-history', ['layoutLocat'=>$layoutLocat]);
});