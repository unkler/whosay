<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('item');
            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('product_id', $id)->exists();
                if (!$itemId) {
                    abort(404);
                }
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $products = Product::availableItems()
            ->selectCategory($request->category ?? '0')
            ->sortOrder($request->sort)
            ->paginate($request->pagination ?? '20');

        $categories = PrimaryCategory::with('secondary')
        ->get();

        return view('user.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($quantity > \Constant::MAX_CART_QUANTITY) $quantity = \Constant::MAX_CART_QUANTITY;

        return view('user.show', compact('product', 'quantity'));
    }
}
