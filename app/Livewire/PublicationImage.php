<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PublicationImage as MultiImage;
use App\Models\Publication;
use Livewire\WithFileUploads;
use Image;
use Illuminate\Support\Facades\File;

class PublicationImage extends Component
{
    use WithFileUploads;

    public $images = []; // Updated to hold multiple images
    public $item;

    public function mount(Publication $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function delete($id)
    {
        $image = MultiImage::findOrFail($id);

        // Get the path to the image
        $imagePathThumb = public_path('assets/images/publications/thumb/' . $image->image);
        $imagePath = public_path('assets/images/publications/' . $image->image);

        // Delete the image file from the filesystem
        if (File::exists($imagePathThumb)) {
            File::delete($imagePathThumb);
        }
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the record from the database
        $image->delete();

        session()->flash('success', 'File deleted successfully!');
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // 2MB Max for each image
        ]);

        session()->flash('success', 'File uploaded successfully!');
    }

    public function save()
    {
        if (empty($this->images)) {
            session()->flash('error', ['Image is required!']);
            return;
        }

        $this->validate([
            'images.*' => 'image|max:2048', // 2MB Max for each image
        ]);

        // Ensure directories exist
        $publicationPath = public_path('assets/images/publications');
        $thumbPath = public_path('assets/images/publications/thumb');
        if (!File::exists($publicationPath)) {
            File::makeDirectory($publicationPath, 0755, true);
        }
        if (!File::exists($thumbPath)) {
            File::makeDirectory($thumbPath, 0755, true);
        }

        foreach ($this->images as $image) {
            if (!empty($image)) {
                // $filename = time() . '_' . $image->getClientOriginalName();
                $filename = time() . str()->random(10) . '.' . $image->getClientOriginalExtension();

                $imagePath = $publicationPath . '/' . $filename;
                $imageThumbPath = $thumbPath . '/' . $filename;

                try {
                    $imageUpload = Image::make($image->getRealPath())->save($imagePath);
                    $imageUpload->resize(400, null, function ($resize) {
                        $resize->aspectRatio();
                    })->save($imageThumbPath);

                    MultiImage::create([
                        'publication_id' => $this->item->id,
                        'image' => $filename,
                    ]);
                } catch (\Exception $e) {
                    session()->flash('error', ['An error occurred while saving the image.']);
                    return;
                }
            }
        }

        // Clear the images array
        $this->images = [];

        session()->flash('success', 'File saved successfully!');
    }

    public function render()
    {
        $multiImages = MultiImage::where('publication_id', $this->item->id)->latest()->get();
        return view('livewire.publication-image', [
            'multiImages' => $multiImages,
        ]);
    }
}
