<?php
use App\Http\Controllers\UnitKerjaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/unit-kerja", [UnitKerjaController::class, "index"]);

Route::get('/profil', function () {
    return "Belajar Laravel 12 di STTNF 2025";
});
