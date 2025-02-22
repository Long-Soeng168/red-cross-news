<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort_by = $request->sort_by ?? null;
        $per_page = $request->per_page ?? 10;

        $query = News::query();

        if ($search !== null) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('title_kh', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%');
            });
        }


        switch ($sort_by) {
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'title_asc';
                $query->orderBy('title', 'asc');
                break;
        }

        $categories = $query
            ->orderBy('id', 'desc')
            ->paginate($per_page);
        return response()->json($categories);
    }

    public function relatedProducts($id)
    {
        // Find the product by its ID or throw a 404 error
        $product = News::findOrFail($id);

        // Number of products per page (define the $perPage variable)
        $perPage = 10;

        // Query to get products in the same category, excluding the current product
        $query = News::where('news_category_id', $product->news_category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('id', 'desc');

        // Select the necessary columns and paginate
        $products = $query->paginate($perPage);

        // Return the paginated products as a JSON response
        return response()->json($products);
    }

    public function getProductsByCategory(String $category_id)
    {
        $products = News::where('news_category_id', $category_id)->latest()->paginate(10);
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = News::with('category', 'images')->find($id);
        return response()->json($product);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
