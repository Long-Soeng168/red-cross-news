<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view video', ['only' => ['index', 'show']]);
        $this->middleware('permission:create video', ['only' => ['create', 'store']]);
        $this->middleware('permission:update video', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete video', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
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
        return view('admin.videos.edit', [
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
        return view('admin.videos.type');
    }
    public function categories()
    {
        return view('admin.videos.category');
    }
    public function sub_categories()
    {
        return view('admin.videos.sub_category');
    }
    public function images($id)
    {
        $item = Video::findOrFail($id);
        return view('admin.videos.image', [
            'item' => $item,
        ]);
    }
}
