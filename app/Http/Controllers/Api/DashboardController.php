<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Visitor;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_blogs' => Blog::count(),
            'total_banners' => Banner::count(),
            'total_gallery' => Gallery::count(),
            'total_visitors' => Visitor::count(),
            'total_users' => User::count(),
        ]);
    }
}
