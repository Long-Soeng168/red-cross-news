<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shopId = $request->user()->shop_id;
        $types = [];
        if($shopId) {
            $types = Type::where('shop_id', $shopId)->get();
        }
        // dd($types, $shopId);
        return view('admin.types.index', [
            'types' => $types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
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

        $type = Type::create([
            'shop_id' => $request->user()->shop_id,
            'create_by_user_id' => $request->user()->id,
            'name' => $request->name,
            'name_kh' => $request->name_kh,
            'code' => $request->code,
        ]);

        return redirect('/admin/types')->with('status', 'Add type Successful');

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
        Type::destroy($id);
        return redirect()->back()->with('status', 'Delete Successful');
    }
}
