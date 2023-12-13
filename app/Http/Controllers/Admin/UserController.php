<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::all();
        if ($users->count() == 0) {
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $users
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $status = [0, 1, 2];
        $user = User::find($id);
        if ($user->count() == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        foreach ($status as $value):
            if ($request->status != $value):
                return response()->json([
                    'status' => false,
                    'data' => []
                ]);
            endif;
        endforeach;

        $user->status = $request->status;
        if ($user->save()):
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        endif;

        return response()->json([
                'status' => false,
                'data' => []
            ]
        );


    }
}
