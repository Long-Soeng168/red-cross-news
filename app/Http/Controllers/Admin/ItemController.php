<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopId = $request->user()->shop_id;
        $items = Item::where('shop_id', $shopId)
                    ->with('category')
                    ->with('type')
                    ->paginate(10);
        // return $items;
        return view('admin.items.index', [
            "items" => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $shopId = $request->user()->shop_id;
        $categories = Category::where('shop_id', $shopId)->get();
        $types = Type::where('shop_id', $shopId)->get();

        return view('admin.items.create', [
            'categories' => $categories,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()) ;
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'type_id' => 'required|numeric',
        ]);

        $input = $request->all();

        $item = Item::create($input);
        $item->update([
                'shop_id' => $request->user()->shop_id,
                'create_by_user_id' => $request->user()->id,
            ]);

        return redirect('/admin/items')->with('status', 'Add Item Successful');
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
        Item::destroy($id);
        return redirect()->back()->with('status', 'Delete Item Successful');
    }
}
