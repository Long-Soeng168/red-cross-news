<?php
namespace App\Http\Controllers\Api;

use App\Models\Slide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return response()->json([
            'slides' =>$slides,
            'imagePath' => $_ENV['APP_URL'].'/assets/images/slides',
            'imageCompressedPath' => $_ENV['APP_URL'].'/assets/images/slides/thumb',
            ]);
    }
    
    public function create()
    {
        // Not needed for API
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

        return response()->json($slide, 201);
    }

    public function show($id)
    {
        $slide = Slide::findOrFail($id);
        return response()->json([
            'slide' => $slide,
            'imagePath' => $_ENV['APP_URL'].'/assets/images/slides',
            'imageCompressedPath' => $_ENV['APP_URL'].'/assets/images/slides/thumb',
            ]);
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

        return response()->json($slide, 200);
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
        return response()->json(null, 204);
    }
}
