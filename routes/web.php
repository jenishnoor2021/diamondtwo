<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDailyController;
use App\Http\Controllers\AdminPartyController;
use App\Http\Controllers\AdminDimondController;
use App\Http\Controllers\AdminWorkerController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminExpenceController;
use App\Http\Controllers\AdminInvoiceController;
use App\Http\Controllers\AdminProcessController;
use App\Http\Controllers\AdminSlidersController;
use App\Http\Controllers\AdminPartyRateController;
use App\Http\Controllers\AdminWorkerRateController;
use App\Http\Controllers\AdminDesignationController;
use App\Http\Controllers\AdminWorkerBarcodeController;
use App\Http\Controllers\AdminWorkerAttendanceController;

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
    return view('auth.login');
})->name('admin.login');

//  for admin registration below comment uncomment karvi and above auth.login ne comment karvi
// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

// Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'usersession']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin');

    Route::get('/profile/{id}', [AdminController::class, 'profiledit'])->name('profile.edit');
    Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');

    Route::get("admin/slider", [AdminSlidersController::class, 'index'])->name('admin.slider.index');
    Route::get('admin/slider/create', [AdminSlidersController::class, 'create'])->name('admin.slider.create');
    Route::post('admin/slider/store', [AdminSlidersController::class, 'store'])->name('admin.slider.store');
    Route::get('admin/slider/edit/{id}', [AdminSlidersController::class, 'edit'])->name('admin.slider.edit');
    Route::patch('admin/slider/update/{id}', [AdminSlidersController::class, 'update'])->name('admin.slider.update');
    Route::get('admin/slider/destroy/{id}', [AdminSlidersController::class, 'destroy'])->name('admin.slider.destroy');
    // Route::delete('/mysliderDeleteAll', [AdminSlidersController::class, 'deleteSliderAll'])->name('deletesliderAll');
    Route::get("admin/slider/active/{id}", [AdminSlidersController::class, 'sliderActive'])->name('admin.slider.active');

    Route::get("admin/party", [AdminPartyController::class, 'index'])->name('admin.party.index');
    Route::get('admin/party/create', [AdminPartyController::class, 'create'])->name('admin.party.create');
    Route::post('admin/party/store', [AdminPartyController::class, 'store'])->name('admin.party.store');
    Route::get('admin/party/edit/{id}', [AdminPartyController::class, 'edit'])->name('admin.party.edit');
    Route::patch('admin/party/update/{id}', [AdminPartyController::class, 'update'])->name('admin.party.update');
    Route::get('admin/party/destroy/{id}', [AdminPartyController::class, 'destroy'])->name('admin.party.destroy');
    Route::get("admin/party/active/{id}", [AdminPartyController::class, 'partyActive'])->name('admin.party.active');

    Route::get("admin/worker", [AdminWorkerController::class, 'index'])->name('admin.worker.index');
    Route::get('admin/worker/create', [AdminWorkerController::class, 'create'])->name('admin.worker.create');
    Route::post('admin/worker/store', [AdminWorkerController::class, 'store'])->name('admin.worker.store');
    Route::get('admin/worker/edit/{id}', [AdminWorkerController::class, 'edit'])->name('admin.worker.edit');
    Route::patch('admin/worker/update/{id}', [AdminWorkerController::class, 'update'])->name('admin.worker.update');
    Route::get('admin/worker/destroy/{id}', [AdminWorkerController::class, 'destroy'])->name('admin.worker.destroy');
    Route::get("admin/worker/active/{id}", [AdminWorkerController::class, 'workerActive'])->name('admin.worker.active');

    Route::get("admin/party_rate", [AdminPartyRateController::class, 'index'])->name('admin.party_rate.index');
    Route::patch('admin/party_rate/update/{id}', [AdminPartyRateController::class, 'update'])->name('admin.party_rate.update');

    Route::get("admin/worker_rate", [AdminWorkerRateController::class, 'index'])->name('admin.worker_rate.index');
    Route::patch('admin/worker_rate/update/{id}', [AdminWorkerRateController::class, 'update'])->name('admin.worker_rate.update');

    Route::get("admin/dimond", [AdminDimondController::class, 'index'])->name('admin.dimond.index');
    Route::get('admin/dimond/show/{id}', [AdminDimondController::class, 'show'])->name('admin.dimond.show');
    Route::get('admin/dimond/create', [AdminDimondController::class, 'create'])->name('admin.dimond.create');
    Route::post('admin/dimond/store', [AdminDimondController::class, 'store'])->name('admin.dimond.store');
    Route::get('admin/dimond/edit/{id}', [AdminDimondController::class, 'edit'])->name('admin.dimond.edit');
    Route::patch('admin/dimond/update/{id}', [AdminDimondController::class, 'update'])->name('admin.dimond.update');
    Route::get('admin/dimond/destroy/{id}', [AdminDimondController::class, 'destroy'])->name('admin.dimond.destroy');
    // Route::post('admin/dimond/updatestatus', [AdminDimondController::class, 'updateStatus'])->name('admin.dimond.updatestatus');

    Route::get('admin/dimond/show', [AdminDimondController::class, 'dimondDetail'])->name('dimond.detail');
    Route::get("admin/hrdimond", [AdminDimondController::class, 'hrDimond'])->name('admin.hrdimond.list');
    Route::get("admin/print-image/{id}", [AdminDimondController::class, 'printImage'])->name('admin.dimond.printimage');

    // Route::get("admin/process", [AdminProcessController::class, 'index'])->name('admin.process.index');
    // Route::get('admin/process/show/{id}', [AdminProcessController::class, 'show'])->name('admin.process.show');
    // Route::get('admin/process/create', [AdminProcessController::class, 'create'])->name('admin.process.create');
    Route::post('admin/process/store', [AdminProcessController::class, 'store'])->name('admin.process.store');
    Route::get('admin/process/edit/{id}', [AdminProcessController::class, 'edit'])->name('admin.process.edit');
    Route::post('admin/process/update', [AdminProcessController::class, 'update'])->name('admin.process.update');
    Route::get('admin/process/destroy/{id}', [AdminProcessController::class, 'destroy'])->name('admin.process.destroy');

    Route::post('admin/get-workers', [AdminDimondController::class, 'getWorkersByDesignation'])->name('admin.process.getworker');
    Route::post('admin/get-designation', [AdminDimondController::class, 'getDesignationByCategory'])->name('admin.process.getdesignation');

    Route::get("admin/designation", [AdminDesignationController::class, 'index'])->name('admin.designation.index');
    Route::get('admin/designation/show/{id}', [AdminDesignationController::class, 'show'])->name('admin.designation.show');
    Route::get('admin/designation/create', [AdminDesignationController::class, 'create'])->name('admin.designation.create');
    Route::post('admin/designation/store', [AdminDesignationController::class, 'store'])->name('admin.designation.store');
    Route::get('admin/designation/edit/{id}', [AdminDesignationController::class, 'edit'])->name('admin.designation.edit');
    Route::patch('admin/designation/update/{id}', [AdminDesignationController::class, 'update'])->name('admin.designation.update');
    Route::get('admin/designation/destroy/{id}', [AdminDesignationController::class, 'destroy'])->name('admin.designation.destroy');

    Route::get("admin/expense", [AdminExpenceController::class, 'index'])->name('admin.expense.index');
    Route::get('admin/expense/show/{id}', [AdminExpenceController::class, 'show'])->name('admin.expense.show');
    Route::get('admin/expense/create', [AdminExpenceController::class, 'create'])->name('admin.expense.create');
    Route::post('admin/expense/store', [AdminExpenceController::class, 'store'])->name('admin.expense.store');
    Route::get('admin/expense/edit/{id}', [AdminExpenceController::class, 'edit'])->name('admin.expense.edit');
    Route::patch('admin/expense/update/{id}', [AdminExpenceController::class, 'update'])->name('admin.expense.update');
    Route::get('admin/expense/destroy/{id}', [AdminExpenceController::class, 'destroy'])->name('admin.expense.destroy');

    Route::post('admin/expense/updatestatus', [AdminExpenceController::class, 'updateStatus'])->name('admin.expense.updatestatus');

    Route::get("admin/report", [AdminExpenceController::class, 'report'])->name('admin.report.index');
    Route::post('admin/generate-pdf', [AdminExpenceController::class, 'generatePdf'])->name('generate-pdf');

    Route::get("admin/worker_report", [AdminExpenceController::class, 'workerReport'])->name('admin.worker.report');
    Route::get('admin/generate-worker-pdf', [AdminExpenceController::class, 'generateWorkerPdf'])->name('generate-worker-pdf');

    Route::get('admin/print-slipe/{id}', [AdminExpenceController::class, 'printSlipe'])->name('print.slipe');
    Route::get('admin/repair/{id}', [AdminExpenceController::class, 'repair'])->name('repair.dimond');

    Route::get('admin/party-report', [AdminExpenceController::class, 'partyReport'])->name('party.report');
    Route::post('admin/party-bill', [AdminExpenceController::class, 'partyBill'])->name('party.bill');
    Route::post('admin/party-bill-excel', [AdminExpenceController::class, 'partyBillExcel'])->name('party.bill.excel');
    Route::get('admin/party-filter', [AdminExpenceController::class, 'partyFilter'])->name('party.filter');

    Route::get('admin/summary', [AdminExpenceController::class, 'summary'])->name('admin.summary');
    Route::get('admin/summary-export', [AdminExpenceController::class, 'summaryExport'])->name('admin.summary.export');

    Route::get('admin/worker_summary', [AdminExpenceController::class, 'workerSummary'])->name('admin.workersummary');
    Route::get('admin/worker_summary_export', [AdminExpenceController::class, 'workerSummaryExport'])->name('admin.workersummary.export');

    Route::get('admin/worker_slip', [AdminExpenceController::class, 'workerSlip'])->name('admin.workerslip');
    Route::post('admin/generateslippdf', [AdminExpenceController::class, 'generateSlipPdf'])->name('admin.generateslippdf');

    Route::get('admin/dimond_slip', [AdminExpenceController::class, 'diamondSlip'])->name('admin.diamondslip');
    Route::post('admin/diamondslippdf', [AdminExpenceController::class, 'diamondSlipPdf'])->name('admin.diamondslippdf');

    Route::get('admin/hr-export', [AdminExpenceController::class, 'hrExport'])->name('admin.hr.export');
    Route::get('admin/hr-export-pdf', [AdminExpenceController::class, 'hrExportPDF'])->name('admin.hr.exportpdf');

    Route::get("admin/daily-status", [AdminDailyController::class, 'index'])->name('admin.daily-status.index');
    Route::post('admin/daily-status/store', [AdminDailyController::class, 'store'])->name('admin.daily-status.store');
    Route::get('admin/daily-status/destroy/{id}', [AdminDailyController::class, 'destroy'])->name('admin.daily-status.destroy');
    Route::get('admin/daily-status/statusupdate/{id}', [AdminDailyController::class, 'statusUpdate'])->name('admin.daily-status.updatestatus');
    Route::get('admin/daily-status/refresh', [AdminDailyController::class, 'statusRefresh'])->name('admin.daily-status.refresh');

    Route::get('admin/dimond_list', [AdminExpenceController::class, 'addDiamondList'])->name('admin.add-dimond.list');

    Route::get("admin/worker-barcode", [AdminWorkerBarcodeController::class, 'index'])->name('admin.worker-barcode.index');
    Route::get('admin/worker-barcode/show/{id}', [AdminWorkerBarcodeController::class, 'show'])->name('admin.worker-barcode.show');
    Route::get('admin/worker-barcode/create', [AdminWorkerBarcodeController::class, 'create'])->name('admin.worker-barcode.create');
    Route::post('admin/worker-barcode/store', [AdminWorkerBarcodeController::class, 'store'])->name('admin.worker-barcode.store');
    Route::get('admin/worker-barcode/edit/{id}', [AdminWorkerBarcodeController::class, 'edit'])->name('admin.worker-barcode.edit');
    Route::patch('admin/worker-barcode/update/{id}', [AdminWorkerBarcodeController::class, 'update'])->name('admin.worker-barcode.update');
    Route::get('admin/worker-barcode/destroy/{id}', [AdminWorkerBarcodeController::class, 'destroy'])->name('admin.worker-barcode.destroy');

    Route::get("admin/print-worker-barcode/{id}", [AdminWorkerBarcodeController::class, 'printBarcode'])->name('admin.worker.printbarcode');

    Route::get("admin/attendance", [AdminWorkerAttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('admin/attendance/create', [AdminWorkerAttendanceController::class, 'create'])->name('admin.attendance.create');
    Route::post('admin/attendance/store', [AdminWorkerAttendanceController::class, 'store'])->name('admin.attendance.store');
    Route::get('admin/attendance/edit/{id}', [AdminWorkerAttendanceController::class, 'edit'])->name('admin.attendance.edit');
    Route::patch('admin/attendance/update/{id}', [AdminWorkerAttendanceController::class, 'update'])->name('admin.attendance.update');
    Route::get('admin/attendance/destroy/{id}', [AdminWorkerAttendanceController::class, 'destroy'])->name('admin.attendance.destroy');

    Route::get("admin/attendance-summary", [AdminWorkerAttendanceController::class, 'attendanceSummary'])->name('admin.attendance-summary.index');

    Route::get("admin/check-in", [AdminWorkerAttendanceController::class, 'checkIn'])->name('admin.check-in.index');
    Route::get("admin/check-out", [AdminWorkerAttendanceController::class, 'checkOut'])->name('admin.check-out.index');
    Route::post('admin/check-in/store', [AdminWorkerAttendanceController::class, 'checkInStore'])->name('admin.check-in.store');
    Route::post('admin/check-out/store', [AdminWorkerAttendanceController::class, 'checkOutStore'])->name('admin.check-out.store');

    Route::get("admin/company", [AdminCompanyController::class, 'index'])->name('admin.company.index');
    Route::get('admin/company/create', [AdminCompanyController::class, 'create'])->name('admin.company.create');
    Route::post('admin/company/store', [AdminCompanyController::class, 'store'])->name('admin.company.store');
    Route::get('admin/company/edit/{id}', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
    Route::patch('admin/company/update/{id}', [AdminCompanyController::class, 'update'])->name('admin.company.update');
    Route::get('admin/company/destroy/{id}', [AdminCompanyController::class, 'destroy'])->name('admin.company.destroy');

    Route::get("admin/invoice", [AdminInvoiceController::class, 'index'])->name('admin.invoice.index');
    Route::get('admin/invoice/create', [AdminInvoiceController::class, 'create'])->name('admin.invoice.create');
    Route::post('admin/invoice/store', [AdminInvoiceController::class, 'store'])->name('admin.invoice.store');
    Route::get('admin/invoice/edit/{id}', [AdminInvoiceController::class, 'edit'])->name('admin.invoice.edit');
    Route::patch('admin/invoice/update/{id}', [AdminInvoiceController::class, 'update'])->name('admin.invoice.update');
    Route::get('admin/invoice/destroy/{id}', [AdminInvoiceController::class, 'destroy'])->name('admin.invoice.destroy');

    Route::post('admin/invoice/storedata', [App\Http\Controllers\AdminInvoiceController::class, 'storeInvoiceData'])->name('admin.invoice.storedata');
    Route::get('admin/invoice/editdata/{id}', [App\Http\Controllers\AdminInvoiceController::class, 'editInvoiceData'])->name('admin.invoice.editdata');
    Route::patch('admin/invoice/updatedata/{id}', [App\Http\Controllers\AdminInvoiceController::class, 'updateInvoiceData'])->name('admin.invoice.updatedata');
    Route::get('admin/invoice/destroyinvoicedata/{id}', [App\Http\Controllers\AdminInvoiceController::class, 'destroyInvoiceData'])->name('admin.invoicedata.destroy');

    Route::get('admin/invoice/createpdf/{id}', [App\Http\Controllers\AdminInvoiceController::class, 'createPDF'])->name('admin.invoice.pdf');

    Route::get('admin/import-diamonds-page', [App\Http\Controllers\AdminDimondController::class, 'importPage'])->name('admin.dimond.import');
    Route::post('admin/import-diamonds', [App\Http\Controllers\AdminDimondController::class, 'import'])->name('import.diamonds');
});

//Clear Cache facade value:
Route::get('/admin/clear-cache', function () {
    Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/admin/optimize', function () {
    Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/admin/route-cache', function () {
    Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/admin/route-clear', function () {
    Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/admin/view-clear', function () {
    Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/admin/config-cache', function () {
    Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
