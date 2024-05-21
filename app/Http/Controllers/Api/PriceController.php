<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
class PriceController extends Controller
{
    // Метод для получения цены товара по ID и дате
    public function show($productId, Request $request)
    {
        $date = $request->query('date', now()->toDateString());
        $price = Price::where('product_id', $productId)
                      ->whereDate('date', '<=', $date)
                      ->orderBy('date', 'desc')
                      ->first();
        return $price ? response()->json($price) : response()->json(['message' => 'Price not found'], 404);
    }
}
