<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Journal;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view journal', ['only' => ['index', 'show']]);
        $this->middleware('permission:create journal', ['only' => ['create', 'store']]);
        $this->middleware('permission:update journal', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete journal', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.journals.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.journals.create');
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
        return view('admin.journals.edit', ['id' => $id]);
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
        return view('admin.journals.type');
    }
    public function categories()
    {
        return view('admin.journals.category');
    }
    // public function sub_categories()
    // {
    //     return view('admin.journals.sub_category');
    // }
    public function images($id)
    {
        $item = Journal::findOrFail($id);
        return view('admin.journals.image', [
            'item' => $item,
        ]);
    }
}
