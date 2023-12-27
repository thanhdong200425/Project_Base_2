<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    public function sign_in(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if ($user != null && Hash::check($request->password, $user->password)):
            return response()->json([
                'status' => true,
                'data' => $user,
            ]);
        endif;

        return response()->json([
            'status' => false,
            'data' => "User not found",
        ]);
    }


    public function sign_up(Request $request): JsonResponse
    {
        if ($request->has('confirm_password')) {
            if ($request->password === $request->confirm_password) {
                $user = DB::table('users')->insert([
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'status' => 0
                ]);

                if ($user) {
                    return response()->json([
                        'status' => true,
                        'data' => "Added"
                    ], 200);
                }

                return response()->json([
                    'status' => false,
                    'data' => 'Error when add'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'Password must be match'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'data' => "Something went wrong"
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = User::find($request->id);

        if ($user == null):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        $user->fill($request->all());
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function sign_out(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'data' => 'Successfully log out'
        ]);
    }

    public function registry(Request $request): JsonResponse
    {
        $result = DB::table('user_service')->insert([
            'userid' => $request->userid,
            'serviceid' => $request->serviceid,
            'periodTime' => $request->periodTime,
            'register_day' => $request->register_day,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->get();

        if ($result === true):
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        endif;

        return response()->json([
            'status' => false,
            'data' => []
        ]);
    }

    public function cancelService(Request $request): JsonResponse
    {
        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->delete();

        if ($data != 1):
            return response()->json([
                'status' => false,
                'data' => $data
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function updateService(Request $request): JsonResponse
    {
        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->update([
                'periodTime' => $request->periodTime,
                'register_day' => $request->register_day,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        if ($data == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);




    }

    public function addProductToCart(Request $request): JsonResponse
    {
        // Get product price
        $productPrice = DB::table('product')
            ->where('productid', '=', $request->productid)
            ->value('price');

        $check = $this->isExistInCart($request->userid, $request->productid);

        // Create a new record when it doesn't exist in the database
        if ($check === false):
            $price = $productPrice * ($request->quantity);
            $data = $this->createCartWhenNotExist($request->userid, $request->productid, $request->quantity, $price);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        endif;

        // Update when exist a record in a database
        $updateQuantity = $request->quantity + $check->quantity;
        $updatePrice = $updateQuantity * $productPrice;

        $data = $this->updateCartWhenExist($request->userid, $request->productid, $updateQuantity, $updatePrice);

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function isExistInCart($userid, $productid): mixed
    {
        $result = DB::table('cart')
            ->where('userid', '=', $userid)
            ->where('productid', '=', $productid)
            ->first();

        if ($result == null):
            return false;
        endif;

        return $result;
    }

    public function updateCartWhenExist($userid, $productid, $quantity, $price): mixed
    {
        $updateData = DB::table('cart')
            ->where([
                ['userid', '=', $userid],
                ['productid', '=', $productid]
            ])
            ->update([
                'quantity' => $quantity,
                'price' => $price
            ]);
        if ($updateData == 0):
            return false;
        endif;

        $record = DB::table('cart')->where([
            ['userid', '=', $userid],
            ['productid', '=', $productid],
        ])->first();

        return $record;
    }

    public function createCartWhenNotExist($userid, $productid, $quantity, $price): mixed
    {
        $data = DB::table('cart')->insert([
            'userid' => $userid,
            'productid' => $productid,
            'quantity' => $quantity,
            'price' => $price
        ]);

        $newRecord = DB::table('cart')->where([
            ['userid', '=', $userid],
            ['productid', '=', $productid],
        ])->first();

        return $newRecord;
    }

    public function updateQuantity(Request $request): JsonResponse
    {
        $priceOfAProduct = DB::table('product')->where('productid', '=', $request->productid)->value('price');
        $newPrice = $request->quantity * $priceOfAProduct;

        $data = $this->updateCartWhenExist($request->userid, $request->productid, $request->quantity, $newPrice);
        if ($data === false):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true
        ]);
    }

    public function removeProductFromCart(Request $request): JsonResponse
    {
        $data = DB::table('cart')
            ->where('userid', '=', $request->userid)
            ->where('productid', '=', $request->productid)
            ->first();

        if ($data == null):
            return response()->json([
                'status' => false,
                'data' => 0
            ]);
        endif;

        $data = DB::table('cart')
            ->where('userid', '=', $request->userid)
            ->where('productid', '=', $request->productid)
            ->delete();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getProductsInCart(Request $request): JsonResponse
    {
        $data = DB::table('cart')
            ->where('cart.userid', '=', $request->userid)
            ->join('product', 'product.productid', '=', 'cart.productid')
            ->get([
                'product.thumpnail2', 'product.productid', 'product.origin', 'product.dimensions',
                'product.color', 'product.price as productPrice', 'cart.quantity', 'cart.price as cartPrice',
                'product.product_name'
            ]);
        if ($data->count() == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getQuantityInCart(Request $request): JsonResponse
    {
        $data = DB::table('cart')
            ->where('userid', '=', $request->userid)
            ->count('id');

        if ($data == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getOneProduct(Request $request): JsonResponse
    {
        $data = DB::table('billdetail')
            ->join('bill', 'bill.billid', '=', 'billdetail.billid')
            ->join('product', 'product.productid', '=', 'billdetail.productid')
            ->where('billdetail.billid', '=', $request->billid)
            ->where('bill.userid', '=', $request->userid)
            ->get([
                'billdetail.quantity', 'billdetail.price as cartPrice', 'product.productid',
                'product.product_name', 'product.price as productPrice', 'product.thumpnail2',
                'product.color', 'product.dimensions'
            ]);

        if ($data->count() == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function checkOut(Request $request): JsonResponse
    {
        $productInCart = DB::table('cart')
            ->where('userid', '=', $request->userid)
            ->get('id');


        if ($productInCart->count() <= 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        $newId = DB::table('bill')->insertGetId([
            'userid' => $request->userid,
            'total_price' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($newId != null || $newId != 0):
            $data = $request->input('data');
            unset($data[0]);
            $data = array_values($data);
            foreach ($data as $item):
                $checkInsert = DB::table('billdetail')->insert([
                    'productid' => $item['id'],
                    'price' => $item['intoMoney'],
                    'quantity' => $item['quantity'],
                    'billid' => $newId,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            endforeach;

            if ($checkInsert):
                return response()->json([
                    'status' => true,
                    'data' => $newId
                ]);
            endif;
        endif;

        return response()->json([
            'status' => false,
            'data' => []
        ]);

    }

    public function handlePayment(Request $request): JsonResponse
    {
        $queryGetBillDetail = DB::table('billdetail')
            ->where('bill.userid', '=', $request->userid)
            ->join('bill', 'billdetail.billid', '=', 'bill.billid')
            ->get([
                'billdetail.billid', 'billdetail.quantity', 'billdetail.price'
            ]);

        if ($queryGetBillDetail->count() > 0):
            $billid = $queryGetBillDetail[0]->billid;
            foreach ($queryGetBillDetail as $item):
                $queryGetBill = DB::table('bill')
                    ->where('billid', '=', $billid)
                    ->first('total_price');

                if ($queryGetBill != null):
                    $updateStatus = DB::table('bill')
                        ->where('billid', '=', $billid)
                        ->update([
                            'total_price' => $queryGetBill->total_price + $item->quantity * $item->price,
                            'payment_method' => $request->payment_method
                        ]);
                endif;
            endforeach;
            if ($updateStatus != 0):
                $delete = $this->deleteS($request->userid, $request->data);
                if ($delete):
                    return response()->json([
                        'status' => true
                    ]);
                endif;
            endif;
        endif;

        return response()->json([
            'status' => false,
        ]);
    }

    public function deleteS($userid, $data)
    {
        foreach ($data as $item):
            $deleteCart = DB::table('cart')
                ->where('productid', '=', $item['id'])
                ->where('userid', '=', $userid)
                ->delete();
        endforeach;

        if ($deleteCart != 0):
            return true;
        endif;
        return false;
    }
}
