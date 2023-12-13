<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function getAllByCategory(): JsonResponse
    {
        $blogs = DB::table('blog')
            ->join('blog_categories', 'blog.category_id', '=', 'blog_categories.category_id')
            ->join('users', 'blog.user_id', '=', 'users.id')
            ->select('blog_categories.name as category_name', 'users.fullname as user', 'blog.title as title', 'blog.content as content')
            ->orderBy('blog_categories.name', 'asc')
            ->whereNotNull('blog.category_id')
            ->whereNotNull('blog.user_id')
            ->get();

        if ($blogs->count() > 0):
            return response()->json([
                'status' => true,
                'data' => $blogs
            ], 200);
        endif;

        return response()->json([
            'status' => false,
            'data' => 'No blog found'
        ], 404);
    }
}
