<?php

use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;

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

Route::get("/", [HomeController::class, 'index'])->name('home');


require __DIR__ . '/site.php';

Route::get('/link-assets', function () {
    $publicPath = base_path('public');
    $rootPath = base_path();

    $directories = File::directories($publicPath);
    $created = [];

    foreach ($directories as $dirPath) {
        $folderName = basename($dirPath);
        $target = $publicPath . DIRECTORY_SEPARATOR . $folderName;
        $link = $rootPath . DIRECTORY_SEPARATOR . $folderName;

        if (!File::exists($link)) {
            File::link($target, $link);
            $created[] = $folderName;
        }
    }

    return count($created)
        ? 'Symlinks created: ' . implode(', ', $created)
        : 'All symlinks already exist or no folders found in public/.';
});

Route::get('/optimize', function () {
    // Run optimize commands
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');

    return 'Optimization commands have been run successfully!';
});
