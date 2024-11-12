<?php

use App\Http\Controllers\Admin\AdminPanelSettingController;
use App\Http\Controllers\Admin\CarExpensesController;
use App\Http\Controllers\Admin\CarModalsController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DebenturesController;
use App\Http\Controllers\Admin\PermissionMainMenueController;
use App\Http\Controllers\Admin\PermissionRoleController;
use App\Http\Controllers\Admin\PermissionSubMenueController;
use App\Http\Controllers\Admin\BlackListController;
use App\Http\Controllers\Admin\CommuniqueController;
use App\Http\Controllers\Admin\ExpensesTypeController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\ProfileController;
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

define('PAGINATION_COUNT', 10);
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {  
    
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/car_dashboard/{status}', [DashboardController::class, 'car_dashboard'])->name('admin.dashboard.car_dashboard');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/adminpanelsetting/index', [AdminPanelSettingController::class, 'index'])->name('admin.adminPanelSetting.index');
Route::get('/adminpanelsetting/edit', [AdminPanelSettingController::class, 'edit'])->name('admin.adminPanelSetting.edit');
Route::post('/adminpanelsetting/update', [AdminPanelSettingController::class, 'update'])->name('admin.adminPanelSetting.update');

Route::get('/adminpanelsetting_API/index_API', [AdminPanelSettingController::class, 'index_API'])->name('admin.adminPanelSetting_API.index_API');
Route::get('/adminpanelsetting_API/edit_API', [AdminPanelSettingController::class, 'edit_API'])->name('admin.adminPanelSetting_API.edit_API');
Route::post('/adminpanelsetting_API/update_API', [AdminPanelSettingController::class, 'update_API'])->name('admin.adminPanelSetting_API.update_API');



/*  ═══════ ೋღ  ღೋ ═══════       start  CarStatus  ═══════ ೋღ  ღೋ ═══════ */
Route::get('/CarModals/delete/{id}', [CarModalsController::class, 'delete'])->name('admin.CarModals.delete');
Route::resource('/CarModals', CarModalsController::class);

/*    ═══════ ೋღ  End CarStatus ღೋ ═══════       */ 


/*  ═══════ ೋღ  ღೋ ═══════       start  CarType  ═══════ ೋღ  ღೋ ═══════ */
Route::get('/carType/delete/{id}', [CarTypeController::class, 'delete'])->name('admin.carType.delete');
Route::resource('/carType', CarTypeController::class);

/*    ═══════ ೋღ  End CarType ღೋ ═══════       */ 

/*  ═══════ ೋღ  ღೋ ═══════       start  expensesType  ═══════ ೋღ  ღೋ ═══════ */
Route::get('/expensesType/delete/{id}', [ExpensesTypeController::class, 'delete'])->name('admin.expensesType.delete');
Route::resource('/expensesType', ExpensesTypeController::class);

/*    ═══════ ೋღ  End expensesType ღೋ ═══════       */ 

/*  ═══════ ೋღ  ღೋ ═══════       start  CarStatus  ═══════ ೋღ  ღೋ ═══════ */
Route::get('/expenses/delete/{id}', [ExpensesController::class, 'delete'])->name('admin.expenses.delete');
Route::resource('/expenses', ExpensesController::class);
Route::post('/expenses/ajax_search', [ExpensesController::class, 'ajax_search'])->name('admin.expenses.ajax_search');
/*    ═══════ ೋღ  End CarStatus ღೋ ═══════       */ 


/*  ═══════ ೋღ  ღೋ ═══════       start  CarStatus  ═══════ ೋღ  ღೋ ═══════ */
Route::get('/CarExpenses/delete/{id}', [CarExpensesController::class, 'delete'])->name('admin.CarExpenses.delete');
Route::resource('/CarExpenses', CarExpensesController::class);
Route::post('/CarExpenses/ajax_get_car', [CarExpensesController::class, 'ajax_get_car'])->name('admin.CarExpenses.ajax_get_car');
Route::post('/CarExpenses/ajax_search', [CarExpensesController::class, 'ajax_search'])->name('admin.CarExpenses.ajax_search');
/*    ═══════ ೋღ  End CarStatus ღೋ ═══════       */ 

/*  ═══════ ೋღ  ღೋ ═══════       start  ContractController  ═══════ ೋღ  ღೋ ═══════ */
Route::resource('/contracts', ContractController::class);
Route::get('/contracts/delete/{id}', [ContractController::class, 'delete'])->name('admin.contracts.delete');
Route::get('/contracts/create/{id}', [ContractController::class, 'create'])->name('admin.contracts.create');
Route::get('/contracts/invoice/{id}', [ContractController::class, 'invoice'])->name('admin.contracts.invoice');
Route::post('/contracts/ajax_get_car', [ContractController::class, 'ajax_get_customer'])->name('admin.contracts.ajax_get_car');
Route::post('/contracts/ajax_search', [ContractController::class, 'ajax_search'])->name('admin.contracts.ajax_search');
Route::get('/contracts_dashboard/{status}', [DashboardController::class, 'contracts_dashboard'])->name('admin.dashboard.contracts_dashboard');
/*    ═══════ ೋღ  End ContractController ღೋ ═══════       */ 


/*  ═══════ ೋღ  ღೋ ═══════       start  BlackListController  ═══════ ೋღ  ღೋ ═══════ */
Route::resource('/Black_lists', BlackListController::class);
Route::get('/Black_lists/delete/{id}', [BlackListController::class, 'delete'])->name('admin.Black_lists.delete');
Route::get('/Black_lists/create/{id}', [BlackListController::class, 'create'])->name('admin.Black_lists.create');
Route::post('/Black_lists/ajax_search', [BlackListController::class, 'ajax_search'])->name('admin.Black_lists.ajax_search');
/*    ═══════ ೋღ  End BlackListController ღೋ ═══════       */ 

/*  ═══════ ೋღ  ღೋ ═══════       start  BlackListController  ═══════ ೋღ  ღೋ ═══════ */
Route::resource('/communique', CommuniqueController::class);
Route::get('/communique/delete/{id}', [CommuniqueController::class, 'delete'])->name('admin.communique.delete');
Route::post('/communique/ajax_search', [CommuniqueController::class, 'ajax_search'])->name('admin.communique.ajax_search');
/*    ═══════ ೋღ  End BlackListController ღೋ ═══════       */ 


/*  ═══════ ೋღ  ღೋ ═══════       start  ContractController  ═══════ ೋღ  ღೋ ═══════ */
Route::resource('/debentures', DebenturesController::class);
Route::get('/debentures/delete/{id}', [DebenturesController::class, 'delete'])->name('admin.debentures.delete');
Route::get('/debentures/create/{id}', [DebenturesController::class, 'create'])->name('admin.debentures.create');
Route::get('/debentures/invoice/{id}', [DebenturesController::class, 'invoice'])->name('admin.debentures.invoice');
Route::post('/debentures/ajax_get_car', [DebenturesController::class, 'ajax_get_customer'])->name('admin.debentures.ajax_get_car');
Route::post('/debentures/ajax_search', [DebenturesController::class, 'ajax_search'])->name('admin.debentures.ajax_search');
/*    ═══════ ೋღ  End ContractController ღೋ ═══════       */ 


/*      ═══════ ೋღ   start  customer   ღೋ ═══════             */
Route::get('/car/index', [CarController::class, 'index'])->name('admin.car.index');
Route::get('/car/license_end_date', [CarController::class, 'license_end_date'])->name('admin.car.license_end_date');
Route::get('/car/mantince_notf', [CarController::class, 'mantince_notf'])->name('admin.car.mantince_notf');
Route::get('/car/create', [CarController::class, 'create'])->name('admin.car.create');
Route::post('/car/store', [CarController::class, 'store'])->name('admin.car.store');
Route::get('/car/edit/{id}', [CarController::class, 'edit'])->name('admin.car.edit');
Route::post('/car/update/{id}', [CarController::class, 'update'])->name('admin.car.update');
Route::get('/car/delete/{id}', [CarController::class, 'destroy'])->name('admin.car.delete');
Route::post('/car/ajax_search', [CarController::class, 'ajax_search'])->name('admin.car.ajax_search');
Route::get('/car/show/{id}', [CarController::class, 'show'])->name('admin.car.show');
/*      ═══════ ೋღ  end customer  ღೋ ═══════              */




/*      ═══════ ೋღ   start  customer   ღೋ ═══════             */
Route::get('/customer/index', [CustomerController::class, 'index'])->name('admin.customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
Route::post('/customer/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.delete');
Route::post('/customer/ajax_search', [CustomerController::class, 'ajax_search'])->name('admin.customer.ajax_search');
Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');
Route::post('/customer/ajax_search_genral', [CustomerController::class, 'ajax_search_genral'])->name('admin.customer.ajax_search_genral');

/*      ═══════ ೋღ  end customer  ღೋ ═══════              */



/*     ═══════ ೋღ end Suppliers_orders_return_original_invoice ღೋ ═══════                     */


/*    ═══════ ೋღ start admins ღೋ ═══════                    */
Route::get('/admins_accounts/index', [AdminController::class, 'index'])->name('admin.admins_accounts.index');
Route::get('/admins_accounts/create', [AdminController::class, 'create'])->name('admin.admins_accounts.create');
Route::post('/admins_accounts/store', [AdminController::class, 'store'])->name('admin.admins_accounts.store');
Route::get('/admins_accounts/edit/{id}', [AdminController::class, 'edit'])->name('admin.admins_accounts.edit');
Route::post('/admins_accounts/update/{id}', [AdminController::class, 'update'])->name('admin.admins_accounts.update');
Route::post('/admins_accounts/ajax_search', [AdminController::class, 'ajax_search'])->name('admin.admins_accounts.ajax_search');
Route::get('/admins_accounts/details/{id}', [AdminController::class, 'details'])->name('admin.admins_accounts.details');
Route::post('/admins_accounts/add_treasuries/{id}', [AdminController::class, 'add_treasuries'])->name('admin.admins_accounts.add_treasuries');
Route::get('/admins_accounts/delete_treasuries/{rowid}/{userid}', [AdminController::class, 'delete_treasuries'])->name('admin.admins_accounts.delete_treasuries');
Route::post('/admins_accounts/add_stores/{id}', [AdminController::class, 'add_stores'])->name('admin.admins_accounts.add_stores');
Route::get('/admins_accounts/delete_stores/{rowid}/{userid}', [AdminController::class, 'delete_stores'])->name('admin.admins_accounts.delete_stores');
Route::get('/admins_accounts/delete/{id}', [AdminController::class, 'delete'])->name('admin.admins_accounts.delete');

Route::get('/admins_accounts/show/{id}', [AdminController::class, 'show'])->name('admin.admins_accounts.show');

Route::get('/admins_accounts/profile/{id}', [ProfileController::class, 'profile'])->name('admin.admins_accounts.profile');



/*  ═══════ ೋღ start  Report  ღೋ ═══════ */
Route::get('/Report/bookingReport', [ReportController::class, 'indexBookingReport'])->name('admin.Report.bookingReport');
Route::post('/Report/bookingReport', [ReportController::class, 'bookingReport'])->name('admin.Report.bookingReport');
Route::get('/Report/userReport', [ReportController::class, 'indexUserReport'])->name('admin.Report.userReport');
Route::post('/Report/userReport', [ReportController::class, 'userReport'])->name('admin.Report.userReport');

Route::get('/Report/carExpensesReport', [ReportController::class, 'indexCarExpensesReport'])->name('admin.Report.carExpensesReport');
Route::post('/Report/carExpensesReport', [ReportController::class, 'carExpensesReport'])->name('admin.Report.carExpensesReport');

Route::get('/Report/expensesReport', [ReportController::class, 'indexExpensesReport'])->name('admin.Report.expensesReport');
Route::post('/Report/expensesReport', [ReportController::class, 'expensesReport'])->name('admin.Report.expensesReport');


Route::get('/Report/profitsReport', [ReportController::class, 'indexProfitsReport'])->name('admin.Report.profitsReport');
Route::post('/Report/profitsReport', [ReportController::class, 'profitsReport'])->name('admin.Report.profitsReport');


Route::get('/Report/taxReport', [ReportController::class, 'indexTaxReport'])->name('admin.Report.indexTaxReport');
Route::post('/Report/taxExpensesReport', [ReportController::class, 'taxReport'])->name('admin.Report.taxReport');
/*  ═══════ ೋღ end  Report ღೋ ═══════  */

/*     ═══════ ೋღ start  permission  ღೋ ═══════              */
Route::get('/permission_roles/index', [PermissionRoleController::class, 'index'])->name('admin.permission_roles.index');
Route::get('/permission_roles/create', [PermissionRoleController::class, 'create'])->name('admin.permission_roles.create');
Route::get('/permission_roles/edit/{id}', [PermissionRoleController::class, 'edit'])->name('admin.permission_roles.edit');
Route::post('/permission_roles/store', [PermissionRoleController::class, 'store'])->name('admin.permission_roles.store');
Route::post('/permission_roles/update/{id}', [PermissionRoleController::class, 'update'])->name('admin.permission_roles.update');
Route::get('/permission_roles/details/{id}', [PermissionRoleController::class, 'details'])->name('admin.permission_roles.details');
Route::post('/permission_roles/Add_permission_main_menues/{id}', [PermissionRoleController::class, 'Add_permission_main_menues'])->name('admin.permission_roles.Add_permission_main_menues');
Route::get('/permission_roles/delete_permission_main_menues/{id}', [PermissionRoleController::class, 'delete_permission_main_menues'])->name('admin.permission_roles.delete_permission_main_menues');
Route::post('/permission_roles/load_add_permission_roles_sub_menu', [PermissionRoleController::class, 'load_add_permission_roles_sub_menu'])->name('admin.permission_roles.load_add_permission_roles_sub_menu');
Route::post('/permission_roles/add_permission_roles_sub_menu/{id}', [PermissionRoleController::class, 'add_permission_roles_sub_menu'])->name('admin.permission_roles.add_permission_roles_sub_menu');
Route::get('/permission_roles/delete_permission_sub_menues/{id}', [PermissionRoleController::class, 'delete_permission_sub_menues'])->name('admin.permission_roles.delete_permission_sub_menues');
Route::post('/permission_roles/load_add_permission_roles_sub_menues_actions', [PermissionRoleController::class, 'load_add_permission_roles_sub_menues_actions'])->name('admin.permission_roles.load_add_permission_roles_sub_menues_actions');
Route::post('/permission_roles/add_permission_roles_sub_menues_actions/{id}', [PermissionRoleController::class, 'add_permission_roles_sub_menues_actions'])->name('admin.permission_roles.add_permission_roles_sub_menues_actions');
Route::get('/permission_roles/delete_permission_sub_menues_actions/{id}', [PermissionRoleController::class, 'delete_permission_sub_menues_actions'])->name('admin.permission_roles.delete_permission_sub_menues_actions');



/*       ═══════ ೋღ  end permission ღೋ ═══════                 */

/*     ═══════ ೋღ start  permission_main_menues  ღೋ ═══════              */
Route::get('/permission_main_menues/index', [PermissionMainMenueController::class, 'index'])->name('admin.permission_main_menues.index');
Route::get('/permission_main_menues/create', [PermissionMainMenueController::class, 'create'])->name('admin.permission_main_menues.create');
Route::get('/permission_main_menues/edit/{id}', [PermissionMainMenueController::class, 'edit'])->name('admin.permission_main_menues.edit');
Route::post('/permission_main_menues/store', [PermissionMainMenueController::class, 'store'])->name('admin.permission_main_menues.store');
Route::post('/permission_main_menues/update/{id}', [PermissionMainMenueController::class, 'update'])->name('admin.permission_main_menues.update');
Route::get('/permission_main_menues/delete/{id}', [PermissionMainMenueController::class, 'delete'])->name('admin.permission_main_menues.delete');

/*       ═══════ ೋღ  end permission_main_menues ღೋ ═══════                 */

/*     ═══════ ೋღ start  permission_sub_menues  ღೋ ═══════              */
Route::get('/permission_sub_menues/index', [PermissionSubMenueController::class, 'index'])->name('admin.permission_sub_menues.index');
Route::get('/permission_sub_menues/create', [PermissionSubMenueController::class, 'create'])->name('admin.permission_sub_menues.create');
Route::get('/permission_sub_menues/edit/{id}', [PermissionSubMenueController::class, 'edit'])->name('admin.permission_sub_menues.edit');
Route::post('/permission_sub_menues/store', [PermissionSubMenueController::class, 'store'])->name('admin.permission_sub_menues.store');
Route::post('/permission_sub_menues/update/{id}', [PermissionSubMenueController::class, 'update'])->name('admin.permission_sub_menues.update');
Route::post('/permission_sub_menues/ajax_search/', [PermissionSubMenueController::class, 'ajax_search'])->name('admin.permission_sub_menues.ajax_search');
Route::post('/permission_sub_menues/ajax_do_add_permission/', [PermissionSubMenueController::class, 'ajax_do_add_permission'])->name('admin.permission_sub_menues.ajax_do_add_permission');
Route::post('/permission_sub_menues/ajax_load_edit_permission/', [PermissionSubMenueController::class, 'ajax_load_edit_permission'])->name('admin.permission_sub_menues.ajax_load_edit_permission');
Route::post('/permission_sub_menues/ajax_do_edit_permission/', [PermissionSubMenueController::class, 'ajax_do_edit_permission'])->name('admin.permission_sub_menues.ajax_do_edit_permission');
Route::get('/permission_sub_menues/delete/{id}', [PermissionSubMenueController::class, 'delete'])->name('admin.permission_sub_menues.delete');
Route::post('/permission_sub_menues/ajax_do_delete_permission/', [PermissionSubMenueController::class, 'ajax_do_delete_permission'])->name('admin.permission_sub_menues.ajax_do_delete_permission');


/*       ═══════ ೋღ  end permission_sub_menues ღೋ ═══════                 */

});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
