<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view image', ['only' => ['index', 'show']]);
        $this->middleware('permission:create image', ['only' => ['create', 'store']]);
        $this->middleware('permission:update image', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete image', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.images.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.images.create');
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
        return view('admin.images.edit', [
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
        return view('admin.images.type');
    }
    public function categories()
    {
        return view('admin.images.category');
    }
    public function sub_categories()
    {
        return view('admin.images.sub_category');
    }
    public function images($id)
    {
        $item = Image::findOrFail($id);
        return view('admin.images.image', [
            'item' => $item,
        ]);
    }
}
