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
            ->join('blog_categories', 'blog.blog_category_id', '=', 'blog_categories.id')
            ->select('blog.*', 'blog_categories.name as category_name')
            ->orderBy('blog.blog_category_id', 'asc')
            ->whereNotNull('blog.blog_category_id')
            ->get();

        $blogs = $blogs->groupBy('category_name');

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
