<?php
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Config;
use SocialiteProviders\Manager\ConfigTrait;






/*Backend Routes*/
Route::redirect('/admin', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::post('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    Route::post('permissions_restore/{id}', ['uses' => 'PermissionsController@restore', 'as' => 'permissions.restore']);
    Route::delete('permissions_perma_del/{id}', ['uses' => 'PermissionsController@perma_del', 'as' => 'permissions.perma_del']);

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    Route::post('roles_restore/{id}', ['uses' => 'RolesController@restore', 'as' => 'roles.restore']);
    Route::delete('roles_perma_del/{id}', ['uses' => 'RolesController@perma_del', 'as' => 'roles.perma_del']);


    // Users
    Route::post('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('users_restore/{id}', ['uses' => 'UsersController@restore', 'as' => 'users.restore']);
    Route::delete('users_perma_del/{id}', ['uses' => 'UsersController@perma_del', 'as' => 'users.perma_del']);

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/reorder', 'CategoriesController@reorder')->name('categories.reorder');
    Route::resource('categories', 'CategoriesController');

    // Meals
    Route::delete('meals/destroy', 'MealsController@massDestroy')->name('meals.massDestroy');
    Route::post('meals/media', 'MealsController@storeMedia')->name('meals.storeMedia');
    Route::post('meals/ckmedia', 'MealsController@storeCKEditorImages')->name('meals.storeCKEditorImages');
    Route::post('meals/reorder', 'MealsController@reorder')->name('meals.reorder');
    Route::resource('meals', 'MealsController');

    Route::post('meals_restore/{id}', ['uses' => 'MealsController@restore', 'as' => 'meals.restore']);
    Route::delete('meals_perma_del/{id}', ['uses' => 'MealsController@perma_del', 'as' => 'meals.perma_del']);
});



Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }});




    /*Room Management Routing Starts from here*/

    Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    
    Route::resource('roomcategories', 'Admin\RoomCategoryController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\RoomCategoryController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\RoomCategoryController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\RoomCategoryController@perma_del', 'as' => 'categories.perma_del']);
    


    Route::resource('countries', 'Admin\CountriesController');

    Route::post('countries_mass_destroy', ['uses' => 'Admin\CountriesController@massDestroy', 'as' => 'countries.mass_destroy']);
    Route::post('countries_restore/{id}', ['uses' => 'Admin\CountriesController@restore', 'as' => 'countries.restore']);
    Route::delete('countries_perma_del/{id}', ['uses' => 'Admin\CountriesController@perma_del', 'as' => 'countries.perma_del']);



    Route::resource('customers', 'Admin\CustomersController');
    Route::post('customers_mass_destroy', ['uses' => 'Admin\CustomersController@massDestroy', 'as' => 'customers.mass_destroy']);
    Route::post('customers_restore/{id}', ['uses' => 'Admin\CustomersController@restore', 'as' => 'customers.restore']);
    Route::delete('customers_perma_del/{id}', ['uses' => 'Admin\CustomersController@perma_del', 'as' => 'customers.perma_del']);
    Route::resource('rooms', 'Admin\RoomsController');
    Route::post('rooms_mass_destroy', ['uses' => 'Admin\RoomsController@massDestroy', 'as' => 'rooms.mass_destroy']);
    Route::post('rooms_restore/{id}', ['uses' => 'Admin\RoomsController@restore', 'as' => 'rooms.restore']);
    Route::delete('rooms_perma_del/{id}', ['uses' => 'Admin\RoomsController@perma_del', 'as' => 'rooms.perma_del']);
    Route::resource('bookings', 'Admin\BookingsController', ['except' => 'bookings.create']);
     Route::get('bookings/create/', ['as' => 'bookings.create', 'uses' => 'Admin\BookingsController@create']);
    Route::post('bookings_mass_destroy', ['uses' => 'Admin\BookingsController@massDestroy', 'as' => 'bookings.mass_destroy']);
    Route::post('bookings_restore/{id}', ['uses' => 'Admin\BookingsController@restore', 'as' => 'bookings.restore']);
    Route::delete('bookings_perma_del/{id}', ['uses' => 'Admin\BookingsController@perma_del', 'as' => 'bookings.perma_del']);
    //Route::resource('/find_rooms', 'Admin\FindRoomsController', ['except' => 'create']);
    Route::get('/find_rooms', 'Admin\FindRoomsController@index')->name('find_rooms.index');
    Route::post('/find_rooms', 'Admin\FindRoomsController@index');
    

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 
Route::get('/auth/google', function () {


    $clientId = "331329763166-k4088v8sdidlgbrj2akil89fthvme8rh.apps.googleusercontent.com";
        $clientSecret = "73auFb7OWC5FFALxd1PYPrl8";
        $redirectUrl = "http://localhost:8000/auth/google/callback";

 $config = new Config($clientId,$clientSecret,$redirectUrl);
  
    
     

        
    return Socialite::driver('google')->
    with(['client_id'=>"331329763166-k4088v8sdidlgbrj2akil89fthvme8rh.apps.googleusercontent.com"])
    ->setConfig($config)
 
     
    ->redirect();
});

 


Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();

   var_dump($user) ;

});




//Frontend site.............................
Route::get('/','HomeController@index');

//show category wise product here
Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');
//cart routes are here----------------
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');

//checkout routes are here======
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');
//customer login and logout are here------------------------------------
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');

Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');

Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');
Route::get('/unactive_order/{order_id}','CheckoutController@unactive_order');
Route::get('/active_order/{order_id}','CheckoutController@active_order');

//Contact routes are here...............
Route::get('/contact','ContactController@contact');
Route::post('/save-contact','ContactController@save_contact');
Route::get('/all-message','ContactController@all_message');
Route::get('/unactive_contact/{contact_id}','ContactController@unactive_contact');
Route::get('/active_contact/{contact_id}','ContactController@active_contact');
Route::get('/view-message/{contact_id}','ContactController@view_message');
Route::get('/delete-contact/{contact_id}','ContactController@delete_messaage');
Route::post('/ok-message/{contact_id}','ContactController@ok_message');






/*cart routes are here----------------*/
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');

