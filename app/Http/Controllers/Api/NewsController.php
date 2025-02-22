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

    public function publicationCategories()
    {
        $items = PublicationCategory::get();
        return response()->json($items, 200);
    }

    public function publicationCategory($id)
    {
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
