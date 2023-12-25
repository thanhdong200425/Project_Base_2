<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExpertTeamController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ExpertTeamController as AdminExpertTeamController;
use App\Http\Controllers\Admin\BillController;

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
     -) Chung:
        +) Đăng nhập (ok)
        +) Đăng ký (ok)
        +) Đăng xuất (ok)
            -) Cho user
            -) Cho admin

     -) User
        +) Thong tin chi tiet cua pet (ok)
        +) Thong tin chi tiet cua service (ok)
        +) Thong tin chi tiet cua expert team (ok)
        +) Thông tin chi tiết của blog theo category và user (ok)
        +) Thay đổi thông tin người dùng (ok)

     -) Admin
        +) Lấy danh sách người dùng (ok)
        +) Lấy danh sách nhân sự (ok)
        +) Thay đổi trạng thái tài khoản của user (ok)
        +) Lấy danh sách dịch vụ đã đăng ký của user (ok)
            1) Lấy danh sách dịch vụ đang chờ của user (ok)
            2) Lấy danh sách dịch vụ đã phê duyệt của user (ok)
        +) Thông tin thời gian làm việc của user (ok)
        +) Danh sách dịch vụ đang cần chờ duyệt (ok)
        +) Duyệt dịch vụ (ok)
        +) Lấy trạng thái danh sách người dùng (ok)
        +) Lấy danh sách hóa đơn đang chờ duyệt (ok)
        +) Lấy danh sách hóa đơn đã duyệt (ok)
        +) Lấy danh sách người dùng có decentralizaion = 2 (ok)
        +) Lấy danh sách người dùng có decentralizaion = 3 (ok)
        +) Người dùng đăng ký dịch vụ (ok)
        +) Hủy dịch vụ đã đăng ký (ok)
        +) Cập nhật dịch vụ đã đăng ký (ok)
        +) Lấy danh sách các sản phẩm (ok)
        +) Thêm sản phẩm vào giỏ hàng (ok)
        +) Thay đổi số lượng sản phẩm trong giỏ hàng (ok)
        +) Xóa sản phẩm trong giỏ hàng (ok)
        +) Lấy danh sách sản phẩm trong giỏ hàng (ok)
        +) Lấy số lượng sản phẩm trong giỏ hàng (ok)



*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sign in
Route::post("/", [UserController::class, 'sign_in'])->name("signIn");

// Sign up
Route::post('/sign_up', [UserController::class, 'sign_up'])->name('signUp');

// Log out
Route::post('/log_out', [UserController::class, 'sign_out']);

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

Route::prefix('/user')->group(function () {
    // Update the information of a user
    Route::put('/update', [UserController::class, 'update'])->name('user.update');

    // User registry service
    Route::post('/registry_service', [UserController::class, 'registry']);

    // Cancel registered service of a user
    Route::post('/cancel_service', [UserController::class, 'cancelService']);

    // Update registered service of a user
    Route::put('/update_service', [UserController::class, 'updateService']);

    // Add product into cart
    Route::post('/add_product_to_cart', [UserController::class, 'addProductToCart']);

    // Change the quantity of product in a cart
    Route::put('/update_quantity_of_cart', [UserController::class, 'updateQuantity']);

    // Delete a product from a cart
    Route::post('/remove_product', [UserController::class, 'removeProductFromCart']);

    // Get all the product in the cart of a user
    Route::post('/get_all_products_cart', [UserController::class, 'getProductsInCart']);

    // Get the quantity of product in the cart
    Route::post('/get_quantity_product_cart', [UserController::class, 'getQuantityInCart']);
});

// Get all products
Route::get('/get_list_product', [ProductController::class, 'getAll']);

Route::prefix('/admin')->group(function () {
    // Get the information of all users
    Route::get('/get_users', [AdminUserController::class, 'getAll']);

    // Get the information of all experts team
    Route::get('/get_experts_team', [ExpertTeamController::class, 'getAll']);

    // Update status of a user
    Route::patch('/user/update', [AdminUserController::class, 'update']);

    // Get the pending services of user
    Route::post('/user/get_services/pending', [AdminUserController::class, 'getPendingServicesOfUser']);

    // Get the accepted services of user
    Route::post('/user/get_services/accepted', [AdminUserController::class, 'getAcceptedServicesOfUser']);

    // Get the time working of a user
    Route::get('/get_time_working', [AdminUserController::class, 'getTimeWorking']);

    // Get the registered services of a user that is pending
    Route::get('/get_pending_service', [AdminUserController::class, 'getPendingServices']);

    // Update the status of a service
    Route::put('/user/update_service', [AdminUserController::class, 'updateService']);

    // Get the status of a user
    Route::post('/user/get_service_status', [AdminUserController::class, 'getServiceStatus']);

    // Get the list of pending bill
    Route::post('/user/get_bills/pending', [BillController::class, 'getPendingBills']);

    // Get the list of accepted bill
    Route::post('/user/get_bills/accepted', [BillController::class, 'getAcceptedBills']);

    // Get the list of user that has decentralization = 2
    Route::get('/list_user', [AdminUserController::class, 'getUsers']);

    // Get the list of user that has decentralization = 3
    Route::get('/list_competent_personnel', [AdminUserController::class, 'getCompetentPersonnels']);
});





