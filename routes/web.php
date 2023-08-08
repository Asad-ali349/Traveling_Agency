<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin',[AdminController::class,'index']);
Route::post('/admin',[AdminController::class,'login']);

Route::controller(AdminController::class)->group(function (){
    Route::post('admin/logout','logout');
    Route::get('/admin/profile','profile');
    Route::get('/admin/edit_profile/{id}','edit_profile');
    Route::post('/admin/edit_profile/','submit_edit_profile');
    Route::get('/admin/change_password','change_password');
    Route::post('/admin/change_password','submit_change_password');

    Route::get('/admin/dashboard','dashboard');
    Route::get('/admin/add_customer','add_customer');
    Route::post('/admin/add_customer','submit_add_customer');
    
    Route::get('/admin/view_customer','view_customer');
    Route::get('/admin/edit_customer/{id}','edit_customer');
    Route::post('/admin/edit_customer/','submit_edit_customer');
    Route::get('/admin/customer_detail/{id}','customer_detail');
    Route::get('/admin/delete_customer/{id}','delete_customer');
    Route::get('/admin/visa','visa');
    Route::get('/admin/ticket','ticket');
    Route::get('/admin/airline','airline');
    Route::post('/admin/airline','submit_add_air_company');
    Route::post('/admin/edit_airline','submit_edit_air_company');
    Route::get('/admin/delete_airline/{id}','delete_air_company');
    Route::get('/admin/add_hotel','add_hotel');
    Route::get('/admin/view_hotels','view_hotel');
    Route::get('/admin/edit_hotel','edit_hotel');
    Route::get('/admin/hotel_detail','hotel_detail');
    Route::get('/admin/collaborator','collaborator');
    Route::post('/admin/collaborator','submit_add_collaborator');
    Route::post('/admin/edit_collaborator','submit_edit_collaborator');
    Route::get('/admin/delete_collaborator/{id}','delete_collaborator');
    Route::get('/admin/transport','transport');
    Route::post('/admin/transport','submit_add_carrier');
    Route::post('/admin/edit_carrier','submit_edit_carrier');
    Route::get('/admin/delete_carrier/{id}','delete_carrier');
    Route::get('/admin/get_reservation_customers/{going_date}/{coming}','get_reservation_customers');
    Route::get('/admin/add_group','add_group');
    Route::post('/admin/add_group','submit_add_group');
    Route::get('/admin/view_group','view_group');
    Route::get('/admin/edit_group/{id}','edit_group');
    Route::post('/admin/edit_group/','submit_edit_group');
    Route::get('/admin/group_detail/{id}','group_detail');
    Route::get('/admin/delete_group/{id}','delete_group');
    Route::get('/admin/add_package','add_package');
    Route::get('/admin/view_package','view_package');
    Route::get('/admin/add_reservation','add_reservation');
    Route::post('/admin/add_reservation','submit_add_reservation');
    Route::get('/admin/add_reservation/{customer_id}','add_reservation_with_customer')->name('add_reservation_with_id');
    Route::get('/admin/view_reservations','view_reservations');
    Route::get('/admin/view_group_reservation','view_group_reservation');
    Route::get('/admin/edit_reservation/{id}','edit_reservation');
    Route::post('/admin/edit_reservation/','submit_edit_reservation');
    Route::get('/admin/delete_reservation/{id}','delete_reservation');
    Route::get('/admin/individual_reservation_detail','individual_reservation_detail');
    Route::get('/admin/group_reservation_detail','group_reservation_detail');
    Route::get('/admin/accounting','accounting');
    Route::get('/admin/compta_accounting','compta_accounting');
    Route::get('/admin/services','services');
    Route::get('/admin/package_services','package_services');
    Route::post('/admin/package_services','submit_add_package_services');
    Route::get('/admin/edit_package_services/{id}','edit_package_services');
    Route::post('/admin/edit_package_services','submit_edit_package_services');
    Route::get('/admin/delete_package_services/{id}','delete_package_services');
    Route::get('/admin/visa_services','visa_services');
    Route::post('/admin/visa_services','submit_add_visa_services');
    Route::get('/admin/edit_visa_services/{id}','edit_visa_services');
    Route::post('/admin/edit_visa_services/','submit_edit_visa_services');
    Route::get('/admin/delete_visa_services/{id}','delete_visa_services');
    Route::get('/admin/lodging_services','lodging_services');
    Route::post('/admin/lodging_services','submit_add_lodging_services');
    Route::get('/admin/edit_lodging_services/{id}','edit_lodging_services');
    Route::post('/admin/edit_lodging_services/','submit_edit_lodging_services');
    Route::get('/admin/delete_lodging_services/{id}','delete_lodging_services');
    Route::get('/admin/tickets_services','tickets_services');
    Route::post('/admin/tickets_services','submit_add_tickets_services');
    Route::get('/admin/edit_tickets_services/{id}','edit_tickets_services');
    Route::post('/admin/edit_tickets_services/','submit_edit_tickets_services');
    Route::get('/admin/delete_ticket_services/{id}','delete_ticket_services');
    Route::get('/admin/transport_services','transport_services');
    Route::post('/admin/transport_service','submit_add_transport_services');
    Route::get('/admin/edit_transport_service/{id}','edit_transport_service');
    Route::post('/admin/edit_transport_service','submit_edit_transport_service');
    Route::get('/admin/delete_transport_services/{id}','delete_transport_services');
    Route::get('/admin/extra_services','extra_services');
    Route::post('/admin/extra_services','submit_add_extra_services');
    Route::get('/admin/edit_extra_services/{id}','edit_extra_services');
    Route::post('/admin/edit_extra_services/','submit_edit_extra_services');
    Route::get('/admin/delete_extra_services/{id}','delete_extra_services');
    Route::get('/admin/add_ticket','add_ticket');
    Route::post('/admin/add_ticket','submit_add_ticket');
    Route::get('/admin/view_ticking_history','view_ticking_history');
    Route::get('/admin/edit_ticketing/{id}/{is_group}','edit_ticketing');
    Route::post('/admin/edit_ticketing/','submit_edit_ticketing');
    Route::get('/admin/view_lodging','view_lodging');
    Route::get('/admin/view_visa','view_visa');
    Route::get('/admin/view_transport','view_transport');
    Route::get('/admin/view_tickets','view_tickets');
    Route::get('/admin/view_extra_services','view_extra_services');
    Route::get('/admin/partners','partners');
    Route::get('/admin/invoice','invoice');
});
