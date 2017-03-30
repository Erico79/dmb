<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/home', 'DashboardController@index');
Route::get('/', 'DashboardController@index');

#### Masterfile Module
Route::get('masterfile', 'MasterfileController@index');
Route::post('add_mf', 'MasterfileController@addMf');
Route::get('all_mfs', 'MasterfileController@allMfs');
Route::get('edit_mf/{id}', 'MasterfileController@getMf');
Route::get('refresh/{id}', 'MasterfileController@refreshMf');
Route::get('soft-delete-mf/{id}', 'MasterfileController@softDeleteMf');
Route::get('mf-profile/{id}', 'MasterfileController@getMfProfile');
Route::post('edit_mf/{id}', 'MasterfileController@updateMf');
Route::post('mf_profile/{id}', 'MasterfileController@addAddress');
Route::get('mf-profile/address-data/{id}', 'MasterfileController@getAddressData');
Route::post('update-address/{id}', 'MasterfileController@updateAddress');
Route::delete('delete-address/{id}', 'MasterfileController@deleteAddress');
Route::get('/deleted_mfs', 'MasterfileController@loadDelMfs');
Route::get('restore-mf/{id}', 'MasterfileController@restoreMf');
Route::get('destroy/{id}', 'MasterfileController@destroy');
Route::get('/mf-profile/my-bids/{id}', 'MasterfileController@myBids');
Route::get('/mf-profile/my-purchase/{id}', 'MasterfileController@myPurchase');
Route::get('/mf-profile/my-wallet/{id}', 'MasterfileController@myWallet');

###CRM MODULE
Route::get('/all-staff', 'MasterfileController@allStaff');
Route::get('/stuffs-all','MasterfileController@loadStaff');
Route::get('/all-customers', 'MasterfileController@allCustomers');
Route::get('/load-customer','MasterfileController@loadCustomers');
Route::get('/all-suppliers', 'MasterfileController@allSuppliers');
Route::get('/load-suppliers','MasterfileController@loadSuppliers');
Route::get('/client/show/{id}', 'MasterfileController@showClient');
Route::get('/supplier/show/{id}', 'MasterfileController@showSupplier');

#### Documents Manager
Route::get('categories',array('uses'=>'InventoryController@getCategories','as'=>'category.index') );
Route::post('add-category','InventoryController@addCategory');
Route::get('category-details/{id}','InventoryController@getCategoryData');
Route::post('update-category/{id}',['uses'=>'InventoryController@updateCategory','as'=>'category.update']);
Route::delete('delete-category/{id}','InventoryController@destroyCategory');
Route::get('upload-doc-view', 'DocumentController@index');
Route::post('process-upload', 'DocumentController@store');
Route::get('all-uploaded-docs', 'DocumentController@getUploadedDocs');
Route::get('document/show/{id}', 'DocumentController@showDocProfile');
Route::post('delete-doc', 'DocumentController@destroy');

//routes for managing sub category details
Route::get('sub-categories',array('uses'=>'InventoryController@getSubCategories','as'=>'sub_category.index') );
Route::post('add-subcategory','InventoryController@addSubCategory');
Route::get('get-subcategory-ailments/{id}','InventoryController@getSubCatAilments');
Route::post('update-subcategory/{id}', 'InventoryController@updateSubcategory');
Route::delete('delete-subcategory/{id}','InventoryController@destroySubcategory');

#### Revenue Manager Module
Route::get('/revenue-channels', 'RevenueChannelController@revenueChannels');
Route::post('/add-rev', 'RevenueChannelController@store');
Route::get('/rev-data/{id}', 'RevenueChannelController@getRevData');
Route::post('/update-rev', 'RevenueChannelController@update');
Route::delete('/delete-rev', 'RevenueChannelController@destroy');
Route::get('/service-channels', 'ServiceChannelController@serviceChannels');
Route::post('/add-sc', 'ServiceChannelController@store');
Route::get('/service-data/{id}', 'ServiceChannelController@getServData');
Route::post('/update-sc', 'ServiceChannelController@update');
Route::delete('/delete-sc', 'ServiceChannelController@destroy');
Route::get('/service-bills', 'RevenueChannelController@serviceBills');

### User Management Module
Route::get('/all-users', 'Manage_userController@index');
Route::get('/load-users','Manage_userController@loadAllusers');
Route::post('/reset-pass', 'Manage_userController@updateUser');
Route::post('/delete-user', 'Manage_userController@destroy');
Route::get('/user-data/{id}', 'Manage_userController@getUserData');
Route::post('/block-user', 'Manage_userController@blockUser');
Route::post('/unblock-user', 'Manage_userController@unblockUser');
Route::get('/user_profile/{id}', 'Manage_userController@getUsProfile');
Route::get('/user_profile/user-audit/{id}', 'Manage_userController@getUsAudit');
Route::get('/profile-settings', 'Manage_userController@getProfile');
Route::get('/profile-settings/profile-audit/{id}', 'Manage_userController@getAudit');
//Route::post('/change-password/{id}', 'Manage_userController@changePassword');

//Route::post('add_user_role','UserRoleController@addUserRole');
//Route::post('audit_trail','UserRoleController@auditTrail');
Route::get('/user-roles', 'UserRoleController@index');
Route::get('/all-roles', 'UserRoleController@loadRoles');
Route::post('/add-role', 'UserRoleController@store');
Route::get('/get-role/{id}', 'UserRoleController@getRole');
Route::post('/edit-role', 'UserRoleController@update');
Route::post('/delete-role', 'UserRoleController@destroy');
Route::post('/attach-to-role', 'UserRoleController@attachToRole');
Route::post('/detach-from-role', 'UserRoleController@detachFromRole');
Route::get('/get-role-routes/{role_id}', 'UserRoleController@getRoleRoutes');
Route::get('/audit_trails','Audit_trailController@index');
Route::get('/load-audit','Audit_trailController@loadAudit');
Route::get('/load-actions/{id}/{role_id}','UserRoleController@loadRouteActions');
Route::post('/attach-action','UserRoleController@attachAction');
Route::post('/detach-action','UserRoleController@detachAction');

#### System Manager  Module
Route::get('/routes', 'RoutesController@index');
Route::get('/load-routes', 'RoutesController@loadRoutes');
Route::post('/add-route', 'RoutesController@store');
Route::get('/get-routes', 'RoutesController@getRoutes');
Route::get('/get-route/{id}', 'RoutesController@getRoute');
Route::post('/update-route', 'RoutesController@update');
Route::post('/delete-route', 'RoutesController@destroy');
Route::get('/menu', 'MenuController@index');
Route::post('/add-menu', 'MenuController@store');
Route::post('/arrange-menu', 'MenuController@arrangeMenu');
Route::get('/get-menu/{id}', 'MenuController@getMenu');
Route::post('/edit-menu', 'MenuController@update');
Route::post('/delete-menu', 'MenuController@destroy');
Route::get('/sys-actions', 'SysActionsController@index');
Route::get('/load-action', 'SysActionsController@loadActions');
Route::post('/add-action', 'SysActionsController@store');
Route::post('/update-action', 'SysActionsController@update');
Route::post('/delete-action', 'SysActionsController@destroy');
Route::get('/get-child-routes', 'SysActionsController@getChildRoutes');
Route::get('/get-action/{id}', 'SysActionsController@getAction');

#### Access Denied
Route::get('/access-denied', function(){
    return view('pages.access_denied');
});