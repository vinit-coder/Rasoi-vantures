<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Permission;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use App\Models\Booking;
use Symfony\Component\HttpFoundation\Response;
 



 



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


  

Route::middleware(['api'])->post('register',[App\Http\Controllers\Api\V1\Admin\RegisterApiController::class,'register']);

 

Route::middleware(['api'])->post('login',[App\Http\Controllers\Api\V1\Admin\RegisterApiController::class,'login']);

Route::middleware(['api'])->post('image',[App\Http\Controllers\Api\V1\Admin\ImageUploadController::class,'uploadImage']);

     

Route::middleware('auth:api')->group( function () {

    Route::resource('customers', Api\V1\Admin\CustomersApiController::class);
    Route::resource('bookings', Api\V1\Admin\BookingsApiController::class);
   Route::resource('users', Api\V1\Admin\UsersApiController::class);
    Route::resource('roles', Api\V1\Admin\RolesApiController::class);
   
    Route::resource('permissions', Api\V1\Admin\PermissionsApiController::class);

 
});

/*Resources that can be accessed by Simple User or client*/

Route::resource('/categories', Api\V1\Admin\CategoriesApiController::class);

Route::resource('/meals', Api\V1\Admin\MealsApiController::class);

Route::resource('/countries', Api\V1\Admin\CountriesApiController::class);


Route::resource('/room_categories', Api\V1\Admin\RoomCategoriesApiController::class);

Route::resource('/rooms',Api\V1\Admin\RoomsApiController::class);

 