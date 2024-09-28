<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

Route::group(["prefix" => "employees"], function () {
    Route::get("/", [\App\Http\Controllers\EmployeeController::class, "index"])->name("employees.index");
    Route::post("/", [\App\Http\Controllers\EmployeeController::class, "store"])->name("employees.store");
    Route::post("/{employee}", [\App\Http\Controllers\EmployeeController::class, "update"])->name("employees.update");
    Route::get("/{employee}/destroy", [\App\Http\Controllers\EmployeeController::class, "destroy"])->name("employees.destroy");
});

Route::post("drive", function (Request $request) {
        $file = storage_path('app/private/'.$filePath);
    \App\Jobs\UploadGdrive::dispatch($file, $request->file('file')->getClientOriginalName());

    return response()->json(["success" => true]);
});

Route::get('provinces', function () {
    $apiKey = env('BINDERBYTE_API_KEY');
    $response = Http::get("https://api.binderbyte.com/wilayah/provinsi", [
        'api_key' => $apiKey
    ]);
    return $response->json();
});

Route::get('cities/{provinceId}', function ($provinceId) {
    $apiKey = env('BINDERBYTE_API_KEY');
    $response = Http::get("https://api.binderbyte.com/wilayah/kabupaten", [
        'api_key' => $apiKey,
        'id_provinsi' => $provinceId
    ]);

    return $response->json();
});


