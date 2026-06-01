<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Location;
use App\Models\ContentPage;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard.index',[
            'totalProducts' => Product::count(),
            'totalLocations' => Location::count(),
            'totalPages' => ContentPage::count(),
        ]);
    }
}