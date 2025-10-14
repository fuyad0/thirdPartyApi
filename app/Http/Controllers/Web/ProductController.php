<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    function index(){
        $products= Http::timeout(2)->retry(3, 3600)->get("https://fakestoreapi.com/products/");

        if($products->successful()){

            $products= json_decode($products,true);
            return response()->json($products);
        }

        return response()->json([
            'error' => 'Failed to fetch products',
            'status' => $products->status(),
        ], $products->status());
        
    }

   /* function index(){
        $products= Http::get("https://fakestoreapi.com/products/");

        if($products->successful()){

            $products= json_decode($products,true);
            return response()->json($products);
        }
        
        return response()->json([
            'error' => 'Failed to fetch products',
            'status' => $products->status(),
        ], $products->status());
        
    }*/
}
