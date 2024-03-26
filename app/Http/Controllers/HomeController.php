<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function renderHome()
    {
        $categories = Category::all();
        $products = Product::all();
        $promotions = Promotion::all();
        return view('welcome', compact('categories', 'products', 'promotions'));
    }
}
