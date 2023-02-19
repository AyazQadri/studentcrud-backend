<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum']], function () {

});

Route::post("role", [RoleController::class, "createRole"]);
Route::post("create/student", [StudentController::class, "createStudent"]);
Route::post("update/student/{student_id}", [StudentController::class, "updateStudent"]);
Route::get("get/student/{student_id}", [StudentController::class, "getStudentById"]);
Route::get("get/all/active-students", [StudentController::class, "getAllStudent"]);
Route::patch("deactivate/student/{student_id}", [StudentController::class, "deactivateStudent"]);
Route::patch("activate/student/{student_id}", [StudentController::class, "activateStudent"]);
Route::delete("delete/student/{student_id}", [StudentController::class, "deleteStudent"]);



