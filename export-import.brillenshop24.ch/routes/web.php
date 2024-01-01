<?php

use Illuminate\Support\Facades\Route;

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

//Home Page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

//Export List
Route::get('/export-list', [App\Http\Controllers\HomeController::class, 'ExportList']);

//Import List
Route::get('/import-list', [App\Http\Controllers\HomeController::class, 'ImportList']);

/*=============Excel Export/Import=============*/

//Data List for Excel Export
Route::get('/excel-export-data-all', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelExportPage']);
Route::get('/excel-export-data-list', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelExportDataList']);
Route::get('/excel-export-data-users', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelExportDataUsers']);

//Excel Export
Route::get('/excel-export-data', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelExportData']);
Route::get('/excel-export-users', [App\Http\Controllers\ExcelExportImportUserController::class, 'ExcelExportDataUsers']);

//Excel Import Demo List
Route::get('/excel-import-demo-list', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemoList']);

//Excel Imported Data List
Route::get('/excel-imported-data-list', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportedDataList']);
Route::get('/excel-imported-data-users', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportedDataUsers']);

Route::get('/excel-import-data', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportedData']);


//Excel Import Demo 1
Route::get('/excel-import-demo-1', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemo1']); 
Route::post('/excel-import-demo-1', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-1');
Route::post('/ExcelImportServer-1', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportServer'])->name('ExcelImportServer-1.excel-import-demo-1');

//Excel Import users
Route::get('/excel-import-users', [App\Http\Controllers\ExcelExportImportUserController::class, 'ExcelImportUsers']); 


//Excel Import Demo 2
Route::get('/excel-import-demo-2', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemo2']); 
Route::post('/excel-import-demo-2', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-2');
Route::post('/ExcelImportServer-2', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportServer'])->name('ExcelImportServer-2.excel-import-demo-2');

//Excel Import Demo 3
Route::get('/excel-import-demo-3', [App\Http\Controllers\ExcelExportImportUserController::class, 'ExcelImportDemo3']); 
Route::post('/excel-import-demo-3', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-3');
Route::post('/ExcelImportServer-3', [App\Http\Controllers\ExcelExportImportUserController::class, 'ExcelImportServer'])->name('ExcelImportServer-3.excel-import-demo-3');

//Excel Import Demo 4
Route::get('/excel-import-demo-4', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemo4']); 
Route::post('/excel-import-demo-4', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-4');
Route::post('/ExcelImportServer-4', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportServer'])->name('ExcelImportServer-4.excel-import-demo-4');

//Excel Import Demo 5
Route::get('/excel-import-demo-5', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemo5']); 
Route::post('/excel-import-demo-5', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-5');
Route::post('/ExcelImportServer-5', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportServer'])->name('ExcelImportServer-5.excel-import-demo-5');

//Excel Import Demo 6
Route::get('/excel-import-demo-6', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportDemo6']); 
Route::post('/excel-import-demo-6', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.excel-import-demo-6');
Route::post('/ExcelImportServer-6', [App\Http\Controllers\ExcelExportImportController::class, 'ExcelImportServer'])->name('ExcelImportServer-6.excel-import-demo-6');

/*=============CSV Export/Import=============*/
//Data List for CSV Export

Route::get('/csv-export-data-list-all', [App\Http\Controllers\CSVExportImportController::class, 'CSVExportDataListAll']);
Route::get('/csv-export-data-list', [App\Http\Controllers\CSVExportImportController::class, 'CSVExportDataList']);
Route::get('/csv-export-data-users', [App\Http\Controllers\CSVExportImportController::class, 'CSVExportDataListUsers']);

//CSV Export
Route::get('/csv-export-data', [App\Http\Controllers\CSVExportImportController::class, 'CSVExportData']);
Route::get('/csv-export-users', [App\Http\Controllers\CSVExportImportUserController::class, 'CSVExportUsers']);

//CSV Import Demo List
Route::get('/csv-import-demo-list', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemoList']);
Route::get('/csv-import-data-list', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportedData']);

//CSV Imported Data List
Route::get('/csv-imported-data-list', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportedDataList']);

//CSV Import Demo 1
Route::get('/csv-import-demo-1', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo1']); 
Route::post('/csv-import-demo-1', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-1');
Route::post('/CSVImportServer-1', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportServer'])->name('CSVImportServer-1.csv-import-demo-1');

//CSV Import Demo 2
Route::get('/csv-import-demo-2', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo2']); 
Route::post('/csv-import-demo-2', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-2');
Route::post('/CSVImportServer-2', [App\Http\Controllers\CSVExportImportUserController::class, 'CSVImportServer'])->name('CSVImportServer-2.csv-import-demo-2');

//CSV Import Demo 3
Route::get('/csv-import-demo-3', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo3']); 
Route::post('/csv-import-demo-3', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-3');
Route::post('/CSVImportServer-3', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportServer'])->name('CSVImportServer-3.csv-import-demo-3');

//CSV Import Demo 4
Route::get('/csv-import-demo-4', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo4']); 
Route::post('/csv-import-demo-4', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-4');
Route::post('/CSVImportServer-4', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportServer'])->name('CSVImportServer-4.csv-import-demo-4');

//CSV Import Demo 5
Route::get('/csv-import-demo-5', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo5']); 
Route::post('/csv-import-demo-5', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-5');
Route::post('/CSVImportServer-5', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportServer'])->name('CSVImportServer-5.csv-import-demo-5');

//CSV Import Demo 6
Route::get('/csv-import-demo-6', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportDemo6']); 
Route::post('/csv-import-demo-6', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.csv-import-demo-6');
Route::post('/CSVImportServer-6', [App\Http\Controllers\CSVExportImportController::class, 'CSVImportServer'])->name('CSVImportServer-6.csv-import-demo-6');

/*=============Multiple Worksheet Excel Export/Import=============*/

//Data List for Multiple Worksheet Excel Export
Route::get('/multiple-worksheet-export-data-list', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetDataList']);

//Multiple Worksheet Excel Export
Route::get('/multiple-worksheet-excel-export', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelExport']);

//Multiple Worksheet Imported Data List
Route::get('/multiple-worksheet-imported-data-list', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetImportedDataList']);

//Excel Multiple Worksheet Import Demo List
Route::get('/multiple-worksheet-excel-import', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetImportDemoList']);

//Multiple Worksheet Excel Import Demo 1
Route::get('/multiple-worksheet-excel-import-demo-1', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo1']); 
Route::post('/multiple-worksheet-excel-import-demo-1', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-1');
Route::post('/MultipleWorksheetExcelImportServer-1', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-1.multiple-worksheet-excel-import-demo-1');

//Multiple Worksheet Excel Import Demo 2
Route::get('/multiple-worksheet-excel-import-demo-2', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo2']); 
Route::post('/multiple-worksheet-excel-import-demo-2', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-2');
Route::post('/MultipleWorksheetExcelImportServer-2', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-2.multiple-worksheet-excel-import-demo-2');

//Multiple Worksheet Excel Import Demo 3
Route::get('/multiple-worksheet-excel-import-demo-3', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo3']); 
Route::post('/multiple-worksheet-excel-import-demo-3', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-3');
Route::post('/MultipleWorksheetExcelImportServer-3', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-3.multiple-worksheet-excel-import-demo-3');

//Multiple Worksheet Excel Import Demo 4
Route::get('/multiple-worksheet-excel-import-demo-4', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo4']); 
Route::post('/multiple-worksheet-excel-import-demo-4', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-4');
Route::post('/MultipleWorksheetExcelImportServer-4', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-4.multiple-worksheet-excel-import-demo-4');

//Multiple Worksheet Excel Import Demo 5
Route::get('/multiple-worksheet-excel-import-demo-5', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo5']); 
Route::post('/multiple-worksheet-excel-import-demo-5', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-5');
Route::post('/MultipleWorksheetExcelImportServer-5', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-5.multiple-worksheet-excel-import-demo-5');

//Multiple Worksheet Excel Import Demo 6
Route::get('/multiple-worksheet-excel-import-demo-6', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportDemo6']); 
Route::post('/multiple-worksheet-excel-import-demo-6', [App\Http\Controllers\UploadController::class, 'FileUpload'])->name('FileUpload.multiple-worksheet-excel-import-demo-6');
Route::post('/MultipleWorksheetExcelImportServer-6', [App\Http\Controllers\MultipleWorksheetController::class, 'MultipleWorksheetExcelImportServer'])->name('MultipleWorksheetExcelImportServer-6.multiple-worksheet-excel-import-demo-6');





