<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WebsiteInfo;

class WebsiteInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view setting', ['only' => ['index', 'show']]);
        $this->middleware('permission:create setting', ['only' => ['create', 'store']]);
        // $this->middleware('permission:update setting', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete setting', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = WebsiteInfo::first();
        return view('admin.website_infos.edit', [
            'item' => $item,
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
}
