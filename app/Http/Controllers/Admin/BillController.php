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
                'billdetail.productid', 'billdetail.quantity', 'billdetail.price', 'product.product_name'
            ]);

        if ($result->count() <= 0):
            return false;
        endif;

        return $result;
    }

    public function getPendingBills(Request $request): JsonResponse
    {

        $result = $this->getBill($request->userid, '0');
        if ($result === false):
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
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
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
