<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        return Product::all();
    }

    // GET /products/{id}
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    // GET /products/related/{id}
    public function related($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return response()->json($relatedProducts);
    }


    // POST /products
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'nullable|string',
            'brand' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'isNew' => 'nullable|boolean',
            'availability' => 'required|in:in stock,out of stock',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'reviews' => 'nullable|integer',
            'reviewsList' => 'nullable|array',
            'isFavorite' => 'nullable|boolean',
            'ingredients' => 'nullable|array',
            'usage' => 'nullable|string',
            'dosageForm' => 'nullable|string',
            'expiryDate' => 'nullable|date',
            'requiresPrescription' => 'nullable|boolean',
            'ageRestriction' => 'nullable|string',
            'sideEffects' => 'nullable|string',
            'warning' => 'nullable|string',
            'storage' => 'nullable|string',
        ]);

        $product = Product::create($data);
        return response()->json($product, 201);
    }

    // PUT /products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'category' => 'nullable|string',
            'brand' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'discount' => 'nullable|numeric',
            'isNew' => 'nullable|boolean',
            'availability' => 'sometimes|required|in:in stock,out of stock',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'reviews' => 'nullable|integer',
            'reviewsList' => 'nullable|array',
            'isFavorite' => 'nullable|boolean',
            'ingredients' => 'nullable|array',
            'usage' => 'nullable|string',
            'dosageForm' => 'nullable|string',
            'expiryDate' => 'nullable|date',
            'requiresPrescription' => 'nullable|boolean',
            'ageRestriction' => 'nullable|string',
            'sideEffects' => 'nullable|string',
            'warning' => 'nullable|string',
            'storage' => 'nullable|string',
        ]);

        $product->update($data);
        return response()->json($product);
    }

    // DELETE /products/{id}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
