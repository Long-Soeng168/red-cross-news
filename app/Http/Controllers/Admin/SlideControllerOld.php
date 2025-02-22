<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::paginate(10);
        return view('admin.slides.index', compact('slides'));
    }
    
    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);
        
        $input = $request->all();
        $image = $request->file('image');
        if(!empty($image)){
            $filename = time() . $image->getClientOriginalName();
        
            $image_path = public_path('assets/images/slides/'.$filename);
            $image_thumb_path = public_path('assets/images/slides/thumb/'.$filename);
            $imageUpload = Image::make($image->getRealPath())->save($image_path);
            $imageUpload->resize(600,null,function($resize){
                $resize->aspectRatio();
            })->save($image_thumb_path);
            
            $input['image'] = $filename;
        }

        $slide = Slide::create($input);

        return redirect()->route('admin.slides.index')->with('success', 'Slide created successfully.');
    }

    public function show($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slides.show', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slide = Slide::findOrFail($id);
        $input = $request->all();
        $image = $request->file('image');
        if(!empty($image)){
            $filename = time() . $image->getClientOriginalName();
        
            $image_path = public_path('assets/images/slides/'.$filename);
            $image_thumb_path = public_path('assets/images/slides/thumb/'.$filename);
            $imageUpload = Image::make($image->getRealPath())->save($image_path);
            $imageUpload->resize(600,null,function($resize){
                $resize->aspectRatio();
            })->save($image_thumb_path);
            
            $input['image'] = $filename;
        }

        $slide->update($input);

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy($id)
    {
        Slide::findOrFail($id)->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted successfully.');
    }
}
