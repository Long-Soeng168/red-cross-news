<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view bulletin', ['only' => ['index', 'show']]);
        $this->middleware('permission:create bulletin', ['only' => ['create', 'store']]);
        $this->middleware('permission:update bulletin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete bulletin', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.news.edit', [
            'id' => $id,
        ]);
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

    public function types()
    {
        return view('admin.news.type');
    }
    public function categories()
    {
        return view('admin.news.category');
    }
    public function sub_categories()
    {
        return view('admin.news.sub_category');
    }
    public function images($id)
    {
        $item = News::findOrFail($id);
        return view('admin.news.image', [
            'item' => $item,
        ]);
    }
}
