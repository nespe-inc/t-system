<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/new-page', function () {
    return redirect()->route('systems.index');
})->middleware(['auth', 'verified'])->name('new-page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('systems', SystemController::class);
    Route::resource('companies', CompanyController::class);
    Route::get('companies/{company}/investigations', [CompanyController::class, 'investigations'])->name('companies.investigations');
    Route::get('companies/{company}/add-info', [CompanyController::class, 'addInfo'])->name('companies.add-info');
    Route::post('companies/{company}/add-info', [CompanyController::class, 'storeInfo'])->name('companies.store-info');
    Route::get('companies/{company}/investigations/{investigation}/edit', [CompanyController::class, 'editInvestigation'])->name('companies.investigations.edit');
    Route::put('companies/{company}/investigations/{investigation}', [CompanyController::class, 'updateInvestigation'])->name('companies.investigations.update');
    Route::delete('companies/{company}/investigations/{investigation}', [CompanyController::class, 'destroyInvestigation'])->name('companies.investigations.destroy');
    Route::post('companies/{company}/investigation-documents', [CompanyController::class, 'uploadDocument'])->name('companies.investigation-documents.upload');
    Route::get('companies/{company}/investigation-documents/{document}/download', [CompanyController::class, 'downloadDocument'])->name('companies.investigation-documents.download');
    Route::get('companies/{company}/investigation-documents/{document}/preview', [CompanyController::class, 'previewDocument'])->name('companies.investigation-documents.preview');
    Route::delete('companies/{company}/investigation-documents/{document}', [CompanyController::class, 'deleteDocument'])->name('companies.investigation-documents.delete');
    
    Route::get('masters', [MasterController::class, 'index'])->name('masters.index');
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
