<?php

use App\Http\Controllers\Api\AtmReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;  // <- THIS IS REQUIRED
use App\Http\Controllers\API\EmployeeController;



Route::prefix('v1')->group(function () {
    Route::get('atm-reports', [AtmReportController::class, 'index']); // filtered list
    Route::get('atm-reports/summary', [AtmReportController::class, 'summary']); // aggregated report
});


Route::prefix('employees')->group(function () {
    // Local database endpoints
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{id}', [EmployeeController::class, 'show']);

    // AD endpoints
    Route::get('/ad/search', [EmployeeController::class, 'searchAd']);
    Route::get('/ad/username/{username}', [EmployeeController::class, 'getFromAd']);
    Route::get('/ad/departments', [EmployeeController::class, 'departmentsFromAd']);

    // Test endpoint
    Route::get('/test/ldap', [EmployeeController::class, 'testLdap']);
});


      //////////////////////////////// Testing ////////////////////////////////////////
   #####   php artisan tinker
 ###### >>> app()->make(\App\Services\LdapService::class)->testConnection()

######### php artisan ad:sync --limit=100 #################################
########## php artisan ad:sync --department="IT Department" ##################
########### php artisan ad:sync --search="john" ############################3