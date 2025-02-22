<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view article', ['only' => ['index', 'show']]);
        $this->middleware('permission:create article', ['only' => ['create', 'store']]);
        $this->middleware('permission:update article', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete article', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
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
        return view('admin.articles.edit', [
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
        return view('admin.articles.type');
    }
    public function categories()
    {
        return view('admin.articles.category');
    }
    public function sub_categories()
    {
        return view('admin.articles.sub_category');
    }
    public function images($id)
    {
        $item = Article::findOrFail($id);
        return view('admin.articles.image', [
            'item' => $item,
        ]);
    }
}
