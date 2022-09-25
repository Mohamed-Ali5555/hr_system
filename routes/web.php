<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
// Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('section/{id}',[\App\Http\Controllers\official_holidaysController::class,'getproducts']);  //the error in route this dont put it in middleware
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
   
});

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');
Route::resource('employees',\App\Http\Controllers\EmployeerController::class);
Route::resource('section',\App\Http\Controllers\SectionController::class);
Route::resource('Attendance',\App\Http\Controllers\AttendanceController::class);
Route::resource('addition_and_discount',\App\Http\Controllers\AdditionAndDiscountController::class);
Route::resource('official_holidays',\App\Http\Controllers\official_holidaysController::class);
Route::resource('salary_reports',\App\Http\Controllers\Salary_reportController::class);


// // archeve page and routes 
Route::get('/archevis_reports',[\App\Http\Controllers\ArcheveController::class,'index'])->name('archevis_reports');
// return from archeve to invoices table 
Route::post('/archevis_reports/update',[\App\Http\Controllers\ArcheveController::class,'update'])->name('archeve.update');
// delete 
Route::delete('/archevis_reports/destroy',[\App\Http\Controllers\ArcheveController::class,'destroy'])->name('archeve.destroy');




// Route::get('/invoices/{id}','Salary_reportController@invoices')->name('salary_reports.invoices');
// Route::get('/salary_reports/invoices/{id}',[\App\Http\Controllers\Salary_reportController::class,'invoices'])->name('salary_reports.invoices');

Route::get('search',[\App\Http\Controllers\AttendanceController::class,'search'])->name('search');
Route::post('/Search_attendances',[\App\Http\Controllers\AttendanceController::class,'Search_attendances'])->name('Search_attendances');
Route::post('/Search_salary',[\App\Http\Controllers\Salary_reportController::class,'Search_salary'])->name('Search_salary');

//////////////////laravel exel in empoloyers
Route::get('employees.excel', [\App\Http\Controllers\EmployeerController::class, 'export'])->name('employees.excel');
//////////////////

// priny invoices 
Route::get('/print_invoices/{id}',[\App\Http\Controllers\Salary_reportController::class, 'print_invoices'])->name('salary_reports.print_invoices');


  //// larvel notifications

  Route::get('MarkAsRead_all',[\App\Http\Controllers\EmployeerController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('/mark-as-read',[\App\Http\Controllers\EmployeerController::class, 'markNotification'])->name('markNotification');
  //////end laravel noification

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();