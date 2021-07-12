<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\PasswordController;
use App\Http\Controllers\HotelController;
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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('forgot',[PasswordController::class,'fogotpassword']);
Route::post('reset',[PasswordController::class,'resetPassword']);
Route::post('create-room' , [HotelController::class,'AddNewRoom']);
Route::get('getRoom' , [HotelController::class, 'getRoomData']);
Route::post('getRoomDatabyID' , [HotelController::class, 'getRoomDatabyID']);
Route::post('getroomsortbyrpice' , [HotelController::class , 'getroomsortbyrpice']);
Route::post('searchreport' , [\App\Http\Controllers\BookingController::class , 'searchreport']);
Route::post('getpreview', [HotelController::class , 'getpreview']);
Route::middleware('auth:sanctum')->group(function (){
    Route::get('user',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('deleteRoom' , [HotelController::class , 'deleteRoom']);
    Route::post('editRoom' , [HotelController::class , 'editRoom']);
    Route::post('getbooking' , [\App\Http\Controllers\BookingController::class , 'getbooking']);
    Route::post('getbookingData', [AuthController::class , 'getbookingData']);
    Route::post('completedRoom' , [\App\Http\Controllers\BookingController::class,'completedRoom']);
    Route::post('getcompletedRoomData' , [AuthController::class, 'getcompletedRoomData']);
    Route::post('create_items' , [\App\Http\Controllers\BookingitemsController::class,'create_items']);
    Route::post('delete_bookingitems',[\App\Http\Controllers\BookingitemsController::class,'delete_bookingitems']);
    Route::get('get_items' ,[\App\Http\Controllers\BookingitemsController::class,'get_items']);
    Route::post('delete_items', [\App\Http\Controllers\BookingitemsController::class,'delete_items']);
    Route::post('storeprice', [\App\Http\Controllers\BookingitemsController::class , 'storePrice']);
    Route::get('getprices' , [\App\Http\Controllers\BookingitemsController::class , 'getprices'] );
    Route::get('getamounts' ,[ \App\Http\Controllers\BookingitemsController::class,'getamounts']);
    Route::post('deletetotalprices',[\App\Http\Controllers\BookingitemsController::class,'deletetotalprices']);
    Route::get('getbookingData' , [\App\Http\Controllers\BookingController::class,'getbookingData']);
    Route::post('updateStatus' , [\App\Http\Controllers\BookingController::class, 'updateStatus']);
    Route::post('deleteRoomReport',[\App\Http\Controllers\BookingController::class , 'deleteRoomReport']);
    Route::post('storeBlacklist' , [\App\Http\Controllers\BookingController::class , 'storeBlacklist']);
    Route::get('getblacklist' , [\App\Http\Controllers\BookingController::class,'getblacklist']);
    Route::post('deleteblacklist' , [\App\Http\Controllers\BookingController::class, 'deleteblacklist']);
    Route::post('storepayment',[AuthController::class , 'storepayment']);
    Route::post('editamountofroom',[HotelController::class,'editamountofroom']);
    Route::post('createfloor' , [HotelController::class,'createfloor']);
    Route::get('getfloor', [HotelController::class ,'getfloor']);
    Route::post('deletefloor' , [HotelController::class , 'deletefloor']);
    Route::post('feecheckout' , [\App\Http\Controllers\BookingController::class,'feecheckout']);
    Route::post('storeamounts' , [\App\Http\Controllers\BookingController::class , 'storeamounts']);
    Route::post('updatebookingstatus' , [\App\Http\Controllers\BookingController::class , 'updatebookingstatus']);
    Route::post('bookedstatus' , [\App\Http\Controllers\BookingController::class , 'bookedstatus']);
    Route::post('getbookedstatus' , [\App\Http\Controllers\BookingController::class , 'getbookedstatus']);
    Route::post('deletebookedstatus' , [\App\Http\Controllers\BookingController::class, 'deletebookedstatus']);
    Route::post('deltebookedstatusall' , [\App\Http\Controllers\BookingController::class , 'deltebookedstatusall']);
    Route::post('deleteroombyid' , [\App\Http\Controllers\BookingController::class , 'deleteroombyid']);
    Route::post('chargecash' , [AuthController::class , 'chargecash']);
    Route::post('getcreditcard' , [AuthController::class , 'getcreditcard']);
    Route::post('getstatuscompletedroom' , [\App\Http\Controllers\BookingController::class , 'getstatuscompletedroom']);
    Route::post('getbookingDatabyuser' , [\App\Http\Controllers\BookingController::class , 'getbookingDatabyuser']);
});


