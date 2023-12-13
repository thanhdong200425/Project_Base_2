<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExpertTeamController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ExpertTeamController as AdminExpertTeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*TODO
    API:
     -) User
        +) Thong tin chi tiet cua pet (ok)
        +) Thong tin chi tiet cua service (ok)
        +) Thong tin chi tiet cua expert team (ok)
        +) Thông tin chi tiết của blog theo category và user (ok)
        +) Thay đổi thông tin người dùng (ok)

     -) Admin
        +) Lấy danh sách người dùng (ok)
        +) Lấy danh sách nhân sự (ok)
        +) Thay đổi trạng thái tài khoản của user
        +) Lấy danh sách dịch vụ đã đăng ký
        +) Thông tin thời gian làm việc của user
        +) Danh sách dịch vụ đang cần chờ duyệt
        +) Duyệt dịch vụ
        +) Lấy trạng thái danh sách người dùng



*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sign in
Route::post("/", [UserController::class, 'sign_in'])->name("signIn");

// Sign up
Route::post('/sign-up', [UserController::class, 'sign_up'])->name('signUp');

// Detail information about pets
Route::get('/pets', [PetController::class, 'getAll'])->name('pets.getAll');

// Detail information about one pet
Route::get('/pet/{id}', [PetController::class, 'getOne'])->name('pet.getOne');

// Detail information about services
Route::get('/services', [ServiceController::class, 'getAll'])->name('services.getAll');

// Detail information about all the expert teams
Route::get('/expert_teams', [ExpertTeamController::class, 'getAll'])->name('expert_teams.getAll');

// Detail information about blog following category and user
Route::get('/blogs_categories', [BlogController::class, 'getAllByCategory'])->name('blogs.getAllByCategory');

// Update the information of a user
Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::prefix('/admin')->group(function () {
    // Get the information of all users
    Route::get('/get_users', [AdminUserController::class, 'getAll']);

    // Get the information of all experts team
    Route::get('/get_experts_team', [ExpertTeamController::class, 'getAll']);

    // Update status of a user
    Route::patch('/user/update/{id}', [AdminUserController::class, 'update']);
});





