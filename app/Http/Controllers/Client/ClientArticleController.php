<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\ArticleCategory;

class ClientArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('client.articles.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the main Article item
        $item = Article::findOrFail($id);

        // Retrieve images related to the Article
        $multi_images = ArticleImage::where('article_id', $id)
                                        ->latest()
                                        ->get();

        // Retrieve related articles excluding the item itself
        $related_items = Article::where(function($query) use ($item) {
            $query->where('article_category_id', $item->article_category_id);
        })->where('id', '!=', $item->id) // Exclude the item itself
        ->inRandomOrder()
        ->limit(6)
        ->get();

        // Return the view with the data
        return view('client.articles.show', [
            'item' => $item,
            'multi_images' => $multi_images,
            'related_items' => $related_items,
        ]);
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
