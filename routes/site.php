<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get("/feed-back", [ContactController::class, 'feedback'])->name('contact.feedback');
Route::get("/we-are-sorry-to-go", [ContactController::class, 'uninstall'])->name('contact.uninstall');
Route::get("/privacy-policy",[ContactController::class, 'privacyPolicy'])->name('contact.privacy-policy');
Route::get("/how-to-use",[ContactController::class, 'howToUse'])->name('contact.how-to-use');
?>
