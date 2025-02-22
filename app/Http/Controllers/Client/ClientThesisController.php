<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Thesis;
use App\Models\ThesisImage;
use App\Models\ThesisResourceLink;
use App\Models\ThesisJournalLink;

class ClientThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.theses.index');
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
        // Find the main Thesis item
        $item = Thesis::findOrFail($id);

        // Retrieve images related to the Thesis
        $multi_images = ThesisImage::where('thesis_id', $id)
                                        ->latest()
                                        ->get();

        // Retrieve related Thesiss excluding the item itself
        $related_items = Thesis::where(function($query) use ($item) {
            $query->where('major_id', $item->major_id);
        })->where('id', '!=', $item->id) // Exclude the item itself
        ->inRandomOrder()
        ->limit(6)
        ->get();

        $resourceLinks = ThesisResourceLink::where('thesis_id', $id)->get();

        $journalLinks = ThesisJournalLink::where('thesis_id', $id)->get();

        // Return the view with the data
        return view('client.theses.show', [
            'item' => $item,
            'multi_images' => $multi_images,
            'related_items' => $related_items,
            'resourceLinks' => $resourceLinks,
            'journalLinks' => $journalLinks,
        ]);
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
        //
    }
}
