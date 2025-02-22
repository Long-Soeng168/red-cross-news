<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Publication;
use App\Models\PublicationCategory;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->categoryId;
        $search = $request->search;

        $query = Publication::query();
        if($categoryId){
            $query->where('publication_category_id', $categoryId);
        }
        if($search){
            $query->where('name', 'LIKE', '%'.$search.'%');
        }
        $query->orderBy('id', 'desc');
        $items = $query->paginate(10);
        return response()->json($items, 200);
    }

    public function publicationCategories() {
        $items = PublicationCategory::get();
        return response()->json($items, 200);
    }

    public function publicationCategory($id) {
        $item = PublicationCategory::find($id);
        return response()->json($item, 200);
    }

    public function relatedItems(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $query = Publication::query();
        $query->where('publication_category_id', $publication->publication_category_id);
        $query->where('id', '!=', $publication->id);
        // $query->orderBy('id', 'desc');
        $query->inRandomOrder();
        $items = $query->paginate(10);
        return response()->json($items, 200);
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
        $item = Publication::with([
            'publicationCategory',
            'publicationSubCategory',
            'publicationType',
            'author',
            'publisher',
            'language',
            'location',
            'user',
            'images:image,publication_id'
        ])->findOrFail($id);

        return response()->json($item, 200);
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
