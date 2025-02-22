<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;



class ThesisController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view thesis', ['only' => ['index', 'show']]);
        $this->middleware('permission:create thesis', ['only' => ['create', 'store']]);
        $this->middleware('permission:update thesis', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete thesis', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.theses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.theses.create');
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
        return view('admin.theses.edit', ['id' => $id]);
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
        return view('admin.theses.type');
    }
    public function categories()
    {
        return view('admin.theses.category');
    }
    // public function sub_categories()
    // {
    //     return view('admin.theses.sub_category');
    // }
    public function images($id)
    {
        $item = Thesis::findOrFail($id);
        return view('admin.theses.image', [
            'item' => $item,
        ]);
    }
}
