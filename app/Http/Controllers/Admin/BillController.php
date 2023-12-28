<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function getBill($userId, $status): mixed
    {

        $result = DB::table('bill')
            ->join('billdetail', 'billdetail.billid', '=', 'bill.billid')
            ->join('product', 'product.productid', '=', 'billdetail.productid')
            ->where('bill.userid', '=', $userId)
            ->where('bill.status', '=', $status)
            ->get([
                'bill.billid', 'bill.payment_method', 'bill.total_price', 'bill.created_at',
                'billdetail.productid', 'billdetail.quantity', 'billdetail.price', 'product.product_name', 'product.color',
                'product.dimensions', 'product.thumpnail2'
            ]);

        if ($result->count() <= 0):
            return false;
        endif;

        $resultArray = [];

        foreach ($result as $item):
            $billid = $item->billid;
            if (empty($resultArray[$billid])):
                $resultArray[$billid] = [
                    "payment_method" => $item->payment_method,
                    "total_price" => $item->total_price,
                    "created_at" => $item->created_at,
                    "products" => []
                ];
            endif;

            $resultArray[$billid]['products'][] = [
                "productid" => $item->productid,
                "quantity" => $item->quantity,
                "thumpnail2" => $item->thumpnail2,
                "color" => $item->color,
                "dimensions" => $item->dimensions,
                "price" => $item->price,
                "product_name" => $item->product_name
            ];

        endforeach;

        return $resultArray;
    }

    public function getPendingBills(Request $request): JsonResponse
    {

        $result = $this->getBill($request->userid, '0');
        if ($result === false):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function getAcceptedBills(Request $request): JsonResponse
    {
        $result = $this->getBill($request->userid, '1');
        if ($result === false):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function approveBill(Request $request): JsonResponse
    {
        $data = DB::table('bill')
            ->where('billid', '=', $request->billid)
            ->update([
                'status' => 1,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        if ($data != 0):
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        endif;

        return response()->json([
            "status" => false,
            "data" => $data
        ]);
    }

    public function getAllPendingBills(): JsonResponse
    {
        $data = DB::table('bill')
            ->where('bill.status', '=', 0)
            ->join('billdetail', 'billdetail.billid', '=', 'bill.billid')
            ->join('users', 'users.id', '=', 'bill.userid')
            ->join('product', 'billdetail.productid', '=', 'product.productid')
            ->get([
                'bill.billid', 'bill.payment_method', 'bill.total_price', 'bill.created_at',
                'billdetail.productid', 'billdetail.quantity', 'billdetail.price',
                'product.product_name', 'users.fullname', 'users.email'
            ]);

        if ($data->count() === 0):
            return response()->json([
                'status' => false,
                'data' => 0
            ]);
        endif;

        $result = [];
        foreach ($data as $item):
            $billid = $item->billid;

            if (empty($result[$billid])):
                $result[$billid] = [
                    "payment_method" => $item->payment_method,
                    "total_price" => $item->total_price,
                    "created_at" => $item->created_at,
                    "products" => [
                        "product_name" => $item->product_name,
                        "productid" => $item->productid,
                        "quantity" => $item->quantity,
                        "price" => $item->price,
                    ],
                    "user" => [
                        "fullname" => $item->fullname,
                        "email" => $item->email
                    ]
                ];
            endif;

        endforeach;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
