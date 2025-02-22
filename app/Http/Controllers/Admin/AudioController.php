<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Audio;

class AudioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view audio', ['only' => ['index', 'show']]);
        $this->middleware('permission:create audio', ['only' => ['create', 'store']]);
        $this->middleware('permission:update audio', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete audio', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.audios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.audios.create');
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
        return view('admin.audios.edit', [
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
        return view('admin.audios.type');
    }
    public function categories()
    {
        return view('admin.audios.category');
    }
    public function sub_categories()
    {
        return view('admin.audios.sub_category');
    }

    public function images($id)
    {
        $item = Audio::findOrFail($id);
        return view('admin.audios.image', [
            'item' => $item,
        ]);
    }
}
