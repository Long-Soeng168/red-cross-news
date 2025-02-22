<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopId = $request->user()->shop_id;
        $categories = [];
        if($shopId) {
            $categories = Category::where('shop_id', $shopId)->get();
        }
        // dd($categories, $shopId);
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => 'required|max:255',
            'name_kh' => 'required|max:255',
        ]);

        $category = Category::create([
            'shop_id' => $request->user()->shop_id,
            'create_by_user_id' => $request->user()->id,
            'name' => $request->name,
            'name_kh' => $request->name_kh,
            'code' => $request->code,
        ]);

        return redirect('/admin/categories')->with('status', 'Add Category Successful');

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
        Category::destroy($id);
        return redirect()->back()->with('status', 'Delete Successful');
    }
}
