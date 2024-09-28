<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return redirect()->route("employees.home");
});

Route::get("/", [EmployeeController::class, "home"])->name("employees.home");
Route::get("/create", [EmployeeController::class, "create"])->name("employees.create");
Route::get("/edit/{employee}", [EmployeeController::class, "edit"])->name("employees.edit");


